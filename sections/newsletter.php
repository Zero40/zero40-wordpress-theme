<?php
/**
 * FIX newsletter shortcode
 *
 * @package WordPress
 * @subpackage Integral
 * @since Integral 1.0
 */

global $integral;
$code = $integral['mailchimp-code'];
$integral['mailchimp-code'] = do_shortcode($code);
load_template(TEMPLATEPATH . '/sections/newsletter.php');
$integral['mailchimp-code'] = $code;