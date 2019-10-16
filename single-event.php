<?php
// Single event

get_header(); ?>

    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="content">


					<?php while ( have_posts() ): the_post() ?>
                        <article id="event-<?php the_ID() ?>" <?php post_class() ?>>
                            <?php if(get_post()->_image_url): ?>
                                <figure class="post-image">
                                    <img width="800" height="400" src="<?= get_post()->_image_url ?>" alt="post1">
                                </figure>
                            <?php endif ?>
                            <div class="clearfix">

                            </div>

                            <h2 class="entry-title">
                                <a href="<?php the_permalink() ?>"
                                   rel="bookmark" title="<?php echo get_the_title() ?>">
									<?php the_title() ?>
                                </a>
                            </h2>

                            <ul class="pagemeta" style="margin-bottom: 0px;">
                                <li>
                                    <i class="fa fa-clock-o"></i><?= date( 'd/m \à\s H:i\h\s', strtotime( get_post()->_starts_at ) ) ?>
                                </li>
                                <li>
                                    <i class="fa fa-bookmark"></i><?= get_term_field( 'name', EM::get_the_category() ) ?>
                                </li>
                                <li><i class="fa fa-comment"></i><?= get_term_field( 'name', EM::get_the_type() ) ?>
                                </li>
                            </ul>
							<?php if ( EM::get_the_tags() ): ?>
                                <ul class="pagemeta">
									<?php foreach ( EM::get_the_tags() as $tag ): ?>
                                        <li><i class="fa fa-tag"></i><?= get_term_field( 'name', $tag ) ?></li>
									<?php endforeach; ?>
                                </ul>
							<?php endif ?>

                            <?php if(EM::is_event_finished()): ?>
                                <p class="event-warning" role="alert">
                                    <?php _e("Evento já realizado", "events-masters") ?>
                                </p>
                            <?php endif ?>


                            <div class="entry">
                                <div><?php the_content() ?></div>

                                <p class="col-md-12 text-center">
                                    <a href="<?php echo EM::get_the_field('external_link') ?>"
                                       class="btn btn-danger btn-lg btn-primary">+ detalhes do evento</a>
                                </p>

								<?php if ( get_post()->_local === "PRESENTIAL" && EM::get_the_place() ) : ?>
                                    <section id="event-location">
                                        <h2><?php _e("Local do evento", "events-masters") ?></h2>
                                        <address class="event-place">
                                            <h4><?php echo get_the_title( EM::get_the_place() ) ?></h4>
                                            <?= EM::get_the_place()->_address ?>, <?php echo EM::get_the_place()->_city ?>
                                            <?php if(EM::get_the_place()->_short_link_maps): ?>
                                                <a href="<?php echo EM::get_the_place()->_short_link_maps ?>" target="_blank"><?php _e("- Mapa", "events-masters") ?></a>
                                            <?php endif ?>
                                            <br>

                                            <a href="tel:<?php echo EM::get_the_place()->_phone ?>" target="_blank"><?php echo EM::get_the_place()->_phone ?></a>
                                            <?php if(EM::get_the_place()->_site): ?>
                                                <br>
                                                <a href="<?php echo EM::get_the_place()->_site ?>" target="_blank"><?php echo EM::get_the_place()->_site ?></a>
                                            <?php endif ?>
                                        </address>
                                    </section>
								<?php endif ?>

                            </div>

                            <div class="clearfix"></div>

                        </article> <!--post -->

                        <div class="clearfix"></div>

                        <aside id="author-info" class="clearfix">
                            <h3><?php _e("Organizador", "events-masters") ?></h3>
                            <div class="author-image">
                                <a href="http://demo.themely.com/integral/author/admin/">
                                    <img alt=""
                                         src="<?php echo EM::get_the_organizer()->_thumb_url ?: 'http://mscivilrightsproject.org/wp-content/themes/civil-rights-blank-theme/css/img/person-icon.png'?>"
                                         class="avatar avatar-160 photo"
                                         height="160" width="160">
                                </a>
                            </div>
                            <div class="author-bio">
                                <h4>
                                    <a href="<?php echo get_the_permalink( EM::get_the_organizer() ) ?>">
										<?= get_the_title( EM::get_the_organizer() ) ?>
                                    </a>
                                </h4>
                                <div>
									<?php echo apply_filters( 'the_content', EM::get_the_organizer()->post_content ) ?>
                                </div>
                            </div>
                        </aside>
					<?php endwhile; ?>

                </div><!--content-->
            </div>

			<?php get_sidebar(); ?>

        </div>
    </div>

<?php get_footer(); ?>