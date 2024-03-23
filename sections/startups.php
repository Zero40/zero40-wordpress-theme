<?php
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

                <div style="margin: 20px">
                <h4><b><? echo wp_count_posts('startup')->publish; ?> Startups</b> Mapeadas</h4>
                <h4>Principal área de atuação - <b>SAASS</b></h4>
                <h4>Melhor momento atual - <b>operação</b></h4>
                </div>

                <div style="margin: 20px">
                    Incubadora de empresas - <b><a href="https://www2.ufjf.br/critt/">CRITT / UFJF</a></b><br/>
                    Hub de Inovação - <b><a href="https://www.nossomoinho.com/">Moinho</a></b>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="https://zero40.com.br/startups/" class="btn btn-danger btn-lg btn-primary">
                    Conhecer startups
                </a><br/><br/>
                <a href="https://zero40.com.br/incluir-startup/" class="btn btn-danger btn-primary">
                    Incluir Startup
                </a>
            </div>
        </div>
    </div>

</section>

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