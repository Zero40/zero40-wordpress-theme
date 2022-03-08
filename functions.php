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
	wp_register_style( 'vue-tags-input', 'https://cdn.jsdelivr.net/npm/@voerro/vue-tagsinput@1.11.2/dist/style.css', array(), '1.11.2' );
	wp_register_script( 'vue-tags-input', 'https://cdn.jsdelivr.net/npm/@voerro/vue-tagsinput@1.11.2/dist/voerro-vue-tagsinput.js', array( 'vue' ), '1.11.2', true );
	wp_add_inline_script( 'vue-tags-input', "Vue.component('tags-input', window.VoerroTagsInput)" );
}

add_action( 'wp_enqueue_scripts', 'zero_new_event_tags_script', 9 );


function zero_loader_img() {
	return get_stylesheet_directory_uri() . '/img/loading.gif';
}

add_action( 'em_checkout_loader_img_url', 'zero_loader_img' );

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
// Shortcode to newsletter subscription
add_shortcode( 'form-newsletter-mailchimp', 'formForNewsletterMailchimp' );
function formForNewsletterMailchimp( $atts ) {
	ob_start();
	require( dirname( __FILE__ ) . "/form-newsletter-mailchimp.php" );
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}


//*** Tornar estas funções, helpers, ou obter direto do EventsManager mesmo

// Shortcode to list events
add_shortcode( 'list-events', 'listEvents' );
function listEvents( $atts ) {
    return null;
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


// STARTUPS - Formulário

add_filter( 'cf7_2_post_status_novo-evento_copy', 'publish_new_novo_evento_copy',10,3);
/**
 * Function to change the post status of saved/submitted posts.
 * @param string $status the post status, default is 'draft'.
 * @param string $ckf7_key unique key to identify your form.
 * @param array $submitted_data complete set of data submitted in the form as an array of field-name=>value pairs.
 * @return string a valid post status ('publish'|'draft'|'pending'|'trash')
 */
function publish_new_novo_evento_copy($status, $ckf7_key, $submitted_data){
    /*The default behaviour is to save post to 'draft' status.  If you wish to change this, you can use this filter and return a valid post status: 'publish'|'draft'|'pending'|'trash'*/
    return 'draft';
}

// STARTUPS - exibição da lista e detalhe

/**
 * Apresenta o tamanho do time da startup com ícones
 * @return string
 */
function getTeamSize(){
    $team_size = get_field('team_size');
    $size = explode("-",$team_size);
    $min = $size[0];
    $max = $size[1];
    $team['1-5']=1;
    $team['5-10']=2;
    $team['11-20']=3;
    $team['21-40']=4;
    $team['41-100']=6;

    $repeat = $team[$team_size];
    $icons = str_repeat("<i class=\"fa fa-user-o\" aria-hidden=\"true\" title=\"Equipe entre $min e $max pessoas, incluindo os sócios\"></i>", $repeat);
    return $icons;
}

/**
 * Apresenta o momento atual da startup
 * @return string
 */
function getActualMoment($raw = false){
    $actual_moment = get_field('actual_moment');
    $actual_moment = substr($actual_moment,0, strpos($actual_moment,"("));
    return $raw ? $actual_moment :  "<span>Momento atual: $actual_moment</span>";
}

/**
 * Apresenta o foco da startup
 * @return string
 */
function getTarget($raw = false){
    $target = get_field('target');
    $target = substr($target,0, strpos($target,"("));
	return $raw ? $target : "<span>Público alvo: $target</span>";
}

/**
 * Apresenta a área de negócio da startup
 * @return string
 */
function getBusinessArea($raw = false){
    $business_area = get_field('business_area');
    return $raw ? $business_area : "<ul><li>" . implode( '</li><li>', $business_area) . "</li></ul>";
}

/**
 * Apresenta o momento de negócio da startup
 * @return string
 */
function getBusinessModel($raw = false){
    $business_model = get_field('business_model');
    $business_model = substr($business_model,0, strpos($business_model,"("));
    return $raw ?  $business_model :  "<span>Modelo negócio: $business_model</span>";
}