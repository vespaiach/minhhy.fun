<?php
$all_categories = get_categories( array( 'hide_empty' => true, ) );
$recent_posts   = wp_get_recent_posts( array(
	'numberposts' => 5,
	'post_status' => 'publish',
	'orderby' => 'post_date',
	'order' => 'DESC',
), OBJECT );
set_query_var( 'recent_posts', $recent_posts );
set_query_var( 'all_categories', $all_categories );

if ( have_posts() ) :
	the_post();

	$post_id         = get_the_ID();
	$tags            = wp_get_post_tags( $post_id );
	$seo_description = get_post_meta( $post_id, 'seo_desc', true );
	$categories      = get_the_category( $post_id );

	get_header();
	?>

	<div class="view-port">

		<?php get_sidebar(); ?>

		<main class="flex-1">
			<article>
				<header class="bg-stone-100">
					<div class="page">
						<div class="py-20 space-y-6">
							<?php
							if ( ! empty( $categories ) ) {
								$category_links = array_map( function ($category) {
									return sprintf(
										'<a href="%s" class="block">%s</a>',
										esc_url( get_category_link( $category->term_id ) ),
										esc_html( $category->name )
									);
								}, $categories );
								echo implode( ', ', $category_links );
							}
							?>
							<h1><?php the_title(); ?></h1>
							<div class="font-serif text-sm">
								<time datetime="<?php echo get_the_date( 'c' ); ?>">
									<?php echo get_the_date( 'l, M t, Y' ); ?>
								</time>
							</div>
						</div>
						<?php echo get_the_post_thumbnail( $post_id, 'full', [ 'class' => 'w-full h-auto' ] ); ?>
					</div>
				</header>
				<div class="mt-20 px-gutter w-full page-max-width mx-auto"><?php the_content(); ?></div>
				<div class="mt-20 px-gutter w-full page-max-width mx-auto space-y-3">
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