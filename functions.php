<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once get_template_directory() . '/helpers.php';

function custom_register_query_vars($vars) {
	$vars[] = 'form_error';
	return $vars;
}
add_filter('query_vars', 'custom_register_query_vars');

add_action( 'after_setup_theme', 'minhhy_theme_setup' );
function minhhy_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'responsive-embeds' ] );
}

// Customize the excerpt "more" text
add_filter( 'excerpt_more', function () {
	return '';
} );

function restrict_search_to_post_type( $query ) {
	if ( $query->is_search && ! is_admin() && $query->is_main_query() ) {
		$query->set( 'post_type', 'post' ); // Replace 'post' with your desired post type
	}
}
add_action( 'pre_get_posts', 'restrict_search_to_post_type' );

function handle_contact_form_submission() {
	// Validate required fields
	if ( empty( $_POST['your_email'] ) || empty( $_POST['your_name'] ) || empty( $_POST['message'] ) ) {
		wp_redirect( home_url( '/contact/?form_error=required_fields' ) );
		exit;
	}
	if ( ! is_email( $_POST['your_email'] ) ) {
		wp_redirect( home_url( '/contact/?form_error=invalid_email' ) );
		exit;
	}

	if ( isset( $_POST['recaptcha_token'] ) ) {
		$recaptcha_token = sanitize_text_field( $_POST['recaptcha_token'] );
		$secret_key = defined( 'RECAPTCHA_SECRET_KEY' ) ? RECAPTCHA_SECRET_KEY : '___';

		// Verify reCAPTCHA response
		$response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', array(
			'body' => array(
				'secret' => $secret_key,
				'response' => $recaptcha_token,
			),
		) );

		$response_body = wp_remote_retrieve_body( $response );
		$result        = json_decode( $response_body, true );

		if ( ! $result['success'] || $result['score'] < 0.5 ) {
			wp_redirect( home_url( '/contact/?form_error=captcha_failed' ) );
			exit;
		}
	} else {
		wp_redirect( home_url( '/contact/?form_error=captcha_missing' ) );
		exit;
	}

	// Process the form (e.g., send email)
	if ( isset( $_POST['your_email'], $_POST['your_name'], $_POST['subject'], $_POST['message'] ) ) {
		$name    = sanitize_text_field( $_POST['your_name'] );
		$email   = sanitize_email( $_POST['your_email'] );
		$subject = sanitize_text_field( $_POST['subject'] );
		$message = sanitize_textarea_field( $_POST['message'] );

		// Send email
		$to      = get_option( 'admin_email' );
		$headers = "From: $name <$email>";
		wp_mail( $to, $subject, $message, $headers );

		// Redirect after submission
		wp_redirect( home_url( '/thank-you/?name=' . urlencode( $_POST['your_name'] ) ) );
		exit;
	}
}
add_action( 'admin_post_submit_contact_form', 'handle_contact_form_submission' );
add_action( 'admin_post_nopriv_submit_contact_form', 'handle_contact_form_submission' );
