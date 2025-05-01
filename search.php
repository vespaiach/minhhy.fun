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
?>
<div class="flex flex-col lg:flex-row">
	<?php get_sidebar(); ?>
	<main class="flex-1">
		<header class="bg-stone-100 py-16">
			<div class="px-gutter w-full page-max-width mx-auto space-y-6">
				<h1 class="mb-8 font-sans text-gray-900">Search Results for: <?php echo get_search_query(); ?></h1>
				<?= get_search_form(); ?>
			</div>
		</header>
		<section class="mt-18"><?php get_template_part( 'template-parts/posts' ); ?></section>
		<?php get_footer(); ?>
	</main>
</div>