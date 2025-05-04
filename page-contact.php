<?php
/**
 * Template Name: Contact
 */
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
	$error           = get_query_var( 'form_error', '' );

	get_header();
	?>

	<div class="flex flex-col lg:flex-row">

		<?php get_sidebar(); ?>

		<main class="flex-1">
			<div class="px-gutter w-full page-max-width mx-auto">

				<div class="pt-16 pb-6 lg:pt-18 lg:pb-10">
					<h1><?php the_title(); ?></h1>
				</div>
				<?php if ( $error ) : ?>
					<p class="text-primary my-5">
						<?php
						switch ( $error ) {
							case 'required_fields':
								echo '* Please fill out all required fields.';
								break;
							case 'invalid_email':
								echo '* Please provide a valid email address.';
								break;
							case 'captcha_failed':
								echo '* CAPTCHA verification failed. Please try again.';
								break;
							case 'captcha_missing':
								echo '* CAPTCHA token is missing. Please try again.';
								break;
						}
						?>
					</p>
				<?php endif; ?>
				<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" id="contact-form" method="post" class="space-y-5">
					<input type="hidden" name="action" value="submit_contact_form">
					<input type="hidden" id="recaptcha-token" name="recaptcha_token">

					<div class="flex flex-col space-y-1">
						<label for="your-name">Your Name</label>
						<input type="text" id="your-name" name="your_name">
					</div>

					<div class="flex flex-col space-y-1">
						<label for="your-email">Your Email <strong class="text-primary">*</strong></label>
						<input type="email" id="your-email" name="your_email" required>
					</div>

					<div class="flex flex-col space-y-1">
						<label for="subject">Subject <strong class="text-primary">*</strong></label>
						<input type="text" id="subject" name="subject" required>
					</div>

					<div class="flex flex-col space-y-1">
						<label for="message">Message <strong class="text-primary">*</strong></label>
						<textarea id="message" name="message" rows="5" required></textarea>
					</div>

					<button type="submit" data-sitekey="<?= defined( 'RECAPTCHA_CLIENT_KEY' ) ? RECAPTCHA_CLIENT_KEY : '___' ?>" data-callback='onSubmit'
									data-action='submit' class="g-recaptcha p-4 bg-primary rounded text-white">Send Message</button>
				</form>
			</div>
			<?= get_footer(); ?>

		</main>
	</div>
<?php endif; ?>

<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
	function onSubmit(token) {
		document.getElementById('recaptcha-token').value = token;
		if (validateForm()) {
			document.getElementById('contact-form').submit();
		}
	}
	function validateForm() {
		let isValid = true;
		const email = document.getElementById('your-email').value.trim();
		const subject = document.getElementById('subject').value.trim();
		const message = document.getElementById('message').value.trim();

		// Clear previous error messages
		document.querySelectorAll('.error-message').forEach(el => el.remove());

		// Validate Email
		if (email === '') {
			showError('your-email', 'Email is required.');
			isValid = false;
		} else if (!validateEmail(email)) {
			showError('your-email', 'Please enter a valid email address.');
			isValid = false;
		}

		// Validate Subject
		if (subject === '') {
			showError('subject', 'Subject is required.');
			isValid = false;
		}

		// Validate Message
		if (message === '') {
			showError('message', 'Message is required.');
			isValid = false;
		}

		return isValid;
	}

	function showError(inputId, message) {
		const inputElement = document.getElementById(inputId);
		const errorElement = document.createElement('span');
		errorElement.className = 'error-message text-red-500 text-sm';
		errorElement.textContent = message;
		inputElement.parentElement.appendChild(errorElement);
	}

	function validateEmail(email) {
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		return emailRegex.test(email);
	}
</script>