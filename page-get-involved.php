<?php
/**
 * Get Involved — volunteer opportunities, concessions, open positions.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
the_post();
$parts       = brab_page_parts();
$concessions = brab_link( 'concessions_signup_url' );

$opportunities = array(
	array( __( 'Concessions', 'broad-run-boosters' ), __( 'Work a shift at home games and earn money for your athlete’s team.', 'broad-run-boosters' ), '#concessions' ),
	array( __( 'Fundraising Events', 'broad-run-boosters' ), __( 'Help with Mulch Madness and other fundraisers throughout the year.', 'broad-run-boosters' ), home_url( '/fundraising/' ) ),
	array( __( 'Committees', 'broad-run-boosters' ), __( 'Lend your skills to a Booster committee or an open board position.', 'broad-run-boosters' ), '#positions' ),
	array( __( 'Special Events', 'broad-run-boosters' ), __( 'Support senior nights, banquets and celebrations of our athletes.', 'broad-run-boosters' ), brab_link( 'volunteer_signup_url' ) ),
);
?>

<main id="main-content" class="site-main">
	<?php
	brab_page_hero(
		array(
			'eyebrow'  => __( 'Volunteer', 'broad-run-boosters' ),
			'title'    => __( 'Get Involved', 'broad-run-boosters' ),
			'subtitle' => __( 'Your time makes a difference.', 'broad-run-boosters' ),
			'image'    => 'get-involved-bg.jpg',
		)
	);
	?>

	<section class="page-section" aria-labelledby="opportunities">
		<div class="page-container">
			<?php brab_section_heading( __( 'Ways to Help', 'broad-run-boosters' ), __( 'Volunteer Opportunities', 'broad-run-boosters' ), 'opportunities' ); ?>
			<?php if ( $parts['main'] ) : ?>
				<div class="prose section-intro"><?php echo $parts['main']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			<?php endif; ?>
			<div class="card-grid card-grid--4">
				<?php foreach ( $opportunities as $i => $op ) : ?>
					<a class="card card--link" href="<?php echo esc_url( $op[2] ); ?>">
						<span class="card-number"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<h3 class="card-title"><?php echo esc_html( $op[0] ); ?></h3>
						<p class="card-text"><?php echo esc_html( $op[1] ); ?></p>
						<span class="card-more"><?php esc_html_e( 'Learn more', 'broad-run-boosters' ); ?> <span aria-hidden="true">&rarr;</span></span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="page-section page-section--alt" aria-labelledby="concessions-title" id="concessions">
		<div class="page-container">
			<?php brab_section_heading( __( 'Earn Money for Your Team', 'broad-run-boosters' ), __( 'Concessions', 'broad-run-boosters' ), 'concessions-title' ); ?>
			<div class="split">
				<div class="prose">
					<?php echo $parts['extended']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<aside class="action-card action-card--dark">
					<p class="action-card-eyebrow"><?php echo $concessions ? esc_html__( 'Shifts are open now', 'broad-run-boosters' ) : esc_html__( 'Volunteer', 'broad-run-boosters' ); ?></p>
					<h3 class="action-card-title"><?php esc_html_e( 'Sign up for a concessions shift', 'broad-run-boosters' ); ?></h3>
					<p class="action-card-text"><?php esc_html_e( 'Pick a game, choose a time, and help your team earn.', 'broad-run-boosters' ); ?></p>
					<?php if ( $concessions ) : ?>
						<?php brab_button( $concessions, __( 'Sign Up for Concessions', 'broad-run-boosters' ), 'btn-gold', true ); ?>
					<?php else : ?>
						<p class="action-card-text"><?php esc_html_e( 'The sign-up link for this season will be posted soon.', 'broad-run-boosters' ); ?></p>
						<?php brab_button( 'mailto:' . brab_setting( 'contact_email' ), __( 'Email Us to Volunteer', 'broad-run-boosters' ), 'btn-gold' ); ?>
					<?php endif; ?>
				</aside>
			</div>
		</div>
	</section>

	<section class="page-section" aria-labelledby="positions-title" id="positions">
		<div class="page-container">
			<?php brab_section_heading( __( 'Lead With Us', 'broad-run-boosters' ), __( 'Open Board & Committee Positions', 'broad-run-boosters' ), 'positions-title' ); ?>
			<?php $positions = brab_get_items( 'brab_position' ); ?>
			<?php if ( $positions ) : ?>
				<div class="position-list">
					<?php foreach ( $positions as $pos ) : ?>
						<article class="position">
							<div class="position-main">
								<h3 class="position-title"><?php echo esc_html( get_the_title( $pos ) ); ?></h3>
								<div class="position-desc prose"><?php echo wp_kses_post( apply_filters( 'the_content', $pos->post_content ) ); ?></div>
								<?php $duties = brab_lines( brab_field( $pos->ID, 'responsibilities' ) ); ?>
								<?php if ( $duties ) : ?>
									<ul class="check-list">
										<?php foreach ( $duties as $duty ) : ?>
											<li><?php echo esc_html( $duty ); ?></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</div>
							<div class="position-action">
								<?php brab_button( brab_contact_href( brab_field( $pos->ID, 'contact' ) ), __( 'I’m Interested', 'broad-run-boosters' ), 'btn-outline-maroon' ); ?>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<?php brab_empty_state( __( 'There are no open positions right now — but we always welcome new volunteers. Reach out and let us know how you would like to help!', 'broad-run-boosters' ) ); ?>
				<p class="section-note"><?php brab_button( 'mailto:' . brab_setting( 'contact_email' ), __( 'Contact the Board', 'broad-run-boosters' ), 'btn-outline-maroon' ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<?php get_template_part( 'template-parts/cta-band' ); ?>
</main>

<?php
get_footer();
