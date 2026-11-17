<?php
/**
 * Mulch Madness — dedicated fundraiser page with on/off ordering.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
the_post();
$parts  = brab_page_parts();
$open   = '1' === brab_setting( 'mulch_order_open' );
$dates  = brab_setting_pairs( 'mulch_dates' );
$photos = brab_setting_gallery( 'mulch_photos', 'medium_large' );
?>

<main id="main-content" class="site-main">
	<?php
	brab_page_hero(
		array(
			'eyebrow'  => __( 'Annual Fundraiser', 'broad-run-boosters' ),
			'title'    => __( 'Mulch Madness', 'broad-run-boosters' ),
			'subtitle' => __( 'Beautify your yard. Support Spartan athletes.', 'broad-run-boosters' ),
			'image'    => 'gallery-1.jpg',
		)
	);
	?>

	<div class="status-strip <?php echo $open ? 'is-open' : 'is-closed'; ?>" role="status">
		<div class="status-strip-inner">
			<p>
				<strong><?php echo $open ? esc_html__( 'Ordering is open!', 'broad-run-boosters' ) : esc_html__( 'Ordering is closed.', 'broad-run-boosters' ); ?></strong>
				<?php if ( ! $open ) : ?>
					<?php echo esc_html( brab_setting( 'mulch_closed_message' ) ); ?>
				<?php endif; ?>
			</p>
			<?php if ( $open ) : ?>
				<?php brab_button( brab_link( 'mulch_order_url' ), __( 'Order Mulch', 'broad-run-boosters' ), 'btn-maroon', true ); ?>
			<?php endif; ?>
		</div>
	</div>

	<section class="page-section" aria-labelledby="mulch-overview">
		<div class="page-container">
			<div class="split split--wide-left">
				<div>
					<?php brab_section_heading( __( 'The Sale', 'broad-run-boosters' ), __( 'Overview', 'broad-run-boosters' ), 'mulch-overview' ); ?>
					<div class="prose prose--lead"><?php echo $parts['main']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				</div>
				<aside class="action-card">
					<h3 class="action-card-title"><?php esc_html_e( 'Important Dates', 'broad-run-boosters' ); ?></h3>
					<?php if ( $dates ) : ?>
						<dl class="dates-list">
							<?php foreach ( $dates as $row ) : ?>
								<div class="dates-row">
									<dt><?php echo esc_html( $row[0] ); ?></dt>
									<dd><?php echo esc_html( $row[1] ); ?></dd>
								</div>
							<?php endforeach; ?>
						</dl>
					<?php else : ?>
						<p class="action-card-text"><?php esc_html_e( 'Dates for the next sale will be announced soon.', 'broad-run-boosters' ); ?></p>
					<?php endif; ?>
				</aside>
			</div>
		</div>
	</section>

	<section class="page-section page-section--alt" aria-labelledby="mulch-ordering">
		<div class="page-container">
			<div class="split">
				<div>
					<?php brab_section_heading( __( 'How to Order', 'broad-run-boosters' ), __( 'Ordering Information', 'broad-run-boosters' ), 'mulch-ordering' ); ?>
					<div class="prose"><?php echo $parts['extended']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				</div>
				<aside class="action-card action-card--dark">
					<?php if ( $open ) : ?>
						<p class="action-card-eyebrow"><?php esc_html_e( 'Sale is live', 'broad-run-boosters' ); ?></p>
						<h3 class="action-card-title"><?php esc_html_e( 'Place your mulch order', 'broad-run-boosters' ); ?></h3>
						<p class="action-card-text"><?php esc_html_e( 'Secure checkout through our Square store.', 'broad-run-boosters' ); ?></p>
						<?php brab_button( brab_link( 'mulch_order_url' ), __( 'Order Mulch', 'broad-run-boosters' ), 'btn-gold', true ); ?>
					<?php else : ?>
						<p class="action-card-eyebrow"><?php esc_html_e( 'Ordering closed', 'broad-run-boosters' ); ?></p>
						<h3 class="action-card-title"><?php esc_html_e( 'See you next season', 'broad-run-boosters' ); ?></h3>
						<p class="action-card-text"><?php echo esc_html( brab_setting( 'mulch_closed_message' ) ); ?></p>
					<?php endif; ?>
				</aside>
			</div>
		</div>
	</section>

	<?php if ( $photos ) : ?>
		<section class="page-section" aria-labelledby="mulch-photos">
			<div class="page-container">
				<?php brab_section_heading( __( 'Previous Years', 'broad-run-boosters' ), __( 'Mulch Madness in Action', 'broad-run-boosters' ), 'mulch-photos' ); ?>
				<div class="photo-grid">
					<?php foreach ( $photos as $photo ) : ?>
						<figure class="photo-grid-item"><img src="<?php echo esc_url( $photo['src'] ); ?>" alt="<?php echo esc_attr( $photo['alt'] ? $photo['alt'] : __( 'Mulch Madness volunteers', 'broad-run-boosters' ) ); ?>" loading="lazy"></figure>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="page-section page-section--dark" aria-labelledby="mulch-volunteer">
		<div class="page-container split split--center">
			<div>
				<?php brab_section_heading( __( 'Many Hands', 'broad-run-boosters' ), __( 'Volunteer for Delivery Day', 'broad-run-boosters' ), 'mulch-volunteer', true ); ?>
				<p class="lead-light"><?php esc_html_e( 'Mulch Madness depends on student-athletes, parents and community volunteers. Help load, deliver and spread the Spartan spirit across Ashburn.', 'broad-run-boosters' ); ?></p>
			</div>
			<div class="btn-row btn-row--end">
				<?php brab_button( brab_link( 'volunteer_signup_url' ), __( 'Volunteer', 'broad-run-boosters' ), 'btn-gold' ); ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
