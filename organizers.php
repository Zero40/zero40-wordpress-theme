<?php
$organizers = getOrganizers();
$title = null;
?>
<section id="blog" class="blog lite">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="smalltitle"><?php if(is_null($title)){echo "Organizadores";}else{echo $title;}?><span></span></h2>
            </div>
        </div>
        <div class="row multi-columns-row">
            <?php
            foreach ($organizers as $organizer){?>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <article id="post-<?=$organizer->id?>">
                        <div class="home-blog-entry-thumb">
                            <a href="#" rel="bookmark" title="<?=$organizer->title?>"><figure class="post-image"><img src="<?php echo get_template_directory_uri()?>/images/bg-cta.jpg" class="img-responsive integral-home-post-thumbnails" sizes="integral-home-post-thumbnails"/></figure></a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="home-blog-entry-text">
                            <header>
                                <h3><a href="#" rel="bookmark" title="<?=$organizer->title ?>"><?=$organizer->title?></a></h3>
                            </header>
                        </div>
                    </article>
                </div>
            <?php }?>
        </div>
    </div>
</section>