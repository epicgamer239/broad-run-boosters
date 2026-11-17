<?php
/**
 * Maroon "more ways to support" band shown at the bottom of inner pages.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current = get_post_field( 'post_name', get_queried_object_id() );
$links   = array(
	'membership'   => array( __( 'Join', 'broad-run-boosters' ), __( 'Become a Member', 'broad-run-boosters' ) ),
	'sponsorships' => array( __( 'Sponsor', 'broad-run-boosters' ), __( 'Become a Sponsor', 'broad-run-boosters' ) ),
	'donate'       => array( __( 'Donate', 'broad-run-boosters' ), __( 'Make a Donation', 'broad-run-boosters' ) ),
	'get-involved' => array( __( 'Volunteer', 'broad-run-boosters' ), __( 'Get Involved', 'broad-run-boosters' ) ),
);
unset( $links[ $current ] );
?>
<section class="cta-band" aria-label="<?php esc_attr_e( 'More ways to support', 'broad-run-boosters' ); ?>">
	<div class="cta-band-inner">
		<p class="cta-band-title"><?php esc_html_e( 'Back the teams that bring us together.', 'broad-run-boosters' ); ?></p>
		<div class="cta-band-links">
			<?php foreach ( $links as $slug => $link ) : ?>
				<a class="cta-band-link" href="<?php echo esc_url( home_url( '/' . $slug . '/' ) ); ?>">
					<span class="cta-band-link-kicker"><?php echo esc_html( $link[0] ); ?></span>
					<span class="cta-band-link-label"><?php echo esc_html( $link[1] ); ?> <span aria-hidden="true">&rarr;</span></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
