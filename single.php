<?php
$all_categories = get_categories(array('hide_empty' => true, ));
$recent_posts = wp_get_recent_posts(array(
	'numberposts' => 5,
	'post_status' => 'publish',
	'orderby' => 'post_date',
	'order' => 'DESC',
), OBJECT);
set_query_var('recent_posts', $recent_posts);
set_query_var('all_categories', $all_categories);

if (have_posts()):
	the_post();

	$post_id = get_the_ID();
	$tags = wp_get_post_tags($post_id);
	$seo_description = get_post_meta($post_id, 'seo_desc', true);
	$categories = get_the_category($post_id);
	if (!empty($categories)) {
		$category_links = array_map(function ($category) {
			return sprintf(
				'<a href="%s" class="block">%s</a>',
				esc_url(get_category_link($category->term_id)),
				esc_html($category->name)
			);
		}, $categories);
	}

	get_header();
	?>

	<div class="view-port">

		<?php get_sidebar(); ?>

		<main class="flex-1">
			<article>
				<?= render_top_section(array(
					'line1' => '<p>' . implode(', ', $category_links) . '</p>',
					'line2' => '<h1>' . get_the_title() . '</h1>',
					'line3' => '<p>' . get_the_date('l, M t, Y') . '</p>',
					'featured_image' => get_the_post_thumbnail($post_id, 'full', ['class' => 'w-full h-auto']),
				)); ?>
				<div class="mt-20 page"><?php the_content(); ?></div>
				<div class="mt-20 page space-y-3">
					<?php
					$prev_post = get_previous_post();
					if ($prev_post) {
						$prev_post_url = get_permalink($prev_post->ID);
						$prev_post_title = get_the_title($prev_post->ID);
						?>
						<a href="<?php echo esc_url($prev_post_url); ?>" class="flex gap-1 items-center">⇠ Previous:
							<?php echo esc_html($prev_post_title); ?></a>
						<?php
					}

					$next_post = get_next_post();
					if ($next_post) {
						$next_post_url = get_permalink($next_post->ID);
						$next_post_title = get_the_title($next_post->ID);
						?>
						<a href="<?php echo esc_url($next_post_url); ?>" class="flex gap-1 items-center">⇢ Next:
							<?php echo esc_html($next_post_title); ?> </a>
						<?php
					}
					?>
					<a href="#top" class="flex gap-1 items-center" id="go-to-top">⇡ Top: Go Back to Top</a>
				</div>
			</article>
			<?= get_footer(); ?>
		</main>
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				const topLink = document.getElementById('go-to-top');
				topLink.addEventListener('click', function (event) {
					event.preventDefault();
					window.scrollTo({ top: 0, behavior: 'smooth' });
				});
			});
		</script>

	</div>
<?php endif; ?>

</body>
</html>