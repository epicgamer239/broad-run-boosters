<?php
/**
 * Contact — club email, optional form, social links, meeting info.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
the_post();
$parts   = brab_page_parts();
$email   = brab_setting( 'contact_email' );
$form_on = '1' === brab_setting( 'contact_form_enabled' );
$status  = isset( $_GET['contact'] ) ? sanitize_key( wp_unslash( $_GET['contact'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$notices = array(
	'sent'    => array( 'success', __( 'Thank you! Your message has been sent. We will get back to you soon.', 'broad-run-boosters' ) ),
	'invalid' => array( 'error', __( 'Please fill in your name, a valid email address and a message.', 'broad-run-boosters' ) ),
	'wait'    => array( 'error', __( 'Please wait a minute before sending another message.', 'broad-run-boosters' ) ),
	'error'   => array( 'error', __( 'Sorry, your message could not be sent. Please email us directly.', 'broad-run-boosters' ) ),
);
$meeting = brab_get_next_meeting();
?>

<main id="main-content" class="site-main">
	<?php
	brab_page_hero(
		array(
			'eyebrow'  => __( 'We’d Love to Hear From You', 'broad-run-boosters' ),
			'title'    => __( 'Contact Us', 'broad-run-boosters' ),
			'image'    => 'get-involved-bg.jpg',
		)
	);
	?>

	<section class="page-section" aria-label="<?php esc_attr_e( 'Contact information', 'broad-run-boosters' ); ?>">
		<div class="page-container">
			<div class="split split--wide-right">
				<div class="contact-info">
					<div class="prose prose--lead"><?php echo $parts['main']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>

					<div class="contact-block">
						<h2 class="subheading"><?php esc_html_e( 'Email', 'broad-run-boosters' ); ?></h2>
						<a class="contact-email" href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a>
					</div>

					<?php $socials = brab_social_links(); ?>
					<?php if ( $socials ) : ?>
						<div class="contact-block">
							<h2 class="subheading"><?php esc_html_e( 'Follow Us', 'broad-run-boosters' ); ?></h2>
							<ul class="contact-social">
								<?php foreach ( $socials as $key => $social ) : ?>
									<li>
										<a href="<?php echo esc_url( $social['url'] ); ?>" target="_blank" rel="noopener noreferrer">
											<span class="social-icon social-<?php echo esc_attr( $key ); ?>" aria-hidden="true"><?php echo $social['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
											<?php echo esc_html( $social['label'] ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<div class="contact-block">
						<h2 class="subheading"><?php esc_html_e( 'Booster Meetings', 'broad-run-boosters' ); ?></h2>
						<?php if ( $meeting ) : ?>
							<p><strong><?php echo esc_html( $meeting['date'] ); ?></strong><br><?php echo esc_html( implode( ' | ', array_filter( array( $meeting['time'], $meeting['location'] ) ) ) ); ?></p>
						<?php endif; ?>
						<p><a href="<?php echo esc_url( home_url( '/about-us/#meetings' ) ); ?>"><?php esc_html_e( 'View all meeting dates', 'broad-run-boosters' ); ?> &rarr;</a></p>
					</div>

					<div class="contact-block">
						<h2 class="subheading"><?php esc_html_e( 'Location', 'broad-run-boosters' ); ?></h2>
						<address class="contact-address">
							<?php esc_html_e( 'Broad Run High School', 'broad-run-boosters' ); ?><br>
							<?php esc_html_e( '21670 Ashburn Road', 'broad-run-boosters' ); ?><br>
							<?php esc_html_e( 'Ashburn, VA 20148', 'broad-run-boosters' ); ?>
						</address>
					</div>
				</div>

				<?php if ( $form_on ) : ?>
					<div class="contact-form-card" id="contact-form">
						<h2 class="contact-form-title"><?php esc_html_e( 'Send Us a Message', 'broad-run-boosters' ); ?></h2>
						<?php if ( isset( $notices[ $status ] ) ) : ?>
							<p class="form-notice form-notice--<?php echo esc_attr( $notices[ $status ][0] ); ?>" role="status"><?php echo esc_html( $notices[ $status ][1] ); ?></p>
						<?php endif; ?>
						<form class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
							<input type="hidden" name="action" value="brab_contact">
							<?php wp_nonce_field( 'brab_contact', 'brab_contact_nonce' ); ?>
							<div class="form-hp" aria-hidden="true">
								<label for="cf-website"><?php esc_html_e( 'Leave this empty', 'broad-run-boosters' ); ?></label>
								<input type="text" id="cf-website" name="website" tabindex="-1" autocomplete="off">
							</div>
							<div class="form-row">
								<div class="form-field">
									<label for="cf-name"><?php esc_html_e( 'Name', 'broad-run-boosters' ); ?></label>
									<input type="text" id="cf-name" name="name" required autocomplete="name">
								</div>
								<div class="form-field">
									<label for="cf-email"><?php esc_html_e( 'Email', 'broad-run-boosters' ); ?></label>
									<input type="email" id="cf-email" name="email" required autocomplete="email">
								</div>
							</div>
							<div class="form-field">
								<label for="cf-topic"><?php esc_html_e( 'Topic', 'broad-run-boosters' ); ?></label>
								<select id="cf-topic" name="topic">
									<?php foreach ( array( 'General question', 'Membership', 'Volunteering / Concessions', 'Sponsorship', 'Donations', 'Mulch Madness', 'Scholarships', 'Shop / Orders' ) as $topic ) : ?>
										<option><?php echo esc_html( $topic ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-field">
								<label for="cf-message"><?php esc_html_e( 'Message', 'broad-run-boosters' ); ?></label>
								<textarea id="cf-message" name="message" rows="6" required></textarea>
							</div>
							<button type="submit" class="btn btn-maroon">
								<?php esc_html_e( 'Send Message', 'broad-run-boosters' ); ?>
								<span class="btn-arrow" aria-hidden="true">&rarr;</span>
							</button>
						</form>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
