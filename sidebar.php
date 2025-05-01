<?php
$recent_posts    = get_query_var( 'recent_posts' );
$all_categories  = get_query_var( 'all_categories' );
$search_input_id = 'search-input' . uniqid();
?>

<aside class="bg-primary text-white">
	<div class="w-full page-max-width mx-auto px-gutter">
		<div class="flex items-start justify-between py-4">
			<div>
				<h1 class="font-serif m-0! text-2xl leading-[1]! font-bold">
					<a class="block no-underline text-white" href="/">MINH-HY</a>
				</h1>
				<span class="text-sm"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></span>
			</div>
			<button class="hamburger-button lg:hidden! shrink-0" id="hamburger-button">
				<span class="hamburger-line line-1"></span>
				<span class="hamburger-line line-2"></span>
				<span class="hamburger-line line-3"></span>
			</button>
		</div>

		<div class="space-y-18 mt-8 pb-20 hidden lg:block" id="sidebar-expansion">
			<form role="search" method="get" class="flex flex-col space-y-2" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label for="<?= $search_input_id; ?>" class="font-serif text-xl">SEARCH POSTS</label>
				<div class="flex gap-2 flex-wrap xl:flex-nowrap">
					<input type="search" id="<?= $search_input_id; ?>" class="flex-1 border border-stone-400 p-2.5 bg-white rounded"
								 placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
					<button type="submit" class="bg-red-100 text-body px-3!">Search</button>
				</div>
			</form>

			<?php if ( is_single() ) : ?>
				<div class="space-y-3">
					<h3 class="m-0! text-white text-xl">QUICK LINKS</h3>
					<ul class="space-y-2.5 list-none! pl-0! leading-[1.2]!">
						<?php
						$prev_post = get_previous_post();
						if ( $prev_post ) {
							$prev_post_url   = get_permalink( $prev_post->ID );
							$prev_post_title = get_the_title( $prev_post->ID );
							?>
							<li class="flex gap-1 items-start text-white">
								<svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 mt-[2px]" height="18px" viewBox="0 -960 960 960" width="18px"
										 fill="#e3e3e3">
									<path
												d="m480-336 51-51-57-57h150v-72H474l57-57-51-51-144 144 144 144Zm0 240q-79 0-149-30t-122.5-82.5Q156-261 126-331T96-480q0-80 30-149.5t82.5-122Q261-804 331-834t149-30q80 0 149.5 30t122 82.5Q804-699 834-629.5T864-480q0 79-30 149t-82.5 122.5Q699-156 629.5-126T480-96Zm0-72q130 0 221-91t91-221q0-130-91-221t-221-91q-130 0-221 91t-91 221q0 130 91 221t221 91Zm0-312Z" />
								</svg>
								<a href="<?php echo esc_url( $prev_post_url ); ?>" class="flex gap-1 items-center text-white">Previous Post:
									<?php echo esc_html( $prev_post_title ); ?></a>
							</li>
							<?php
						}

						$next_post = get_next_post();
						if ( $next_post ) {
							$next_post_url   = get_permalink( $next_post->ID );
							$next_post_title = get_the_title( $next_post->ID );
							?>
							<li class="flex gap-1 items-start text-white">
								<svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 mt-[2px]" height="18px" viewBox="0 -960 960 960" width="18px"
										 fill="currentColor">
									<path
												d="m480-336 144-144-144-144-51 51 57 57H336v72h150l-57 57 51 51Zm0 240q-79 0-149-30t-122.5-82.5Q156-261 126-331T96-480q0-80 30-149.5t82.5-122Q261-804 331-834t149-30q80 0 149.5 30t122 82.5Q804-699 834-629.5T864-480q0 79-30 149t-82.5 122.5Q699-156 629.5-126T480-96Zm0-72q130 0 221-91t91-221q0-130-91-221t-221-91q-130 0-221 91t-91 221q0 130 91 221t221 91Zm0-312Z" />
								</svg>
								<a href="<?php echo esc_url( $next_post_url ); ?>" class="flex gap-1 items-center text-white">Next Post:
									<?php echo esc_html( $next_post_title ); ?></a>
							</li>
							<?php
						}
						?>
						<li class="flex gap-1 items-start text-white">
							<svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px" class="shrink-0 mt-[2px]" fill="currentColor">
								<path
											d="M192-144v-337l-64 49-44-58 396-302 396 302-44 58-64-49v337H192Zm72-72h432v-320.33L480-701 264-537v321Zm0 0h432-432Zm72.21-144q-15.21 0-25.71-10.29t-10.5-25.5q0-15.21 10.29-25.71t25.5-10.5q15.21 0 25.71 10.29t10.5 25.5q0 15.21-10.29 25.71t-25.5 10.5Zm144 0q-15.21 0-25.71-10.29t-10.5-25.5q0-15.21 10.29-25.71t25.5-10.5q15.21 0 25.71 10.29t10.5 25.5q0 15.21-10.29 25.71t-25.5 10.5Zm144 0q-15.21 0-25.71-10.29t-10.5-25.5q0-15.21 10.29-25.71t25.5-10.5q15.21 0 25.71 10.29t10.5 25.5q0 15.21-10.29 25.71t-25.5 10.5Z" />
							</svg>
							<a href="/" class="flex gap-1 items-center text-white">Go to Home Page</a>
						</li>
					</ul>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $recent_posts ) ) : ?>
				<div class="space-y-3">
					<h3 class="m-0! text-white text-xl">RECENT POSTS</h3>
					<ul class="space-y-2.5 list-none! pl-0! leading-[1.2]!">
						<?php foreach ( $recent_posts as $post ) : ?>
							<li>
								<a class="text-white" href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
									<?php echo esc_html( $post->post_title ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
					<?php wp_reset_postdata(); ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $all_categories ) ) : ?>
				<div class="space-y-4">
					<h3 class="m-0! text-white text-xl">CATEGORIES</h3>
					<ul class="space-y-2.5 list-none! pl-0! leading-[1.2]!">
						<?php foreach ( $all_categories as $category ) : ?>
							<li>
								<a class="text-white" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
									<?php echo esc_html( $category->name ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

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