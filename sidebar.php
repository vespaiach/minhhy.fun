<?php
$categories = get_categories(array('hide_empty' => true, ));
$recent_posts = wp_get_recent_posts(array(
	'numberposts' => 5,
	'post_status' => 'publish',
	'orderby' => 'post_date',
	'order' => 'DESC',
));
wp_reset_query();
?>

<aside class="bg-primary text-white">
	<div class="w-full page-max-width mx-auto px-gutter">
		<div class="flex items-start justify-between py-4">
			<div>
				<h1 class="font-serif m-0! text-content-headings text-3xl md:text-4xl">
					<a class="block no-underline text-white" href="/">MINH-HY</a>
				</h1>
				<span><?php echo esc_html(get_bloginfo('description')); ?></span>
			</div>
			<button class="hamburger-button mt-1.5" id="hamburger-button">
				<span class="hamburger-line line-1"></span>
				<span class="hamburger-line line-2"></span>
				<span class="hamburger-line line-3"></span>
			</button>
		</div>
		<div class="space-y-12 mt-8 pb-20 hidden" id="sidebar-expansion">
			<div>
				<h3 class="m-0! text-white">RECENT POSTS</h3>
				<ul class="mt-3 space-y-1">
					<?php
					foreach ($recent_posts as $post) {
						echo '<li><a class="text-white" href="' . esc_url(get_permalink($post['ID'])) . '">' . esc_html($post['post_title']) . '</a></li>';
					}
					?>
				</ul>
			</div>
			<div>
			<h3 class="m-0! text-white">CATEGORIES</h3>
				<ul class="mt-3 space-y-1">
					<?php
					foreach ($categories as $category) {
						echo '<li><a class="text-white" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</aside>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const hamburgerButton = document.getElementById('hamburger-button');
		const aside = document.getElementById('sidebar-expansion');
		hamburgerButton.addEventListener('click', function () {
			hamburgerButton.classList.toggle('open');
			aside.classList.toggle('hidden');
		});
	});
</script>