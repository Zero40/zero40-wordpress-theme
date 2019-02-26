<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// BEGIN ENQUEUE PARENT ACTION
if ( ! function_exists( 'zero_cfg_locale_css' ) ):
	function zero_cfg_locale_css( $uri ) {
		if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) ) {
			$uri = get_template_directory_uri() . '/rtl.css';
		}

		return $uri;
	}
endif;
add_filter( 'locale_stylesheet_uri', 'zero_cfg_locale_css' );

if ( ! function_exists( 'zero_cfg_parent_css' ) ):
	function zero_cfg_parent_css() {
		wp_enqueue_style( 'zero_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(
			'integral_bootstrap_css',
			'integral_multicolumnsrow_css',
			'integral_flexslider_css',
			'integral_prettyphoto_css'
		) );
	}
endif;
add_action( 'wp_enqueue_scripts', 'zero_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

function zero_new_event_tags_script() {
	wp_register_script( 'vue-tags-input',  'https://cdn.jsdelivr.net/npm/@voerro/vue-tagsinput@1.8.0/dist/voerro-vue-tagsinput.js', array( 'vue' ), '2.0.1', true );
	wp_add_inline_script( 'vue-tags-input', "Vue.component('tags-input', window.VoerroTagsInput)" );
}
add_action( 'wp_enqueue_scripts', 'zero_new_event_tags_script', 9);



//add_action('wp_enqueue_scripts', function () {
//    wp_enqueue_style('hashone-parent-style', get_template_directory_uri() . '/style.css');
//});


// Shortcode to show and handle new events form
add_shortcode( 'new-event', 'newEvent' );
function newEvent() {
	ob_start();

	// Receiving a post?
	if ( ! empty( $_POST ) && count( $_POST ) > 0 && isset( $_POST['new-event'] ) ) {
		/** @var string[]|string $response */
		global $response;
		$response = EventsManager::newEvent( $_POST, true );
	}
	require( dirname( __FILE__ ) . "/new-event.php" );

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

// Shortcode to newsletter subscription
add_shortcode( 'form-newsletter', 'formForNewsletter' );
function formForNewsletter( $atts ) {
	ob_start();
	// Receiving a post?

	if ( ! empty( $_POST ) && count( $_POST ) > 0 && isset( $_POST['form-newsletter'] ) ) {
		/** @var string[]|string $response */
		global $response;

		$sucesso = EventsManager::newsletterSubscription( $_POST['person_name'], $_POST['person_email'], $_POST['category'] );
		if ( $sucesso === false ) {
			$response['error'] = EventsManager::getLastError();
		} else {
			$response['success'] = true;
			if ( isset( $atts['redirect'] ) ) {
				echo '<script>window.location = "' . $atts['redirect'] . '";</script>';
				echo "Redirecionando...";
			}

		}
	}

	require( dirname( __FILE__ ) . "/form-newsletter.php" );

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}


//*** Tornar estas funções, helpers, ou obter direto do EventsManager mesmo

// Shortcode to list events
add_shortcode( 'list-events', 'listEvents' );
function listEvents( $atts ) {
	global $events;
	global $title;
	global $publish;
	global $unpublish;

	if ( isset( $_GET["publish"] ) && $_GET["publish"] !== "" && EventsManager::isAutenticated() ) {
		$publish = EventsManager::publishEventById( $_GET["publish"] );
	}
	if ( isset( $_GET["unpublish"] ) && $_GET["unpublish"] !== "" && EventsManager::isAutenticated() ) {
		$unpublish = EventsManager::unpublishEventById( $_GET["unpublish"] );
	}

	$title = $atts['title'];

	if ( $atts['future'] == true ) {
		$events = EventsManager::getWillHappen();
	} else if ( $atts['present'] == true ) {
		$events = EventsManager::getHappening();
	} else if ( $atts['past'] == true ) {
		$events = EventsManager::getHappened();
	}

	if ( $atts['future'] == true && EventsManager::isAutenticated() ) {
		$pending = EventsManager::getFutureEventsPendingConfirmation();
		if ( $pending != null && $events != null ) {
			$events = $events->merge( $pending );
		}
	}

	$events = $events->sortBy( 'starts_at' );

	// if (!is_null($events)) {
	require( dirname( __FILE__ ) . "/events.php" );
	// }

}


// if (!class_exists('EventsManager')){
//     require_once ABSPATH.'/wp-content/plugins/EventsManager/EventsManager.php';
// }

// *********************
// Filters
// *********************

/**
 * Add login/logout button on wordpress menu items
 */
// add_filter('wp_nav_menu_items', 'wpNavMenuItems', 10, 2);
function wpNavMenuItems( $items, $args ) {
	if ( ! EventsManager::isAutenticated() ) {
		$title = "LOGIN";
		$url   = get_site_url() . '/login/';
	} else {
		$title = "LOGOUT";
		$url   = get_site_url() . '/logout/';
	}

	$profile = '<li class="ep_profile_login_page ep-nav-menu-custom-item"><a href="' . esc_url( $url ) . '"><span>' . $title . '</span></a></li>';

	$items = $items . $profile;

	return $items;
}

// *********************
// Shortcode Functions
// *********************


add_shortcode( 'form-login', 'eventsLogin' );
function eventsLogin( $atts ) {
	ob_start();
	// Receiving a post?

	global $error;
	global $logged;
	if ( ! isset( $atts['redirect'] ) ) {
		die( "Must have redirect on eventsLogin" );
	}

	$error  = null;
	$logged = false;

	if ( ! empty( $_POST ) && count( $_POST ) > 0 && isset( $_POST['form-login'] ) ) {
		if ( $_POST['login'] && $_POST['password'] ) {
			// Try login
			$user = EventsManager::login( $_POST['login'], $_POST['password'] );
			if ( $user == false ) {
				$error = EventsManager::getLastError();
			} else {
				// Redirect
				echo '<script>
	                        window.location = "' . $atts['redirect'] . '";
	                     </script>';
				$logged = true;
			}
		} else {
			$error = "Preencha o email e o password";
		}
	}

	require( dirname( __FILE__ ) . "/login.php" );

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

// should be moved to template
add_shortcode( 'organizers', 'listOrganizer' );
function listOrganizer( $atts ) {
	global $organizers;
	if ( $atts['active'] == true ) {
		$organizers = EventsManager::getActiveOrganizer();
	}
	if ( ! is_null( $organizers ) ) {
		require( "wp-content/themes/zero40-theme/organizers.php" );
	}

}

add_shortcode( 'eventsLogout', 'eventsLogout' );
function eventsLogout( $atts ) {
	if ( ! isset( $atts['redirect'] ) ) {
		die( "Must have redirect on eventsLogout" );
	}

	// Logout and redirect
	EventsManager::logout();
	echo '<script>window.location = "' . $atts['redirect'] . '";</script>';
	echo "Redirecionando...";
}

function getOrganizerLink( $event ) {
	return get_site_url() . "/organizador/" . $event->organizer_id . "/";
}