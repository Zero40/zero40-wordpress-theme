<?php
// Single event

get_header(); ?>

    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="content">


					<?php while ( have_posts() ): the_post() ?>
                        <article id="event-<?php the_ID() ?>" <?php post_class() ?>>
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
                                        <li><i class="fa fa-tag"></i><?= get_term_field( 'title', $tag ) ?></li>
									<?php endforeach; ?>
                                </ul>
							<?php endif ?>

                            <div class="entry">

                                <div><?php the_content() ?></div>

                                <p><a href="<?= get_post()->_external_link ?>">Website do evento</a></p>

								<?php if ( get_post()->_local == "PRESENTIAL" ) : ?>
                                    Local: <?= get_the_title( EM::get_the_place() ) ?><br>
                                    Endereço: <?= EM::get_the_place()->_address ?>
								<?php endif ?>

                            </div>

                            <div class="clearfix"></div>

							<?= do_shortcode( '[addtoany]' ); ?>

                        </article> <!--post -->


                        <div class="clearfix"></div>

                        <aside id="author-info" class="clearfix">
                            <div class="author-image">
                                <a href="http://demo.themely.com/integral/author/admin/">
                                    <img alt=""
                                         src="http://2.gravatar.com/avatar/b5f65448f343496a1cdd03c5a2abbe4b?s=160&amp;d=mm&amp;r=g"
                                         srcset="http://2.gravatar.com/avatar/b5f65448f343496a1cdd03c5a2abbe4b?s=320&amp;d=mm&amp;r=g 2x"
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
                                Founder @ Themely, entrepreneur and travel addict. Always learning, maverik at heart,
                                speaks
                                3 languages and hope's to go to space one day.
                            </div>
                        </aside>
					<?php endwhile; ?>

                </div><!--content-->
            </div>

			<?php get_sidebar(); ?>

        </div>
    </div>

<?php get_footer(); ?>