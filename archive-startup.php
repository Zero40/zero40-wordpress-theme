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

                <div id="startups">

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" class="card">
                        <div class="post-image">
                            <?php the_post_thumbnail('integral-post-thumbnails',array('class'=>'card-img-top ')); ?>
                        </div>
                        <div class=" card-body">
                            <h5 class="card-title h3 text-warning "><?php the_title(); ?></h5>
                            <p class="card-text"> <?php echo wp_trim_words(get_the_excerpt(), 21, null) ; ?></p>
                            <p>
                            <div><?='<span class="font-weight-bold team-size">Tamanho: </span>' .  getTeamSize() ?></div>
                            <div><?='<span class="font-weight-bold">Momento Atual: </span>' .  getActualMoment(true) ?></div>
                            <div><?='<span class="font-weight-bold">Público Alvo: </span>' .  getTarget(true) ?></div>
                            <div><?='<span class="font-weight-bold">Modelo de Negócio: </span>' .  getBusinessModel(true) ?></div>
                            <div>
                                <?php 
                                    // Filtra apenas as 5 primeiras áreas 
                                    $areas = implode(' • ', array_slice(getBusinessArea(true), -6) );
                                    // Pega o total de áreas
                                    $areas_total = sizeof(getBusinessArea(true));
                                    echo '<span class="font-weight-bold">Áreas de Negócio: </span> ';
                                    echo'<span class="badge-light"> ' . $areas ;
                                    echo $areas_total > 5 ? ' <span class="badge"> +' .  ($areas_total - 5 ).  '</span>'  : '';
                                    ?>
                            </div>
                            </p>
                            <a href="<?php the_permalink() ?>" class="btn btn-primary">Saiba Mais</a>
                        </div>
                    </article>
                    <?php endwhile;?>
                    <?php endif; ?>

                    <?php the_posts_pagination( array(
                    'mid_size' => 2,
                    'prev_text' => __( 'Previous', 'integral' ),
                    'next_text' => __( 'Next', 'integral' ),
                    'screen_reader_text' => __( '&nbsp;', 'integral' ),
                ) ); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>