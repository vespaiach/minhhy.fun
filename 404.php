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
		<section class="py-22 page">
			<h1 class="mb-8">Oops! That page can’t be found.</h1>
			<?= get_search_form(); ?>
		</section>
		<?= get_footer(); ?>
	</main>
</div>