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
		
		$cluster_field_key = "field_576ebddb6a863"; //primary cluster
		$cluster_field = get_field_object($cluster_field_key);
		
		$segment_field_key = "field_576ebe8d07736"; //segments
		$segment_field = get_field_object($segment_field_key);
		
		$cluster  = isset($_GET['cluster']) ? $_GET['cluster'] : '';
		$segments = isset($_GET['segments']) ? $_GET['segments'] : '';
		
		$filter_query = new WP_Query($args);
	?>
	
	<form method="get" id="directory-search">
		<div class="directory-search-row">
			<label for="directory-search-title">Name</label>
			<input name="post_title" id="directory-search-title" type="search">
		</div>
		
		<div class="directory-search-row">
			<label for="directory-search-cluster">
				<select id="directory-search-cluster" name="cluster">
					<?php foreach($cluster['choices'] as $option_key => $option_value) : ?>
						<option value="<?php echo $option_value; ?>"><?php echo $option_value; ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		</div>
		
		<div class="directory-search-row">
			<label for="directory-search-segment">
				<?php foreach($cluster['choices'] as $option_key => $option_value) : ?>
					<input type="checkbox" value="<?php echo $option_value; ?>" id="directory-segment-<?php echo $option_key; ?>"><label for="directory-segment-<?php echo $option_key; ?>"><?php echo $option_value; ?></label>
				<?php endforeach; ?>
			</label>
		</div>
		
		<div class="directory-search-row">
			<input type="submit" class="button">
		</div>
	</form>
	
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
