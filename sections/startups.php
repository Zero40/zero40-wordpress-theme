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
get_template_part('sections/featured-startup' );
?>
<section id="projects-grid" class="projects-grid lite no-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="smalltitle">Startups de Juiz de Fora<span></span></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>As startups de Juiz de Fora estão ganhando o mundo!</h3>
                <h4><b><? echo wp_count_posts('startup')->publish; ?> Startups</b> Mapeadas</h4>
                <h4>Principal área de atuação - <b>SAASS</b></h4>
                <h4>Melhor momento atual - <b>operação</b></h4>
                <p>Principal incubadora - <b>CRITT / UFJF</b></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="https://zero40.com.br/startups/" class="btn btn-danger btn-lg btn-primary">
                    Conhecer startups
                </a><br/><br/>
                <a href="https://zero40.com.br/mapeamentos-de-startups-de-juiz-de-fora/" class="btn btn-danger btn-primary">
                    Incluir Startup
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