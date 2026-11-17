<?php
/**
 * Fundraising — overview, Mulch Madness feature, additional fundraisers.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
the_post();
$parts      = brab_page_parts();
$mulch_page = get_page_by_path( 'fundraising/mulch-madness' );
$mulch_url  = $mulch_page ? get_permalink( $mulch_page ) : home_url( '/fundraising/mulch-madness/' );
$mulch_open = '1' === brab_setting( 'mulch_order_open' );
?>

<main id="main-content" class="site-main">
	<?php
	brab_page_hero(
		array(
			'eyebrow'  => __( 'Support Spartan Athletics', 'broad-run-boosters' ),
			'title'    => __( 'Fundraising', 'broad-run-boosters' ),
			'subtitle' => __( 'Every dollar goes back to Broad Run student-athletes.', 'broad-run-boosters' ),
			'image'    => 'hero.jpg',
		)
	);
	?>

	<section class="page-section" aria-label="<?php esc_attr_e( 'Fundraising overview', 'broad-run-boosters' ); ?>">
		<div class="page-container page-container--narrow prose prose--lead">
			<?php echo $parts['main']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</section>

	<section class="page-section page-section--flush" aria-labelledby="mulch-feature">
		<div class="feature-banner" style="--feature-image: url('<?php echo brab_img( 'gallery-1.jpg' ); ?>');">
			<div class="feature-banner-overlay"></div>
			<div class="feature-banner-content">
				<p class="feature-banner-eyebrow"><?php esc_html_e( 'Our Largest Annual Fundraiser', 'broad-run-boosters' ); ?></p>
				<h2 class="feature-banner-title" id="mulch-feature"><?php esc_html_e( 'Mulch Madness', 'broad-run-boosters' ); ?></h2>
				<p class="feature-banner-status <?php echo $mulch_open ? 'is-open' : ''; ?>">
					<?php echo $mulch_open ? esc_html__( 'Ordering is open now!', 'broad-run-boosters' ) : esc_html( brab_setting( 'mulch_closed_message' ) ); ?>
				</p>
				<div class="btn-row">
					<?php if ( $mulch_open ) : ?>
						<?php brab_button( brab_link( 'mulch_order_url' ), __( 'Order Mulch', 'broad-run-boosters' ), 'btn-gold', true ); ?>
					<?php endif; ?>
					<?php brab_button( $mulch_url, __( 'Learn About Mulch Madness', 'broad-run-boosters' ), 'btn-outline-light' ); ?>
				</div>
			</div>
		</div>
	</section>

	<section class="page-section" aria-labelledby="more-fundraisers">
		<div class="page-container">
			<?php brab_section_heading( __( 'Throughout the Year', 'broad-run-boosters' ), __( 'Additional Fundraisers', 'broad-run-boosters' ), 'more-fundraisers' ); ?>
			<?php $fundraisers = brab_get_items( 'brab_fundraiser' ); ?>
			<?php if ( $fundraisers ) : ?>
				<div class="card-grid card-grid--3">
					<?php foreach ( $fundraisers as $fr ) : ?>
						<article class="card card--media">
							<?php if ( has_post_thumbnail( $fr ) ) : ?>
								<div class="card-media"><?php echo get_the_post_thumbnail( $fr, 'medium_large' ); ?></div>
							<?php endif; ?>
							<div class="card-body">
								<?php $dates = brab_field( $fr->ID, 'dates' ); ?>
								<?php if ( $dates ) : ?>
									<p class="card-kicker"><?php echo esc_html( $dates ); ?></p>
								<?php endif; ?>
								<h3 class="card-title"><?php echo esc_html( get_the_title( $fr ) ); ?></h3>
								<div class="card-text prose"><?php echo wp_kses_post( apply_filters( 'the_content', $fr->post_content ) ); ?></div>
								<?php $link = brab_field( $fr->ID, 'link_url' ); ?>
								<?php if ( $link ) : ?>
									<?php brab_button( $link, brab_field( $fr->ID, 'link_label' ) ? brab_field( $fr->ID, 'link_label' ) : __( 'Learn More', 'broad-run-boosters' ), 'btn-outline-maroon' ); ?>
								<?php endif; ?>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<?php brab_empty_state( __( 'More fundraising events are on the way. Follow us on social media or check back soon!', 'broad-run-boosters' ) ); ?>
			<?php endif; ?>
		</div>
	</section>

	<?php get_template_part( 'template-parts/cta-band' ); ?>
</main>

<?php
get_footer();
