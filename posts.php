<main class="px-gutter w-full max-w-[768px] mx-auto mt-14">
	<?php if (have_posts()): ?>
		<ul class="space-y-18">
			<?php while (have_posts()):
				the_post(); ?>
				<li>
					<article class="space-y-5">
						<div>
							<time class="font-sans" datetime="<?php echo get_the_date('c'); ?>"><?php the_time('M t, Y'); ?></time>
						</div>
						<h2 class="font-sans font-semibold text-3xl">
							<a class="no-underline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
						<div>
							<?php echo get_the_excerpt(); ?> <a class="underline font-semibold" href="<?php echo get_permalink(); ?>">Read ⇢</a>
						</div>
					</article>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php else: ?>
		<p>No posts found. :(</p>
	<?php endif; ?>
</main>