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

?>

<?php get_header(); ?>

<?php

$layout = $integral['gen-home-layout']['Enabled'];

if ($layout) {
    $layout=[];
    $layout['events'] = "Eventos";
    // var_dump($layout);
    foreach ($layout as $key => $value) {
        get_template_part('sections/' . $key);

    }
}

?>

<?php get_footer(); ?>