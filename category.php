<?php
get_header();
get_sidebar();

$category = get_queried_object();
$category_post_count = $category->count;
$category_name = esc_html($category->name);
$category_description = category_description($category->term_id);

?>

<section>
	<header class="bg-stone-100 py-16 font-sans">
		<div class="px-gutter w-full max-w-[768px] mx-auto space-y-6">
			<p class="text-sm"><?php echo $category_post_count; ?> Post<?php echo ($category_post_count !== 1) ? 's' : ''; ?></p>
			<h1 class="font-sans">
				Category: <?php echo $category_name; ?>
			</h1>
			<p class="font-serif text-sm"><?php echo $category_description; ?></p>
		</div>
	</header>
</section>

<?php
get_template_part('template-parts/posts');
get_footer();