<?php
if (!defined('ABSPATH')) {
	exit;
}
?>

<?php
if (have_posts()):
	echo '<section class="px-gutter w-full page-max-width mx-auto">';
	echo '<ul class="space-y-20 md:space-y-28 list-none! pl-0!">';
	while (have_posts()):
		the_post();
		get_template_part('template-parts/content');
	endwhile;
	echo '</ul>';
	echo '</section>';
else:
	echo '<p>No posts found.</p>';
endif;