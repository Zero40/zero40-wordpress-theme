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



// Shortcode to newsletter subscription
add_shortcode( 'form-newsletter', 'formForNewsletter' );
function formForNewsletter( $atts ) {
	ob_start();
	// Receiving a post?

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
function getTeamSize($raw = false, $post_id = null){
    $team_size = $post_id ? get_field('team_size', $post_id) : get_field('team_size');
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
    return $raw ? $team_size : $icons;
}

/**
 * Apresenta o momento atual da startup
 * @return string
 */
function getActualMoment($raw = false, $post_id = null){
    $actual_moment = $post_id ? get_field('actual_moment', $post_id) : get_field('actual_moment');
    $actual_moment = substr($actual_moment,0, strpos($actual_moment,"("));
    return $raw ? $actual_moment :  "<span>Momento atual: $actual_moment</span>";
}

/**
 * Apresenta o foco da startup
 * @return string
 */
function getTarget($raw = false, $post_id = null){
    $target = $post_id ? get_field('target', $post_id) :get_field('target');
    $target = substr($target,0, strpos($target,"("));
	return $raw ? $target : "<span>Público alvo: $target</span>";
}

/**
 * Apresenta a área de negócio da startup
 * @return string
 */
function getBusinessArea($raw = false, $post_id = null){
    $business_area = $post_id ? get_field('business_area', $post_id) : get_field('business_area') ;
    return $raw ? $business_area : "<ul><li>" . implode( '</li><li>', $business_area) . "</li></ul>";
}

/**
 * Apresenta o momento de negócio da startup
 * @return string
 */
function getBusinessModel($raw = false, $post_id = null){
    $business_model = $post_id ? get_field('business_model', $post_id) : get_field('business_model') ;
    $business_model = substr($business_model,0, strpos($business_model,"("));
    return $raw ?  $business_model :  "<span>Modelo negócio: $business_model</span>";
}

/**
 * @return WP_Post
 */

function queryPostAcordingDay($post_type){
	$startups = new WP_Query( array('post_type' => $post_type) );
    $index = date('d') % sizeof($startups->posts);
    $featured = $startups->posts[$index]; 
	return $featured;
}