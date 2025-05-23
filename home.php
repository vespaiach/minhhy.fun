<?php
$all_categories = get_categories(array('hide_empty' => true, ));
$recent_posts = wp_get_recent_posts(array(
	'numberposts' => 5,
	'post_status' => 'publish',
	'orderby' => 'post_date',
	'order' => 'DESC',
), OBJECT);
set_query_var('recent_posts', $recent_posts);
set_query_var('all_categories', $all_categories);


get_header();
?>

<div class="view-port">
	<?php get_sidebar(); ?>
	<main class="flex-1 pt-10 xl:pt-18">
		<?php get_template_part('template-parts/posts'); ?>
		<?php get_footer(); ?>
	</main>
</div>
</body>
</html>