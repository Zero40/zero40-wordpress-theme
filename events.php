<?php
$events = getEvents();
$title = getTitle();
$auth = is_authorized();

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

<section id="blog" class="blog lite">
    <div class="row multi-columns-row flex-collumn">
        <?php if ($events == null || count($events) == 0): ?>
            <p>Nenhum evento agendado no momento</p>
        <? else: ?>
            <?php
            foreach ($events as $event) {
                $toValidate = $event->willHappen() && $event->published == null && $auth;
                $cardStyle = $toValidate ? "background-color: rgba(254,49,0,0.13);" : null;
                $when = $event->happened() ? "Realizado em " : "";

                ?>
                <div class="col-sm-6 col-md-6 col-lg-6 flex-collumn">
                    <article id="post-<?= $event->id ?>" class="card" style="<?= $cardStyle ?>">
                        <div>
                            <div class="home-blog-entry-thumb">
                                <a href="/zero40/evento/<?= $event->id ?>/" rel="bookmark" title="<?= $event->title ?>">
                                    <figure class="post-image"><img src="<?= $event->thumb_url ?>"
                                                                    class="img-responsive integral-home-post-thumbnails"
                                                                    sizes="integral-home-post-thumbnails"/></figure>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="home-blog-entry-text">
                                <header>
                                    <h5><?= $when ?><?= $event->starts_at->format('d/m \à\s H:i\h\s') ?></h5>
                                    <h5><small><?= $event->place->title ?></small></h5>
                                    <h3><a href="/zero40/evento/<?= $event->id ?>/" rel="bookmark"
                                           title="<?= $event->title ?>"><?= $event->title ?></a></h3>
                                    <h5><small><?= $event->organizer->title ?></small></h5>
                                    <div class="home-blog-entry-date">
                                        <ul class="pagemeta">
                                            <li></li>
                                        </ul>
                                    </div>
                                </header>
                                <?php if ($event->willHappen() && !is_null($event->subscription_starts_at) && !is_null($event->subscription_finsh_at)) { ?>
                                    <p>Inscrições em: <?= $event->subscription_starts_at ?>
                                        a <?= $event->subscription_finsh_at ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if ($toValidate) { ?>
                            <div style="padding: 10px; text-align: center;">
                                <p>Evento pendente de aprovação</p>

                                <div class="actions-container">
                                    <a href="?publish=<?= $event->id ?>"
                                       class="btn btn-success <?php if (!$event->isReadyToPublish()){
                                       echo 'disabled'; ?>"<?php echo 'disabled="disabled"';
                                    } else echo '"'; ?>>Aprovar</a>
                                    <a href="?unpublish=<?= $event->id ?>"
                                       class="btn btn-danger">Reprovar</a>
                                </div>
                            </div>
                        <?php } ?>
                    </article>
                </div>
            <?php } ?>
        <?php endif; ?>
    </div>

    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12 text-center">
            <a href="<?= get_site_url() . "/incluir-evento/" ?>" class="btn btn-danger btn-lg btn-primary">Incluir
                Evento</a>
        </div>
    </div>

</section>

<!--Para validar o evento é necessário saber a capacidade-->
<!--Para validar o evento é necessário uma data para inscrições-->