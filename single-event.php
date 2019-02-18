<?php
// Get Event
$event = getEvent();
if ($event == null) die('Variável $evento está null.... :(');

$tags = getTags();
?>

<?php get_header(); ?>
<div class="container">
    <div class="row">

        <div class="col-md-8">
            <div class="content">


                <article id="post-193"
                         class="post-193 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
                    <figure class="post-image">
                        <img width="800" height="400" src="<?= $event->image_url ?>" alt="post1"></figure>
                    <div class="clearfix">

                    </div>

                    <h2 class="entry-title">
                        <a href="<?= get_site_url() . "/evento/" . $event->id . "/" ?>"
                           rel="bookmark" title="<?= $event->title ?>">
                            <?= $event->title ?>
                        </a>
                    </h2>

                    <ul class="pagemeta" style="margin-bottom: 0px;">
                        <li><i class="fa fa-clock-o"></i><?= $event->starts_at->format('d/m/Y \à\s H:i:s') ?></li>
                        <li><i class="fa fa-bookmark"></i><?= $event->category->title ?></li>
                        <li><i class="fa fa-comment"></i><?= $event->type->title ?></li>
                    </ul>
                    <ul class="pagemeta">
                        <?php foreach ($tags as $tag): ?>
                            <li><i class="fa fa-tag"></i><?= $tag->title ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="entry">
                        <p><?= $event->description; ?></p>

                        <p><a href="<?= $event->external_link ?>">Website do evento</a></p>
                        <?php if ($event->local == "PRESENTIAL") { ?>
                            Local: <?= $event->place->title ?>
                            Endereço: <?= $event->place->address ?>
                        <?php } ?>

                    </div>

                    <div class="clearfix"></div>

                    <?=do_shortcode('[addtoany]'); ?>

                </article> <!--post -->



                <div class="clearfix"></div>

                <div id="author-info" class="clearfix">
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
                            <a href="<? getOrganizerLink($event) ?>">
                                <?= $event->organizer->title ?>
                            </a>
                        </h4>
                        Founder @ Themely, entrepreneur and travel addict. Always learning, maverik at heart, speaks
                        3 languages and hope's to go to space one day.
                    </div>
                </div>

            </div><!--content-->
        </div>

        <?php get_sidebar(); ?>

    </div>
</div>

<?php get_footer(); ?>