<?php
/**
 * The template part for displaying the enterprise search form
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
		
		$purpose_field_key = "field_576ebe5d07734"; //purpose
		$purpose_field = get_field_object($purpose_field_key);
		
		$cluster  = isset($_GET['cluster']) ? $_GET['cluster'] : '';
		$segments = isset($_GET['segments']) ? $_GET['segments'] : '';
		$purpose  = isset($_GET['purpose']) ? $_GET['purpose'] : '';
		$keyword  = isset($_GET['keyword']) ? sanitize_text_field($_GET['keyword']) : '';
		
		$args_meta = array('relation' => 'OR');
		
		if($keyword) {
			$args['s'] = $keyword;
		}
		
		if($cluster) {
			$args_meta[] = array(
				'key'     => 'primary_cluster',
				'value'   => $cluster,
				'compare' => 'LIKE',
			);
			$args_meta[] = array(
				'key'     => 'secondary_cluster',
				'value'   => $cluster,
				'compare' => 'LIKE',
			);
		}
		
		if($purpose) {
			$args_meta[] = array(
				'key'     => 'primary_purpose',
				'value'   => $purpose,
				'compare' => 'LIKE',
			);
			$args_meta[] = array(
				'key'     => 'secondary_purpose',
				'value'   => $purpose,
				'compare' => 'LIKE',
			);
		}
		
		if($segments) {
			$args_meta[] = array(
				'key'     => 'customer_segments',
				'value'   => $segments,
				'compare' => 'IN',
			);
		}
		
		$args['meta_query'] = $args_meta;
		
		$filter_query = new WP_Query($args);
	?>
	
	<form method="get" id="directory-search" class="clear">
		<div class="directory-search-row">
			<label for="directory-search-title">Name</label>
			<input name="keyword" id="directory-search-title" type="search" value="">
		</div>
		
		<div class="directory-search-row">
			<p><strong>Cluster</strong></p>
			<label for="directory-search-cluster">
				<select id="directory-search-cluster" name="cluster">
					<option value="">Select Cluster</option>
					<?php foreach($cluster_field['choices'] as $option_key => $option_value) : ?>
						<option value="<?php echo $option_value; ?>"<?php if($option_value == $cluster) {?> selected="selected"<?php } ?>><?php echo $option_value; ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		</div>
		
		<div class="directory-search-row">
			<p><strong>Purpose</strong></p>
			<label for="directory-search-purpose">
				<select id="directory-search-purpose" name="purpose">
					<option value="">Select Purpose</option>
					<?php foreach($purpose_field['choices'] as $option_key => $option_value) : ?>
						<option value="<?php echo $option_value; ?>"<?php if($option_value == $purpose) {?> selected="selected"<?php } ?>><?php echo $option_value; ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		</div>
		
		<div class="directory-search-row">
			<p><strong>Segments</strong></p>
			<label for="directory-search-segment">
				<?php foreach($segment_field['choices'] as $option_key => $option_value) : ?>
				
					<input type="checkbox"name="segments[]" value="<?php echo $option_value; ?>" id="directory-segment-<?php echo $option_key; ?>"<?php if(in_array($option_value, $segments)) {?> checked="checked"<?php } ?>> <label for="directory-segment-<?php echo $option_key; ?>"><?php echo $option_value; ?></label>
				<?php endforeach; ?>
			</label>
		</div>
		
		<div class="directory-search-row">
			<a href="<?php echo get_permalink(34); ?>" class="btn btn-default read-more">Reset</a> 
			<input type="submit" class="btn btn-default read-more">
		</div>
	</form>
	
	<div class="search-results enterprise-list" class="clear">
		<?php if ( $filter_query->have_posts() ) : while ( $filter_query->have_posts() ) : $filter_query->the_post(); ?>
		<article>
			<h2><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h2>
			<?php echo get_field('description_of_business', $post->ID); ?>
		</article>
		<?php endwhile; endif; ?>
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
