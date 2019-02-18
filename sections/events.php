<?php
/**
 * Created by PhpStorm.
 * User: tiagogouvea
 * Date: 08/11/18
 * Time: 07:53
 */
?>

<?php
$auth = is_authorized();
$events = EventsManager::getWillHappen();
?>
<section id="projects-grid" class="projects-grid lite no-padding-bottom">
    <div class="row">
        <div class="col-md-12">
            <h2 class="smalltitle">Agenda de Eventos<span></span></h2>
        </div>
    </div>
    <div class="row multi-columns-row">
        <?php
        foreach ($events as $event) {
            ?>
            <div class="col-sm-4 col-md-4 col-lg-4 grid" data-sr-id="<?= $event->id ?>"
                 style="; margin-bottom: 30px; visibility: visible;  -webkit-transform: translateY(0) scale(1) rotateZ(0); opacity: 1;transform: translateY(0) scale(1) rotateZ(0); opacity: 1;-webkit-transition: -webkit-transform 0.9s ease-in-out 0.2s, opacity 0.9s ease-in-out 0.2s; transition: transform 0.9s ease-in-out 0.2s, opacity 0.9s ease-in-out 0.2s; ">
                <a href=<?= get_site_url() . "/evento/" . $event->id . "/" ?> rel="prettyPhoto"
                   title="<?= $event->title ?>" class="fancybox-thumb hovereffect">
                    <img src="<?= $event->thumb_url ?>" alt="<?= $event->title ?>"
                         class="img-responsive center-block">
                </a>
                <h3 class="widget-title"><?= $event->title ?></h3>

                <h5><?= $when ?><?= $event->starts_at->format('d/m \à\s H:i\h\s') ?></h5>
                <h5><small><?= $event->place->title ?></small></h5>
                <h5><small><?= $event->organizer->title ?></small></h5>
            </div>
        <?php } ?>
    </div>

    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12 text-center">
            <a href="<?= get_site_url() . "/incluir-evento/" ?>" class="btn btn-danger btn-lg btn-primary">Incluir
                Evento</a>
        </div>
    </div>


    <?php

    if (EventsManager::isAutenticated()) {
        $events = EventsManager::getFutureEventsPendingConfirmation();
    }
    ?>

</section>


<?php


function truncate($text, $chars = 25)
{
    if (strlen($text) <= $chars) {
        return $text;
    }
    $text = $text . " ";
    $text = substr($text, 0, $chars);
    $text = substr($text, 0, strrpos($text, ' '));
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

<?php if (!is_null($published) && $published === true) { ?>
    <p class="alert alert-success text-center aprovado"><b>Aprovação</b> de evento efetuada com sucesso</p>
<?php }
if (!is_null($published) && $published === false) { ?>
    <p class="alert alert-danger text-center aprovado"><b>Aprovação</b> não efetuada, houve algum erro!</p>
<?php } ?>

<?php if (!is_null($unpublished) && $unpublished === true) { ?>
    <p class="alert alert-success text-center reprovado"><b>Reprovação</b> de evento efetuado com sucesso</p>
<?php }
if (!is_null($unpublished) && $unpublished === false) { ?>
    <p class="alert alert-danger text-center reprovado"><b>Reprovação</b> não efetuada, houve algum erro!</p>
<?php } ?>


<!--Para validar o evento é necessário saber a capacidade-->
<!--Para validar o evento é necessário uma data para inscrições-->