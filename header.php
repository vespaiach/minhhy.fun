<?php
if ( ! isset( $seo_description ) ) {
	$seo_description = 'Minh-Hy\'s blog | Even Laughing Counts as Cardio! | A place to share my thoughts, ideas, experiences and funs.';
}
if ( ! isset( $tags ) ) {
	$tags = [];
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title><?php wp_title( '|', true, 'right' ); ?>Minh-Hy</title>
		<meta name="description" content="<?= $seo_description ?>">
		<meta name="keywords" content="Minh-Hy, blog<?php foreach ( $tags as $tag ) {
			echo ', ' . esc_attr( $tag->name );
		} ?>">
		<meta name="author" content="Minh-Hy Nguyen">
		<meta name="url" content="<?php echo esc_url( home_url( add_query_arg( null, null ) ) ); ?>">
		<meta name="theme-color" content="#ffffff">
		<meta name="robots" content="index, follow">
		<?php if ( is_single() ) : ?>
			<meta name="og:url" content="<?php echo esc_url( get_permalink() ); ?>">
			<meta name="og:title" content="<?php the_title(); ?>">
			<meta name="og:description" content="<?= $seo_description ?>">
			<meta name="og:image" content="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>">
			<meta name="og:type" content="article">
			<meta name="og:url" content="<?php echo esc_url( get_permalink() ); ?>">
			<meta name="og:site_name" content="Minh-Hy">
			<meta name="og:locale" content="en_US">
		<?php endif; ?>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&family=Merriweather:wght@700;900&family=Source+Code+Pro&display=swap"
					rel="stylesheet">
		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/style.css' ); ?>" type="text/css">
	</head>

	<body>