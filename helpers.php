<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Renders a list of all categories as an unordered HTML list.
 *
 * This function retrieves the categories from the `all_categories` query variable
 * if it exists; otherwise, it fetches all categories using `get_categories()`.
 * If no categories are found, the function exits without rendering anything.
 *
 * The categories are displayed as a list of links, where each link points to the
 * respective category's archive page.
 *
 * @return void
 */
function render_all_categories(): void {
	$categories = get_query_var( 'all_categories' ) ?: get_categories();
	if ( empty( $categories ) ) {
		return;
	}

	echo '<ul class="mt-3 space-y-2 list-none! pl-0! leading-[1.3]!">';
	foreach ( $categories as $category ) {
		printf(
			'<li><a href="%s">%s</a></li>',
			esc_url( get_category_link( $category->term_id ) ),
			esc_html( $category->name )
		);
	}
	echo '</ul>';
}

/**
 * Renders a customizable search form.
 *
 * @param array $options {
 *     Optional. An array of options to customize the search form.
 *
 *     @type string $input_id       The ID attribute for the search input field. Defaults to a unique ID.
 *     @type string $button_text    The text to display on the search button. If empty, the button will not be displayed.
 *     @type string $label_text     The text for the label associated with the search input field. If empty, no label will be displayed.
 * }
 *
 * @return void
 */
function render_search_form( array $options = [] ): void {
	$search_input_id    = $options['input_id'] ?? 'search-input-' . uniqid();
	$search_button_text = $options['button_text'] ?? '';
	$label_text         = $options['label_text'] ?? '';

	?>
	<form role="search" method="get" class="flex flex-col gap-1" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php if ( ! empty( $label_text ) ) : ?>
			<label for="<?php echo esc_attr( $search_input_id ); ?>"><?php echo esc_html( $label_text ); ?></label>
		<?php endif; ?>
		<div class="flex gap-2">
			<input type="search" id="<?php echo esc_attr( $search_input_id ); ?>" class="flex-1 border border-stone-400 p-4 bg-white"
						 placeholder="Search..." value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
			<?php if ( ! empty( $search_button_text ) ) : ?>
				<button type="submit" class="bg-primary text-white py-4 px-6 shrink-0 cursor-pointer">
					<?php echo esc_html( $search_button_text ); ?>
				</button>
			<?php endif; ?>
		</div>
	</form>
	<?php
}

/**
 * Renders a list of recent posts.
 *
 * This function retrieves recent posts either from the `recent_posts` query variable
 * or by querying the database for the latest published posts. It then outputs an
 * unordered list of these posts, including their titles and publication dates.
 *
 * @return void
 *
 * Usage:
 * Call this function within a WordPress template to display a list of recent posts.
 *
 * Notes:
 * - If the `recent_posts` query variable is not set or is empty, the function will
 *   query the database for the 5 most recent published posts.
 * - If no posts are found, the function will return without rendering anything.
 * - The output includes a list with Tailwind CSS classes for styling.
 * - Each list item includes a link to the post and its publication date.
 *
 * Example Output:
 * <ul class="mt-4 space-y-5 list-none! pl-0!">
 *     <li class="flex flex-col pb-4 border-b border-b-gray-200">
 *         <a href="https://example.com/post-1">Post Title 1</a>
 *         <time class="text-xs text-gray-400" datetime="2023-01-01T00:00:00+00:00">Jan 1, 2023</time>
 *     </li>
 *     ...
 * </ul>
 */
function render_recent_posts(): void {
	$recent_posts = get_query_var( 'recent_posts' ) ?: [];
	if ( empty( $recent_posts ) ) {
		$recent_posts = get_posts( [ 
			'numberposts' => 5,
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',
		] );
	}
	if ( empty( $recent_posts ) ) {
		return;
	}
	?>
	<ul class="mt-4 space-y-5 list-none! pl-0!">
		<?php foreach ( $recent_posts as $post ) : ?>
			<li class="flex flex-col pb-4 <?php echo ( $post === end( $recent_posts ) ) ? '' : 'border-b border-b-gray-200'; ?>">
				<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
					<?php echo esc_html( $post->post_title ); ?>
				</a>
				<time class="text-xs text-gray-400" datetime="<?php echo esc_attr( get_the_date( 'c', $post->ID ) ); ?>">
					<?php echo esc_html( get_the_date( 'M t, Y', $post->ID ) ); ?>
				</time>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
	wp_reset_postdata();
}

function render_top_section( $elements = [] ): void {
	$line1          = $elements['line1'] ?? '';
	$line2          = $elements['line2'] ?? '';
	$line3          = $elements['line3'] ?? '';
	$featured_image = $elements['featured_image'] ?? '';
	?>
	<section class="mb-18">
		<header class="bg-stone-100">
			<div class="page">
				<div class="py-18 lg:22 space-y-6">
					<?= $line1; ?>
					<h1><?= $line2; ?></h1>
					<?= $line3; ?>
				</div>
				<?= $featured_image; ?>
			</div>
		</header>
	</section>
	<?php
}