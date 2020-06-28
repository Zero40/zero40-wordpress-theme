<?php get_header(); ?>

<div class="spacer"></div>

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <main class="content" id="startups">

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <header class="page-header flexbox">

                    <h1><?php the_title(); ?></h1>

                    <?php if(get_the_post_thumbnail()) { ?>
                        <figure class="post-image">
                            <?php the_post_thumbnail('large', array('class'=>'img-responsive')); ?>
                        </figure>
                    <?php } ?>

                </header>

                <?php
                    $description = get_field('description');
                    if($description) echo $description;
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="grid">

                    <?php
                        $founders = get_field('founders');
                        $founded_in = get_field('founded_in');
                        $email = get_field('email');
                        $phone = get_field('phone');
                        $website = get_field('website');
                        $location = get_field('location');
                        $gender = get_field('gender');
                        $age = get_field('age');
                        $team_size = get_field('team_size');
                        $actual_moment = get_field('actual_moment');
                        $target = get_field('target');
                        $business_area = get_field('business_area');
                        $innovation = get_field('innovation');
                        $business_model = get_field('business_model');
                        $jafoi = get_field('jafoi');
                        $investimento = get_field('investimento');
                        $annual_billing = get_field('annual_billing');
                    ?>


                    <?php if($founders){ ?>

                        <div class="grid-item">
                            <h2>Fundadores</h2>
                            <p><?= $founders ?></p>
                        </div>
                    <?php } ?>


                    <?php if($founded_in){ ?>
                        <div class="grid-item">
                            <h2>Data Fundação</h2>
                            <p><?= $founded_in ?></p>
                        </div>
                    <?php } ?>


                    <?php if($location){ ?>
                        <div class="grid-item">
                            <h2>Cidade</h2>
                            <p><?= $location ?></p>
                        </div>
                    <?php } ?>


                    <?php if($email){ ?>
                        <div class="grid-item">
                            <h2>Email</h2>
                            <p><a href="mailto:<?= $email ?>" target="_blank"><?= $email ?></a></p>
                        </div>
                    <?php } ?>


                    <?php if($phone){ ?>
                        <div class="grid-item">
                            <h2>Telefone</h2>
                            <p><?= $phone ?></p>
                        </div>
                    <?php } ?>


                    <?php if($website){ ?>
                        <div class="grid-item">
                            <h2>Website</h2>
                            <p><a href="<?= $website ?>" target="_blank"><?= $website ?></a></p>
                        </div>
                    <?php } ?>

                    <?php if($team_size){ ?>
                        <div class="grid-item">
                            <h2>Tamanho da equipe</h2>
                            <p><?= $team_size ?></p>
                        </div>
                    <?php } ?>


                    <?php if($gender){ ?>
                        <div class="grid-item">
                            <h2>Gênero de quem fundou</h2>
                            <p><?= $gender ?></p>
                        </div>
                    <?php } ?>


                    <?php if($age){ ?>
                        <div class="grid-item">
                            <h2>Idade de quem fundou</h2>
                            <p><?= $age ?></p>
                        </div>
                    <?php } ?>



                    <?php if($jafoi){ ?>
                        <div class="grid-item">
                            <h2>Já foi:</h2>
                            <p><?= $jafoi ?></p>
                        </div>
                    <?php } ?>




                    <?php if($investimento){ ?>
                        <div class="grid-item">
                            <h2>Recebeu investimento?</h2>
                            <p><?= $investimento ?></p>
                        </div>
                    <?php } ?>




                    <?php if($annual_billing){ ?>
                        <div class="grid-item">
                            <h2>Faixa de faturamento</h2>
                            <p><?= $annual_billing ?></p>
                        </div>
                    <?php } ?>




                    <?php if($business_area){ ?>
                        <div class="grid-item">
                            <h2>Área de atuação</h2>
                            <p><?php
                                $index = 1;
                                foreach ($business_area as $area) {
                                    if($index > 1) echo '<br>';
                                    echo '- '. $area;
                                    $index++;
                                }
                            ?></p>

                        </div>
                    <?php } ?>

                    <?php if($target){ ?>
                        <div class="grid-item">
                            <h2>Público-alvo</h2>
                            <p><?= $target ?></p>
                        </div>
                    <?php } ?>

                    <div class="fake-item"></div>


                    </div>


                    <?php if($actual_moment){ ?>
                        <div class="grid-full">
                            <h2>Momento atual</h2>
                            <p><?= $actual_moment ?></p>
                        </div>
                    <?php } ?>


                    <?php if($innovation){ ?>
                        <div class="grid-full">
                            <h2>Tipo de Inovação</h2>
                            <p><?php
                                $index = 1;
                                foreach ($innovation as $inova) {
                                    if($index > 1) echo '<br>';
                                    echo '- '. $inova;
                                    $index++;
                                }
                            ?></p>
                        </div>
                    <?php } ?>


                    <?php if($business_model){ ?>
                        <div class="grid-full">
                            <h2>Modelo de negócio</h2>
                            <p><?= $business_model ?></p>
                        </div>
                    <?php } ?>

                 </article> <!--post -->

             <?php endwhile; endif; ?>

            </main><!--content-->
        </div>

    </div>
</div>

<?php get_footer(); ?>