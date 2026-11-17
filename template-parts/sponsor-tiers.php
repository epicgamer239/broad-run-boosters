<?php
/**
 * Sponsor logos grouped by tier.
 *
 * Args: all (bool) — true for every published sponsor, false for homepage-flagged only.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = isset( $args ) && is_array( $args ) ? $args : array();
?>
	<?php
	$sponsors_by_tier = empty( $args['all'] ) ? brab_get_sponsors_for_display() : brab_get_all_sponsors_by_tier();
	$tier_labels      = array(
		'gold'   => __( 'Gold Sponsors', 'broad-run-boosters' ),
		'silver' => __( 'Silver Sponsors', 'broad-run-boosters' ),
		'bronze' => __( 'Bronze Sponsors', 'broad-run-boosters' ),
	);
	?>
	<div class="sponsors-tiers">
		<?php foreach ( $tier_labels as $tier_key => $tier_label ) : ?>
			<?php $tier_sponsors = isset( $sponsors_by_tier[ $tier_key ] ) ? $sponsors_by_tier[ $tier_key ] : array(); ?>
			<div class="sponsor-tier sponsor-tier-<?php echo esc_attr( $tier_key ); ?>">
				<h3 class="sponsor-tier-label"><?php echo esc_html( $tier_label ); ?></h3>
				<div class="sponsor-logos">
					<?php if ( ! empty( $tier_sponsors ) ) : ?>
						<?php foreach ( $tier_sponsors as $sponsor ) : ?>
							<?php brab_render_sponsor_logo( $sponsor ); ?>
						<?php endforeach; ?>
					<?php else : ?>
						<span class="sponsor-logo sponsor-logo--placeholder">
							<span class="sponsor-logo-fallback"><?php echo esc_html( sprintf( /* translators: %s: tier name */ __( '%s placeholder', 'broad-run-boosters' ), $tier_label ) ); ?></span>
						</span>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

