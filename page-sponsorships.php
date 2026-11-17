<?php
/**
 * Sponsorships — why sponsor, packages, current sponsors, contact.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
the_post();
$parts    = brab_page_parts();
$packages = brab_get_items( 'brab_package' );
$email    = brab_setting( 'contact_email' );
?>

<main id="main-content" class="site-main">
	<?php
	brab_page_hero(
		array(
			'eyebrow'  => __( 'Partner With Us', 'broad-run-boosters' ),
			'title'    => __( 'Sponsorships', 'broad-run-boosters' ),
			'subtitle' => __( 'Make a lasting impact on Spartan athletics.', 'broad-run-boosters' ),
			'image'    => 'gallery-lacrosse.jpg',
		)
	);
	?>

	<section class="page-section" aria-labelledby="why-sponsor">
		<div class="page-container">
			<div class="split split--wide-left">
				<div>
					<?php brab_section_heading( __( 'Invest Locally', 'broad-run-boosters' ), __( 'Why Sponsor?', 'broad-run-boosters' ), 'why-sponsor' ); ?>
					<div class="prose prose--lead"><?php echo $parts['main']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				</div>
				<aside class="action-card">
					<h3 class="action-card-title"><?php esc_html_e( 'Ready to partner?', 'broad-run-boosters' ); ?></h3>
					<p class="action-card-text"><?php esc_html_e( 'Choose a package below, or reach out and we will help you find the right fit.', 'broad-run-boosters' ); ?></p>
					<div class="btn-row">
						<?php brab_button( '#packages', __( 'View Packages', 'broad-run-boosters' ), 'btn-maroon' ); ?>
					</div>
				</aside>
			</div>
		</div>
	</section>

	<section class="page-section page-section--alt" id="packages" aria-labelledby="packages-title">
		<div class="page-container">
			<?php brab_section_heading( __( 'Opportunities', 'broad-run-boosters' ), __( 'Sponsorship Packages', 'broad-run-boosters' ), 'packages-title' ); ?>
			<?php if ( $packages ) : ?>
				<div class="card-grid card-grid--<?php echo esc_attr( (string) min( 4, max( 2, count( $packages ) ) ) ); ?>">
					<?php foreach ( $packages as $pkg ) : ?>
						<?php
						$tier = brab_field( $pkg->ID, 'tier' );
						$url  = brab_field( $pkg->ID, 'url' );
						?>
						<article class="package package--<?php echo esc_attr( $tier ? $tier : 'gold' ); ?>">
							<h3 class="package-title"><?php echo esc_html( get_the_title( $pkg ) ); ?></h3>
							<?php $price = brab_field( $pkg->ID, 'price' ); ?>
							<?php if ( $price ) : ?>
								<p class="package-price"><?php echo esc_html( $price ); ?></p>
							<?php endif; ?>
							<?php $benefits = brab_lines( brab_field( $pkg->ID, 'benefits' ) ); ?>
							<?php if ( $benefits ) : ?>
								<ul class="check-list">
									<?php foreach ( $benefits as $benefit ) : ?>
										<li><?php echo esc_html( $benefit ); ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							<?php brab_button( $url ? $url : brab_link( 'sponsor_url' ), __( 'Become a Sponsor', 'broad-run-boosters' ), 'btn-maroon', true ); ?>
						</article>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<?php brab_empty_state( __( 'Sponsorship packages for this season will be posted soon. In the meantime, contact us to learn about sponsorship opportunities.', 'broad-run-boosters' ) ); ?>
			<?php endif; ?>
		</div>
	</section>

	<section class="sponsors-section" aria-labelledby="sponsors-heading">
		<header class="sponsors-header">
			<span class="sponsors-rule" aria-hidden="true"></span>
			<div class="sponsors-heading-block">
				<p class="sponsors-eyebrow"><?php esc_html_e( 'Thank You to Our', 'broad-run-boosters' ); ?></p>
				<h2 id="sponsors-heading" class="sponsors-title"><?php esc_html_e( 'Current Sponsors', 'broad-run-boosters' ); ?></h2>
			</div>
			<span class="sponsors-rule" aria-hidden="true"></span>
		</header>
		<?php get_template_part( 'template-parts/sponsor-tiers', null, array( 'all' => true ) ); ?>
	</section>

	<section class="page-section page-section--dark" aria-labelledby="become-sponsor">
		<div class="page-container split split--center">
			<div>
				<?php brab_section_heading( __( 'Join Our Sponsors', 'broad-run-boosters' ), __( 'Become a Sponsor', 'broad-run-boosters' ), 'become-sponsor', true ); ?>
				<p class="lead-light">
					<?php esc_html_e( 'Questions about sponsorship? Email us at', 'broad-run-boosters' ); ?>
					<a class="link-gold" href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a>.
				</p>
			</div>
			<div class="btn-row btn-row--end">
				<?php brab_button( brab_link( 'sponsor_url' ), __( 'Become a Sponsor', 'broad-run-boosters' ), 'btn-gold', true ); ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
