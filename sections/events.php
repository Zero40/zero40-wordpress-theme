<?php
/**
 * Created by PhpStorm.
 * User: tiagogouvea
 * Date: 08/11/18
 * Time: 07:53
 */
?>

<?php
//$auth = is_authorized();
//$events = EventsManager::getWillHappen();
?>
<section id="projects-grid" class="projects-grid lite no-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="smalltitle">Agenda de eventos da cidade<span></span></h2>
            </div>
        </div>
        	    <?php echo do_shortcode( '[em-events filters="current,future" orderby="starts_at"]' ) ?>

        <div class="row">
            <div class="col-md-12 text-center">
                <a href="<?= get_site_url() . "/incluir-evento/" ?>" class="btn btn-danger btn-lg btn-primary">
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


function truncate($text, $chars = 25) {
    if (strlen( $text ) <= $chars) {
        return $text;
    }
    $text = $text . " ";
    $text = substr( $text, 0, $chars );
    $text = substr( $text, 0, strrpos( $text, ' ' ) );
    $text = $text . "...";

    return $text;
}

?>
<style>
    .actions-container {
        display: flex;
        justify-content: space-around;
    }

    .flex-collumn {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 1.3em;
    }

    .card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .aprovado b {
        color: green;
    }

    .reprovado b {
        color: red;
    }
</style>

<?php //if (!is_null($published) && $published === true) { ?>
<!--    <p class="alert alert-success text-center aprovado"><b>Aprovação</b> de evento efetuada com sucesso</p>-->
<?php //}
//if (!is_null($published) && $published === false) { ?>
<!--    <p class="alert alert-danger text-center aprovado"><b>Aprovação</b> não efetuada, houve algum erro!</p>-->
<?php //} ?>
<!---->
<?php //if (!is_null($unpublished) && $unpublished === true) { ?>
<!--    <p class="alert alert-success text-center reprovado"><b>Reprovação</b> de evento efetuado com sucesso</p>-->
<?php //}
//if (!is_null($unpublished) && $unpublished === false) { ?>
<!--    <p class="alert alert-danger text-center reprovado"><b>Reprovação</b> não efetuada, houve algum erro!</p>-->
<?php //} ?>


<!--Para validar o evento é necessário saber a capacidade-->
<!--Para validar o evento é necessário uma data para inscrições-->