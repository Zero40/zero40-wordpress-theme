<?php
/*
Template Name: Form Cadastro
*/
?>

<?php get_header(); ?>

<div class="spacer"></div>

<div class="container">

	<div class="row">

		<div class="<?php if ( is_active_sidebar( 'rightbar' ) ) : ?>col-md-8<?php else : ?>col-md-12<?php endif; ?>">

			<main class="content" id="cadastro">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			     <h1 class="entry-title"><?php the_title(); ?></h1>

			     <div class="entry">

			       <?php the_content(); ?>

			     </div>


			 </div>

			 <?php endwhile;?>

			 <?php endif; ?>


			</main>

		</div>

		<?php get_sidebar(); ?>

	</div>

</div>

<?php get_footer(); ?>