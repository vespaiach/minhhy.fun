<?php
if (!defined('ABSPATH')) {
	exit;
}
?>

<?php
if (have_posts()):
	echo '<section class="px-gutter w-full page-max-width mx-auto mt-14">';
	echo '<ul class="space-y-22">';
	while (have_posts()):
		the_post();
		get_template_part('template-parts/content');
	endwhile;
	echo '</ul>';
	echo '</section>';
else:
	echo '<p>No posts found.</p>';
endif;