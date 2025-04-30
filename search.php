<?php get_header(); ?>
<div class="flex flex-col md:flex-row">
	<?php get_sidebar(); ?>
	<main>
		<header class="bg-stone-100 py-16">
			<div class="px-gutter w-full page-max-width mx-auto space-y-6">
				<h1 class="mb-8 font-sans text-gray-900">Search Results for: <?php echo get_search_query(); ?></h1>
				<?= get_search_form(); ?>
			</div>
		</header>
		<section><?php get_template_part('template-parts/posts'); ?></section>
		<?php get_footer(); ?>
	</main>
</div>