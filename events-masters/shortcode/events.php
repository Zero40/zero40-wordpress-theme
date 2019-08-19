<?php
/**
 * Events Shortcode handler
 *
 * @link       https://github.com/maxjf1
 * @since      1.0.X
 *
 * @package    zero40
 * @subpackage Events_Masters/includes
 */
?>
<div class="row multi-columns-row">
    <?php while ( have_posts() ): the_post() ?>
        <article id="event-shortcode-<?php the_ID() ?>" <?php post_class('event-shortcode-post col-sm-4 col-md-4 col-lg-4 grid'); ?>
                 data-sr-id="<?php get_the_ID() ?>"
                 style="margin-bottom: 30px; visibility: visible;  -webkit-transform: translateY(0) scale(1) rotateZ(0); opacity: 1;transform: translateY(0) scale(1) rotateZ(0); opacity: 1;-webkit-transition: -webkit-transform 0.9s ease-in-out 0.2s, opacity 0.9s ease-in-out 0.2s; transition: transform 0.9s ease-in-out 0.2s, opacity 0.9s ease-in-out 0.2s; ">
            <a href="<?php the_permalink() ?>" rel="prettyPhoto"
               title="<?php echo get_the_title() ?>" class="event-shortcode-image-link fancybox-thumb hovereffect">
                <?php if(get_post()->_thumb_url): ?>
                    <img src="<?= get_post()->_thumb_url ?>" alt="<?= get_the_title() ?>"
                         class="img-responsive center-block">
                <?php endif ?>
            </a>

            <h3 class="widget-title">
                <a href="<?php the_permalink() ?>" rel="prettyPhoto"
                   title="<?php echo get_the_title() ?>" class="fancybox-thumb hovereffect">
                    <?php the_title() ?>
                </a>
            </h3>

            <h5><?= $when ?><?= date('d/m \à\s H:i\h\s', strtotime(get_post()->_starts_at)) ?></h5>
            <h5>
                <small><?= get_the_title( EM::get_the_place() ) ?></small>
            </h5>
            <h5>
                <small><?= get_the_title( EM::get_the_organizer() ) ?></small>
            </h5>
        </article>
	<?php endwhile; ?>
</div>
