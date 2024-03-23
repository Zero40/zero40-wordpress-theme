<?php
?>
<section id="projects-grid" class="projects-grid lite no-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="smalltitle">Agenda de eventos em Juiz de Fora<span></span></h2>
            </div>
        </div>

        <?php echo do_shortcode( '[events_list scope="future" limit=5 pagination=1]' ) ?>

        <div class="row" style="margin-top: 40px">
            <div class="col-md-12 text-center">
                <a href="<?= get_site_url() . "/adicionar-evento/" ?>" class="btn btn-danger btn-lg btn-primary">
                    Incluir Evento
                </a><br><br>
                <a href="<?= get_site_url() . "/eventos" ?>" class="btn btn-danger btn-primary">
                    Todos os eventos
                </a>
            </div>
        </div>
    </div>

</section>


<?php