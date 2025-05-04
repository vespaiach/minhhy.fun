<?php
$all_categories = get_categories( array( 'hide_empty' => true, ) );
$recent_posts   = wp_get_recent_posts( array(
	'numberposts' => 5,
	'post_status' => 'publish',
	'orderby' => 'post_date',
	'order' => 'DESC',
), OBJECT );
set_query_var( 'recent_posts', $recent_posts );
set_query_var( 'all_categories', $all_categories );

get_header();

$category             = get_queried_object();
$category_post_count  = $category->count;
$category_name        = esc_html( $category->name );
$category_description = category_description( $category->term_id );

?>
<div class="view-port">
	<?php get_sidebar(); ?>
	<main class="flex-1">
		<?php render_top_section( array(
			'line1' => '<p>' . $category_post_count . ' Post' . ( $category_post_count !== 1 ? 's' : '' ) . '</p>',
			'line2' => '<h1>Category: ' . $category_name . '</h1>',
			'line3' => '<p>' . $category_description . '</p>'
		) ); ?>
		<?php get_template_part( 'template-parts/posts' ); ?>
		<?php get_footer(); ?>
	</main>
</div>
</body>
</html>