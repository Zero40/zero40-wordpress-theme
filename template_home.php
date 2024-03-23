<?php
/*
Template Name: Zero40 Home
*/

get_header();

$layout = $integral['gen-home-layout']['Enabled'];

if ( $layout ) {
	foreach ( $layout as $key => $value ) {
		get_template_part( 'sections/' . $key );
		if ( 'hero' === $key ) {
			get_template_part( 'sections/startups' );	
			get_template_part( 'sections/events' );	
		}
	}
}

get_footer();