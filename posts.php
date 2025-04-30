<main>
	<?php if (is_category()) {
		$category = get_queried_object();
		$category_post_count = $category->count;
		$category_name = esc_html($category->name);
		$category_description = category_description($category->term_id);
		?>
		<section>
			<header class="bg-stone-100 py-16 font-sans">
				<div class="px-gutter w-full page-max-width mx-auto space-y-6">
					<p class="text-sm"><?php echo $category_post_count; ?> Post<?php echo ($category_post_count !== 1) ? 's' : ''; ?></p>
					<h1 class="font-sans text-4xl text-gray-900">
						Category: <?php echo $category_name; ?>
					</h1>
					<p class="font-serif text-sm"><?php echo $category_description; ?></p>
				</div>
			</header>
		</section>
	<?php }

	if (have_posts()) {
		require get_template_directory() . '/partial/post-list.php';
	} else {
		?>
		<div class="px-gutter w-full page-max-width mx-auto py-20 space-y-8">
			<h1>Oops! That page can’t be found.</h1>
			<form role="search" method="get" class="flex flex-col gap-2" action="<?php echo esc_url(home_url('/')); ?>">
				<label class="screen-reader-text">Maybe try a search?</label>
				<div class="flex gap-2">
					<input type="search" class="flex-1 p-4 border border-stone-400" placeholder="Search…" value="<?php echo get_search_query(); ?>" name="s" />
					<button type="submit" class="bg-primary text-white px-7">Search</button>
				</div>
			</form>
		</div>
	<?php } ?>
</main>