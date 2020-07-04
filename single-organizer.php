<?php
// Single organizer

get_header(); ?>

    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="content">


					<?php while ( have_posts() ): the_post() ?>
                        <article id="organizer-<?php the_ID() ?>" <?php post_class() ?>>
                            <figure class="post-image">
                                <img width="800" height="400" src="<?= get_post()->_image_url ?>" alt="post1"></figure>
                            <div class="clearfix">

                            </div>

                            <h2 class="entry-title">
                                <a href="<?php the_permalink() ?>"
                                   rel="bookmark" title="<?php echo get_the_title() ?>">
									<?php the_title() ?>
                                </a>
                            </h2>

<!--                            <ul class="pagemeta" style="margin-bottom: 0px;">-->
<!--                                <li><i class="fa fa-envelope"></i>-->
<!--									--><?php //echo get_post()->_email_from ?>
<!--                                </li>-->
<!--                            </ul>-->

                            <div class="entry">

                                <div><?php the_content() ?></div>
                            </div>


                            <div>
                                <h2 class="smalltitle">Eventos<span></span></h2>
								<?= do_shortcode( '[em-events organizer="' . get_the_ID() . '"]' ); ?>
                            </div>

                            <div class="clearfix"></div>


                        </article> <!--post -->


                        <div class="clearfix"></div>

					<?php endwhile; ?>

                </div><!--content-->
            </div>

			<?php get_sidebar(); ?>

        </div>
    </div>

<?php get_footer(); ?>