<?php
/**
 * Template Name: Enterprise Listing/Search
 *
 * @package dazzling
 */

get_header(); ?>
	<div id="primary" class="content-area col-sm-12 col-md-12">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content-social-enterprise', 'single' ); ?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
