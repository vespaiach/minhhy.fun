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
		<div class="flex items-start justify-between">
			<div>
				<h1 class="font-sans font-bold text-2xl">
					<a href="/">MINH-HY</a>
				</h1>
				<small class=""><?php echo esc_html(get_bloginfo('description')); ?></small>
			</div>
			<button class="hamburger-button mt-1.5" id="hamburger-button">
				<span class="hamburger-line line-1"></span>
				<span class="hamburger-line line-2"></span>
				<span class="hamburger-line line-3"></span>
			</button>
		</div>
		<div class="hidden">
			<p class="font-sans text-xl">RECENT POSTS</p>
			<ul class="mt-3 space-y-1 text-sm">
				<?php
				foreach ($recent_posts as $post) {
					echo '<li><a href="' . esc_url(get_permalink($post['ID'])) . '">' . esc_html($post['post_title']) . '</a></li>';
				}
				?>
			</ul>
		</div>
		<div class="hidden">
			<p class="font-sans text-xl">CATEGORIES</p>
			<ul class="mt-3 space-y-1 text-sm">
				<?php
				foreach ($categories as $category) {
					echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
				}
				?>
			</ul>
		</div>
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