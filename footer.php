<?php
/**
 * Theme footer.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<footer class="site-footer">
	<div class="footer-inner">
		<div class="footer-col footer-brand">
			<div class="footer-logo-row">
				<img
					src="<?php echo brab_img( 'logo-crest.png' ); ?>"
					alt=""
					width="56"
					height="42"
					class="footer-logo"
				>
				<div class="footer-brand-text">
					<span class="footer-brand-main"><?php esc_html_e( 'Broad Run', 'broad-run-boosters' ); ?></span>
					<span class="footer-brand-sub"><?php esc_html_e( 'Athletic Booster Club', 'broad-run-boosters' ); ?></span>
				</div>
			</div>
			<p class="footer-tagline"><?php esc_html_e( 'Supporting · Empowering · Building Spartan Success', 'broad-run-boosters' ); ?></p>
		</div>

		<div class="footer-col footer-quick-links">
			<h3 class="footer-heading"><?php esc_html_e( 'Quick Links', 'broad-run-boosters' ); ?></h3>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'footer-links',
					'fallback_cb'    => 'brab_fallback_footer_menu',
					'depth'          => 1,
				)
			);
			?>
		</div>

		<div class="footer-col footer-connect">
			<h3 class="footer-heading"><?php esc_html_e( 'Connect With Us', 'broad-run-boosters' ); ?></h3>
			<ul class="footer-social">
				<li>
					<a href="mailto:info@broadrunathleticboosters.org">
						<span class="social-icon social-email" aria-hidden="true">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
						</span>
						<?php esc_html_e( 'Email Us', 'broad-run-boosters' ); ?>
					</a>
				</li>
				<li>
					<a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">
						<span class="social-icon social-facebook" aria-hidden="true">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 10-11.5 9.9v-7H8v-3h2.5V9.5c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.4h-1.2c-1.2 0-1.6.8-1.6 1.5V12H17l-.4 3h-2.7v7A10 10 0 0022 12z"/></svg>
						</span>
						<?php esc_html_e( 'Facebook', 'broad-run-boosters' ); ?>
					</a>
				</li>
				<li>
					<a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
						<span class="social-icon social-instagram" aria-hidden="true">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm5 5a5 5 0 100 10 5 5 0 000-10zm6.5-.9a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0zM12 9a3 3 0 110 6 3 3 0 010-6z"/></svg>
						</span>
						<?php esc_html_e( 'Instagram', 'broad-run-boosters' ); ?>
					</a>
				</li>
			</ul>
		</div>

		<div class="footer-col footer-contact">
			<h3 class="footer-heading"><?php esc_html_e( 'Broad Run Athletic Booster Club', 'broad-run-boosters' ); ?></h3>
			<address class="footer-address">
				<?php esc_html_e( 'Broad Run High School', 'broad-run-boosters' ); ?><br>
				<?php esc_html_e( '21670 Ashburn Road', 'broad-run-boosters' ); ?><br>
				<?php esc_html_e( 'Ashburn, VA 20148', 'broad-run-boosters' ); ?>
			</address>
		</div>
	</div>

	<div class="footer-bottom">
		<p class="footer-copyright">
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
			<?php esc_html_e( 'Broad Run Athletic Booster Club. All rights reserved.', 'broad-run-boosters' ); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
