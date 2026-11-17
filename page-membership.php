<?php
/**
 * Membership — why join, become a member, member recognition.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
the_post();
$parts = brab_page_parts();
$fee   = brab_setting( 'membership_fee' );

// Members with permission to publish, grouped by year (newest first), alphabetical.
$by_year = array();
$members = brab_get_items(
	'brab_member',
	array(
		'orderby'    => 'title',
		'order'      => 'ASC',
		'meta_query' => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			array(
				'key'   => '_brab_permission',
				'value' => '1',
			),
		),
	)
);
foreach ( $members as $m ) {
	$by_year[ brab_field( $m->ID, 'year' ) ][] = get_the_title( $m );
}
krsort( $by_year, SORT_NATURAL );
?>

<main id="main-content" class="site-main">
	<?php
	brab_page_hero(
		array(
			'eyebrow'  => __( 'Join the Boosters', 'broad-run-boosters' ),
			'title'    => __( 'Membership', 'broad-run-boosters' ),
			'subtitle' => __( 'Become a member and support Spartan athletics.', 'broad-run-boosters' ),
			'image'    => 'gallery-soccer.jpg',
		)
	);
	?>

	<section class="page-section" aria-labelledby="why-join">
		<div class="page-container">
			<div class="split split--wide-left">
				<div>
					<?php brab_section_heading( __( 'Membership Matters', 'broad-run-boosters' ), __( 'Why Join?', 'broad-run-boosters' ), 'why-join' ); ?>
					<div class="prose prose--lead"><?php echo $parts['main']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				</div>
				<aside class="action-card action-card--dark" id="join">
					<p class="action-card-eyebrow"><?php esc_html_e( 'Annual Membership', 'broad-run-boosters' ); ?></p>
					<h3 class="action-card-title"><?php esc_html_e( 'Become a Member', 'broad-run-boosters' ); ?></h3>
					<?php if ( $fee ) : ?>
						<p class="action-card-price"><?php echo esc_html( $fee ); ?></p>
					<?php endif; ?>
					<div class="action-card-text prose prose--light"><?php echo $parts['extended']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
					<?php brab_button( brab_link( 'membership_url' ), __( 'Join the Boosters', 'broad-run-boosters' ), 'btn-gold', true ); ?>
				</aside>
			</div>
		</div>
	</section>

	<section class="page-section page-section--alt" aria-labelledby="members">
		<div class="page-container">
			<?php brab_section_heading( __( 'Thank You', 'broad-run-boosters' ), __( 'Our Booster Members', 'broad-run-boosters' ), 'members' ); ?>
			<?php if ( $by_year ) : ?>
				<?php foreach ( $by_year as $year => $names ) : ?>
					<div class="member-year">
						<h3 class="subheading">
							<?php
							/* translators: %s: membership year */
							echo esc_html( $year ? sprintf( __( '%s Members', 'broad-run-boosters' ), $year ) : __( 'Members', 'broad-run-boosters' ) );
							?>
						</h3>
						<ul class="member-list">
							<?php foreach ( $names as $name ) : ?>
								<li><?php echo esc_html( $name ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<?php brab_empty_state( __( 'Thank you to all of our Booster members! Our member recognition list will be posted soon.', 'broad-run-boosters' ) ); ?>
			<?php endif; ?>
			<p class="section-note"><?php esc_html_e( 'Member names are only listed with permission.', 'broad-run-boosters' ); ?></p>
		</div>
	</section>

	<?php get_template_part( 'template-parts/cta-band' ); ?>
</main>

<?php
get_footer();
