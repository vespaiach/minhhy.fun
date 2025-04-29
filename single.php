<?php get_header(); ?>

<?php get_sidebar(); ?>

<main>
	<article>
		<header class="bg-stone-100 py-16 font-sans">
			<div class="px-gutter w-full max-w-[768px] mx-auto space-y-6">
				<?php
				$post_id = get_the_ID();
				$categories = get_the_category($post_id);
				function category_link($category)
				{
					return '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="text-sm block text-primary">' . esc_html($category->name) . '</a>';
				}
				$category_links = array_map('category_link', $categories);
				echo $categories ? implode(', ', $category_links) : '';
				?>
				<h1 class="font-sans">
					<?php the_title(); ?>
				</h1>
				<div class="font-serif text-sm">
					<time datetime="<?php echo get_the_date('c'); ?>">
						<?php echo get_the_date('l, M t, Y'); ?>
					</time>
				</div>
			</div>
		</header>
		<div class="mt-16 px-gutter w-full max-w-[768px] mx-auto space-y-5"><?php the_content(); ?></div>
		<div class="mt-16 px-gutter w-full max-w-[768px] mx-auto space-y-3">
			<?php
			$prev_post = get_previous_post();
			if ($prev_post) {
				$prev_post_url = get_permalink($prev_post->ID);
				$prev_post_title = get_the_title($prev_post->ID);
				?>
				<a href="<?php echo esc_url($prev_post_url); ?>" class="flex gap-1 items-center underline text-sm">⇠ Previous:
					<?php echo esc_html($prev_post_title); ?></a>
				<?php
			}

			$next_post = get_next_post();
			if ($next_post) {
				$next_post_url = get_permalink($next_post->ID);
				$next_post_title = get_the_title($next_post->ID);
				?>
				<a href="<?php echo esc_url($next_post_url); ?>" class="flex gap-1 items-center underline text-sm">⇢ Next:
					<?php echo esc_html($next_post_title); ?> </a>
				<?php
			}
			?>
		</div>
	</article>
</main>

<?php get_footer(); ?>