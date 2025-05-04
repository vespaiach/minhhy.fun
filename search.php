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
<div class="view-port">
	<?php get_sidebar(); ?>
	<main class="flex-1">
		<section class="mb-18">
			<header class="bg-stone-100">
				<div class="page">
					<div class="py-18 lg:22 space-y-6">
						<h1 class="mb-8 font-sans text-gray-900">Search Results for: <?php echo get_search_query(); ?></h1>
						<?= get_search_form(); ?>
					</div>
				</div>
			</header>
		</section>
		<?php get_template_part( 'template-parts/posts' ); ?>
		<?php get_footer(); ?>
	</main>
</div>

</body>

</html>