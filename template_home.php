<?php
/*
Template Name: Zero40 Home

 * Home Page Template for our theme
 *
 * @package WordPress
 * @subpackage Integral
 * @since Integral 1.0
 */


// $layout = $integral['gen-home-layout']['Enabled'];
// echo "<pre>";
// var_dump($layout);
// die();

get_header();

$layout = $integral['gen-home-layout']['Enabled'];


if ( $layout ) {
	foreach ( $layout as $key => $value ) {
		get_template_part( 'sections/' . $key );
		if ( 'hero' === $key ) {
			get_template_part( 'sections/events' );
		}
	}
}

get_footer();