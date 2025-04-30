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
	<div class="w-full page-max-width mx-auto px-gutter md:px-5">
		<div class="flex items-start justify-between py-4">
			<div>
				<h1 class="font-serif m-0! text-content-headings text-3xl md:text-2xl">
					<a class="block no-underline text-white" href="/">MINH-HY</a>
				</h1>
				<span class="md:text-sm"><?php echo esc_html(get_bloginfo('description')); ?></span>
			</div>
			<button class="hamburger-button mt-1.5 md:hidden! shrink-0" id="hamburger-button">
				<span class="hamburger-line line-1"></span>
				<span class="hamburger-line line-2"></span>
				<span class="hamburger-line line-3"></span>
			</button>
		</div>

		<div class="space-y-18 md:space-y-12 mt-10 pb-20 hidden md:block" id="sidebar-expansion">
			<div>
				<form role="search" method="get" class="flex flex-col gap-1" action="<?php echo esc_url(home_url('/')); ?>">
					<label for="<?= $search_input_id; ?>">Search Posts</label>
					<div class="flex gap-2">
						<input type="search" id="<?= $search_input_id; ?>" class="flex-1 border border-stone-400 p-4 bg-white" placeholder="Search..."
									 value="<?php echo get_search_query(); ?>" name="s" />
						<button type="submit" class="text-body! bg-red-200 py-4 px-6 shrink-0 cursor-pointer md:hidden">Search</button>
					</div>
				</form>
			</div>
			<div>
				<h3 class="m-0! text-white md:text-2xl">RECENT POSTS</h3>
				<ul class="mt-3 space-y-2 list-none! pl-0! leading-[1.3]!">
					<?php
					foreach ($recent_posts as $post) {
						echo '<li><a class="text-white md:text-sm" href="' . esc_url(get_permalink($post['ID'])) . '">' . esc_html($post['post_title']) . '</a></li>';
					}
					?>
				</ul>
			</div>
			<div>
				<h3 class="m-0! text-white md:text-2xl">CATEGORIES</h3>
				<ul class="mt-3 space-y-2 list-none! pl-0! leading-[1.3]!">
					<?php
					foreach ($categories as $category) {
						echo '<li><a class="text-white md:text-sm" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
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