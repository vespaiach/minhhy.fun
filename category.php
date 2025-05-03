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
<div class="flex flex-col lg:flex-row">
	<?php get_sidebar(); ?>
	<main class="flex-1">
		<section class="mb-18">
			<header class="bg-stone-100 py-16">
				<div class="px-gutter w-full page-max-width mx-auto space-y-6">
					<p><?php echo $category_post_count; ?> Post<?php echo ( $category_post_count !== 1 ) ? 's' : ''; ?></p>
					<h1>
						Category: <?php echo $category_name; ?>
					</h1>
					<p><?php echo $category_description; ?></p>
				</div>
			</header>
		</section>
		<?php get_template_part( 'template-parts/posts' ); ?>
		<?php get_footer(); ?>
	</main>
</div>
</body>
</html>