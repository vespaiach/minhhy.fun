<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php wp_title('|', true, 'right'); ?></title>

		<!-- Preconnect for Google Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&family=Oswald:wght@200..700&display=swap"
					rel="stylesheet">

		<!-- Theme Stylesheet -->
		<link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_uri()); ?>" type="text/css">

		<?php
		// Remove all default actions from wp_head
		remove_all_actions('wp_head');

		// Customize the excerpt "more" text
		add_filter('excerpt_more', function () {
			return '';
		});

		// WordPress head hook
		wp_head();
		?>
	</head>

	<body>
		<?php
		// Include navigation
		require get_template_directory() . '/nav.php';

		// Include content based on the page type
		if (is_single()) {
			require get_template_directory() . '/post.php';
		} else {
			require get_template_directory() . '/list.php';
		}

		// Include footer
		require get_template_directory() . '/footer.php';
		?>
	</body>

</html>