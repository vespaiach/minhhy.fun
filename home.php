<?php get_header(); ?>

<div class="flex flex-col gap-20 md:flex-row md:gap-0">
	<?php get_sidebar(); ?>
	<main>
		<?php get_template_part('template-parts/posts'); ?>
		<?php get_footer(); ?>
	</main>
</div>