<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$search_query = get_search_query();
$search_results_count = $wp_query->found_posts;
?>

<section class="bg-stone-100 py-16 font-sans">
	<div class="px-gutter w-full max-w-[768px] mx-auto space-y-6">
		<form role="search" method="get" class="flex flex-col gap-2" action="<?php echo esc_url(home_url('/')); ?>">
			<label class="screen-reader-text" for="search-input">Try again with some different keywords.</label>
			<div class="flex gap-2">
				<input type="search" id="search-input" class="flex-1 p-4 border border-stone-400" placeholder="Search…"
							 value="<?php echo esc_html($search_query); ?>" name="s" />
				<button type="submit" class="bg-primary text-white px-7">Search</button>
			</div>
		</form>
		<div class="flex flex-col gap-3">
			<p class="font-semibold">Total results found: <?php echo esc_html($search_results_count); ?></p>
		</div>
	</div>
</section>
<?php if ($search_results_count == 0) { ?>
	<div class="px-gutter w-full max-w-[768px] mx-auto py-20 space-y-8">
		<h1>Oops! Nothing found.</h1>
	</div>
<?php } else {
	require get_template_directory() . '/partial/post-list.php';
}
?>