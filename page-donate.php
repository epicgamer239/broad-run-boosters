<?php
/**
 * Donate — general and team-specific donations via Square.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
the_post();
$parts = brab_page_parts();
?>

<main id="main-content" class="site-main">
	<?php
	brab_page_hero(
		array(
			'eyebrow'  => __( 'Directly Support Spartan Athletes', 'broad-run-boosters' ),
			'title'    => __( 'Donate', 'broad-run-boosters' ),
			'subtitle' => __( 'Simple, secure and straight to our student-athletes.', 'broad-run-boosters' ),
			'image'    => 'hero.jpg',
		)
	);
	?>

	<?php if ( $parts['main'] ) : ?>
		<section class="page-section page-section--tight">
			<div class="page-container page-container--narrow prose prose--center prose--lead"><?php echo $parts['main']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
		</section>
	<?php endif; ?>

	<section class="page-section page-section--pt0" aria-label="<?php esc_attr_e( 'Donation options', 'broad-run-boosters' ); ?>">
		<div class="page-container">
			<div class="donate-grid">
				<article class="donate-option">
					<span class="donate-option-icon" aria-hidden="true">
						<svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
					</span>
					<h2 class="donate-option-title"><?php esc_html_e( 'General Donation', 'broad-run-boosters' ); ?></h2>
					<p class="donate-option-text"><?php esc_html_e( 'Support every Broad Run team. Your gift goes where it is needed most — equipment, team support, scholarships and recognition.', 'broad-run-boosters' ); ?></p>
					<?php brab_button( brab_link( 'donate_url' ), __( 'Make a Donation', 'broad-run-boosters' ), 'btn-maroon', true ); ?>
				</article>

				<article class="donate-option donate-option--dark">
					<span class="donate-option-icon" aria-hidden="true">
						<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3l2.6 5.3 5.9.9-4.3 4.1 1 5.8L12 16.4 6.8 19.1l1-5.8L3.5 9.2l5.9-.9L12 3z"/></svg>
					</span>
					<h2 class="donate-option-title"><?php esc_html_e( 'Team-Specific Donation', 'broad-run-boosters' ); ?></h2>
					<p class="donate-option-text"><?php esc_html_e( 'Want to support a particular program? Choose the team and give directly.', 'broad-run-boosters' ); ?></p>
					<?php get_template_part( 'template-parts/team-donate' ); ?>
				</article>
			</div>
			<p class="section-note section-note--center"><?php esc_html_e( 'Donations are processed securely through Square.', 'broad-run-boosters' ); ?></p>
		</div>
	</section>

	<?php get_template_part( 'template-parts/cta-band' ); ?>
</main>

<?php
get_footer();
