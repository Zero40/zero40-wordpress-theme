<?php get_header(); ?>

<div class="spacer"></div>

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="content container">

                <header class="page-header">
                    <h1>Startups de Juiz de Fora</h1>
                </header>

                <p><?=get_the_post_type_description() ?></p>

                <hr/>

                <div class="post-list flexbox row startups" id="startups">

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('post-item col'); ?>>

                    <?php if(get_the_post_thumbnail()) { ?>
                        <figure class="post-image flexbox">
                            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                                <?php the_post_thumbnail('integral-post-thumbnails',array('class'=>'img-responsive')); ?>
                            </a>
                        </figure>
                    <?php } ?>

                    <div class="row row-cols-1 startup-details">
                        <div class="col"><?=getActualMoment() ?></div>
                        <div class="col"><?=getTarget() ?></div>
                        <div class="col"><?=getBusinessModel() ?></div>
                        <div class="col"><?=getBusinessArea() ?></div>
                        <div class="col"><?=getTeamSize() ?></div>
                    </div>

                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

                    <?php the_excerpt(); ?>

                 </article> <!--post -->

                 <?php endwhile;?>
                 <?php endif; ?>

                <?php the_posts_pagination( array(
                    'mid_size' => 2,
                    'prev_text' => __( 'Previous', 'integral' ),
                    'next_text' => __( 'Next', 'integral' ),
                    'screen_reader_text' => __( '&nbsp;', 'integral' ),
                ) ); ?>

                </div>
            </div><!--content-->
        </div>

    </div>
</div>

<?php get_footer(); ?>