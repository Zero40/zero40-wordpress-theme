<?php

/**
 * Header section for our theme
 *
 * @package WordPress
 * @subpackage Integral
 * @since Integral 1.0
 */
?>
<?php global $integral; ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery.mask.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri() ?>/js/tagify.js"></script>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/tagify.css">

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid px-0 px-lg-2">
            <div class="container px-0 px-lg-2">
                <div class="navbar-header d-flex align-items-center w-100">
                    <?php
                    $integral_logo = get_theme_mod('integral_logo');

                    if (isset($integral_logo) && $integral_logo != "") :
                        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" class="navbar-brand ml-0 mr-2">';
                        echo '<img class="img-responsive" src="' . $integral_logo . '" alt="' . get_bloginfo('title') . '">';
                        echo '</a></h1>';
                    else :
                        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '" title="' . get_bloginfo('title') . '" class="navbar-brand ml-0 mr-2">';
                        echo '' . get_bloginfo('title') . '';
                        echo '</a></h1>';
                    endif;
                    ?>
                    <button type="button" class="navbar-toggle ml-auto" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only"><?php _e('Toggle navigation', 'integral'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>

                <?php if (has_nav_menu('primary')) : ?>

                    <?php
                    $navbar_theme = wp_nav_menu(
                        array(
                            'menu'              => 'primary',
                            'theme_location'    => 'primary',
                            'depth'             => 3,
                            'container'         => 'div',
                            'container_class'   => 'collapse navbar-collapse',
                            'container_id'      => 'navbar-ex-collapse',
                            'menu_class'        => 'nav navbar-nav navbar-right navbar-expand-md',
                            'echo'              => false,
                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                            'walker'            => new wp_bootstrap_navwalker()
                        )
                    );

                    $navbar_theme = str_replace('menu-item ', 'ml-2 ml-md-4 ml-lg-5 menu-item ', $navbar_theme);
                    $navbar_theme = str_replace('href=', 'class="text-nowrap" href=', $navbar_theme);
                    print_r($navbar_theme);

                    ?>

                <?php endif; ?>

            </div>

        </div>

    </nav>