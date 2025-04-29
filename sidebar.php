<?php
$categories = get_categories(array('hide_empty' => true, ));
$recent_posts = wp_get_recent_posts(array(
	'numberposts' => 5,
	'post_status' => 'publish',
	'orderby' => 'post_date',
	'order' => 'DESC',
));
wp_reset_query();
$top_bot_spacing = 20;
$place_holder_height = 80;
$section_gutter = 32;
$site_name_height = 36;
$tag_line_height = 24;
$sub_header_height = 40;
$total_height = 24 * count($categories) + 24 * count($recent_posts) + 2 * $sub_header_height + 2 * $section_gutter + $site_name_height + $tag_line_height + $place_holder_height + $top_bot_spacing;
?>

<aside class="bg-primary text-white aside" style="--total-height: <?php echo esc_html($total_height); ?>px;">
	<div class="w-full max-w-[768px] mx-auto py-6 px-gutter space-y-8">
		<div class="flex items-start justify-between">
			<div>
				<h1 class="font-sans font-bold text-2xl">
					<a href="/">MINH-HY</a>
				</h1>
				<small class="text-xs"><?php echo esc_html(get_bloginfo('description')); ?></small>
			</div>
			<button class="hamburger-button" id="hamburger-button">
				<span class="hamburger-line line-1"></span>
				<span class="hamburger-line line-2"></span>
				<span class="hamburger-line line-3"></span>
			</button>
		</div>
		<div>
			<p class="font-sans text-xl">RECENT POSTS</p>
			<ul class="mt-3 space-y-1 text-sm">
				<?php
				foreach ($recent_posts as $post) {
					echo '<li><a href="' . esc_url(get_permalink($post['ID'])) . '">' . esc_html($post['post_title']) . '</a></li>';
				}
				?>
			</ul>
		</div>
		<div>
			<p class="font-sans text-xl">CATEGORIES</p>
			<ul class="mt-3 space-y-1 text-sm">
				<?php
				foreach ($categories as $category) {
					echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
				}
				?>
			</ul>
		</div>
		<div class="h-18"></div>
	</div>
</aside>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const hamburgerButton = document.getElementById('hamburger-button');
		const aside = document.querySelector('.aside');
		hamburgerButton.addEventListener('click', function () {
			hamburgerButton.classList.toggle('open');
			aside.classList.toggle('open');
		});
	});
</script>