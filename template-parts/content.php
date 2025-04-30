<?php
if (!defined('ABSPATH')) {
	exit;
}
?>

<li>
	<article class="space-y-4">
		<div>
			<time datetime="<?php echo get_the_date('c'); ?>"><?php the_time('M t, Y'); ?></time>
		</div>
		<h2>
			<a class="text-[inherit]" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<div>
			<?php echo get_the_excerpt(); ?> <a class="underline font-semibold" href="<?php echo get_permalink(); ?>">Read ⇢</a>
		</div>
	</article>
</li>