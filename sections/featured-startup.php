<?php $featured = queryPostAcordingDay('startup'); ?>
<section>
    <div class="container">
        <h2 class="smalltitle">Startup em Destaque<span style="background: var(--yellow)"></span></h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="border d-lg-flex align-items-stretch">
                <div>
                    <div style="height:100%;" class="col-md-4 py-5 py-lg-0  d-flex justify-content-center align-items-center">
                        <img src="<?php echo get_the_post_thumbnail_url($featured); ?>" class="img-fluid  rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">

                            <h5 class="card-title h3"><?php echo get_the_title($featured);  ?> <span style="background: #fff6d7!important;"
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark"><i style="color: var(--yellow)" class="fa fa-star "></i></span> </h5>
                            <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 40, null); ?></p>
                            <p>
                            <div><?='<span class="font-weight-bold team-size">Tamanho: </span>' .  getTeamSize(false, $featured->ID) ?></div>
                            <div><?='<span class="font-weight-bold">Momento Atual: </span>' .  getActualMoment(true, $featured->ID) ?></div>
                            <div><?='<span class="font-weight-bold">Público Alvo: </span>' .  getTarget(true, $featured->ID) ?></div>
                            <div><?='<span class="font-weight-bold">Modelo de Negócio: </span>' .  getBusinessModel(true, $featured->ID) ?></div>
                            <div>
                                <?php 
                                    // Filtra apenas as 5 primeiras áreas 
                                    $areas = implode(' • ', array_slice(getBusinessArea(true, $featured->ID), -6) );
                                    // Pega o total de áreas
                                    $areas_total = sizeof(getBusinessArea(true, $featured->ID));
                                    echo '<span class="font-weight-bold">Áreas de Negócio: </span> ';
                                    echo'<span> ' . $areas ;
                                    echo $areas_total > 5 ? ' <span class="badge"> +' .  ($areas_total - 5 ) . '</span>'  : '';
                                    ?>
                            </div>
                            </p>
                            <a style="margin-bottom: 20px;" href="<?php echo get_the_permalink($featured) ?>" class="btn btn-primary">Saiba Mais</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>