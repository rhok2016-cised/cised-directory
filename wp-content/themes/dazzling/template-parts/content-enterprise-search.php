<?php
/**
 * The template part for displaying the enterprise search formc
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'twentysixteen' ); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php the_content(); ?>

	<?php
		$args = array(
			'post_type' => 'social-enterprise',
			'orderby'   => 'title',
			'order'     => 'ASC',
		);
		
		$cluster  = isset($_GET['cluster']) ? $_GET['cluster'] : '';
		$segments = isset($_GET['segments']) ? $_GET['segments'] : '';
		
	?>
	
	
	
	<div class="search-results enterprise-list">
		
		<article>
			<h2><?php echo $post->post_title; ?></h2>
			<?php echo get_field('description_of_business', $post->ID); ?>
		</article>
		
	</div>

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
