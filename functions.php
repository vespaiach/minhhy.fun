<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

require_once get_template_directory() . '/helpers.php';

add_action('after_setup_theme', 'minhhy_theme_setup');
function minhhy_theme_setup()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'responsive-embeds']);
}

// Customize the excerpt "more" text
add_filter('excerpt_more', function () {
	return '';
});