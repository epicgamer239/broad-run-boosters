<?php
/**
 * Shop — products linked to the Square store, team donations,
 * membership and sponsorship shortcuts.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
the_post();
$parts = brab_page_parts();
$store = brab_link( 'square_store_url' );

$by_cat = array();
foreach ( brab_get_items( 'brab_product' ) as $product ) {
	$by_cat[ brab_field( $product->ID, 'category' ) ][] = $product;
}

$sections = array(
	'yard-signs'  => array( __( 'Yard Signs', 'broad-run-boosters' ), __( 'Show your Spartan pride on your lawn — personalized signs for your athlete and team.', 'broad-run-boosters' ) ),
	'car-decals'  => array( __( 'Car Decals', 'broad-run-boosters' ), __( 'Take your team spirit on the road with official Broad Run sport decals.', 'broad-run-boosters' ) ),
	'spirit-wear' => array( __( 'More from the Store', 'broad-run-boosters' ), '' ),
);
?>

<main id="main-content" class="site-main">
	<?php
	brab_page_hero(
		array(
			'eyebrow'  => __( 'Spartan Pride', 'broad-run-boosters' ),
			'title'    => __( 'Shop', 'broad-run-boosters' ),
			'subtitle' => __( 'Every purchase supports Broad Run athletics.', 'broad-run-boosters' ),
			'image'    => 'gallery-football.jpg',
		)
	);
	?>

	<nav class="sub-nav" aria-label="<?php esc_attr_e( 'Shop sections', 'broad-run-boosters' ); ?>">
		<a href="#yard-signs"><?php esc_html_e( 'Yard Signs', 'broad-run-boosters' ); ?></a>
		<a href="#car-decals"><?php esc_html_e( 'Car Decals', 'broad-run-boosters' ); ?></a>
		<a href="#team-donations"><?php esc_html_e( 'Team Donations', 'broad-run-boosters' ); ?></a>
		<a href="#membership"><?php esc_html_e( 'Membership', 'broad-run-boosters' ); ?></a>
		<a href="#sponsorships"><?php esc_html_e( 'Sponsorships', 'broad-run-boosters' ); ?></a>
	</nav>

	<?php if ( $parts['main'] ) : ?>
		<section class="page-section page-section--tight">
			<div class="page-container page-container--narrow prose prose--center"><?php echo $parts['main']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
		</section>
	<?php endif; ?>

	<?php foreach ( $sections as $cat => $meta ) : ?>
		<?php
		$items = isset( $by_cat[ $cat ] ) ? $by_cat[ $cat ] : array();
		if ( 'spirit-wear' === $cat && ! $items ) {
			continue;
		}
		?>
		<section class="page-section<?php echo 'car-decals' === $cat ? ' page-section--alt' : ''; ?>" id="<?php echo esc_attr( $cat ); ?>" aria-labelledby="<?php echo esc_attr( $cat ); ?>-title">
			<div class="page-container">
				<?php brab_section_heading( __( 'Shop', 'broad-run-boosters' ), $meta[0], $cat . '-title' ); ?>
				<?php if ( $meta[1] ) : ?>
					<p class="section-intro"><?php echo esc_html( $meta[1] ); ?></p>
				<?php endif; ?>
				<?php if ( $items ) : ?>
					<div class="card-grid card-grid--3">
						<?php foreach ( $items as $item ) : ?>
							<article class="card card--media product">
								<div class="card-media">
									<?php if ( has_post_thumbnail( $item ) ) : ?>
										<?php echo get_the_post_thumbnail( $item, 'medium_large' ); ?>
									<?php else : ?>
										<img src="<?php echo brab_img( 'logo-crest.png' ); ?>" alt="" class="product-fallback">
									<?php endif; ?>
								</div>
								<div class="card-body">
									<h3 class="card-title"><?php echo esc_html( get_the_title( $item ) ); ?></h3>
									<?php $price = brab_field( $item->ID, 'price' ); ?>
									<?php if ( $price ) : ?>
										<p class="product-price"><?php echo esc_html( $price ); ?></p>
									<?php endif; ?>
									<div class="card-text prose"><?php echo wp_kses_post( apply_filters( 'the_content', $item->post_content ) ); ?></div>
									<?php
									$url   = brab_field( $item->ID, 'url' );
									$label = brab_field( $item->ID, 'button_label' );
									brab_button( $url ? $url : $store, $label ? $label : __( 'Buy Now', 'broad-run-boosters' ), 'btn-maroon', true );
									?>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				<?php else : ?>
					<div class="store-callout">
						<p><?php esc_html_e( 'See current designs, pricing and ordering details in our online store.', 'broad-run-boosters' ); ?></p>
						<?php
						/* translators: %s: product type */
						brab_button( $store, sprintf( __( 'Shop %s', 'broad-run-boosters' ), $meta[0] ), 'btn-maroon', true );
						?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endforeach; ?>

	<section class="page-section page-section--dark" id="team-donations" aria-labelledby="team-donations-title">
		<div class="page-container split split--center">
			<div>
				<?php brab_section_heading( __( 'Give Directly', 'broad-run-boosters' ), __( 'Team Donations', 'broad-run-boosters' ), 'team-donations-title', true ); ?>
				<p class="lead-light"><?php esc_html_e( 'Support a specific Spartan team. Your donation goes straight to the program you choose.', 'broad-run-boosters' ); ?></p>
			</div>
			<?php get_template_part( 'template-parts/team-donate' ); ?>
		</div>
	</section>

	<section class="page-section" aria-label="<?php esc_attr_e( 'Membership and sponsorships', 'broad-run-boosters' ); ?>">
		<div class="page-container">
			<div class="card-grid card-grid--2">
				<article class="card card--feature" id="membership">
					<p class="card-kicker"><?php esc_html_e( 'Join', 'broad-run-boosters' ); ?></p>
					<h2 class="card-title card-title--lg"><?php esc_html_e( 'Booster Membership', 'broad-run-boosters' ); ?></h2>
					<p class="card-text"><?php esc_html_e( 'An annual membership supports every Broad Run team at once.', 'broad-run-boosters' ); ?></p>
					<?php $fee = brab_setting( 'membership_fee' ); ?>
					<?php if ( $fee ) : ?>
						<p class="product-price"><?php echo esc_html( $fee ); ?></p>
					<?php endif; ?>
					<div class="btn-row">
						<?php brab_button( brab_link( 'membership_url' ), __( 'Buy Membership', 'broad-run-boosters' ), 'btn-maroon', true ); ?>
						<?php brab_button( home_url( '/membership/' ), __( 'Learn More', 'broad-run-boosters' ), 'btn-outline-maroon' ); ?>
					</div>
				</article>
				<article class="card card--feature card--feature-gold" id="sponsorships">
					<p class="card-kicker"><?php esc_html_e( 'Partner', 'broad-run-boosters' ); ?></p>
					<h2 class="card-title card-title--lg"><?php esc_html_e( 'Business Sponsorships', 'broad-run-boosters' ); ?></h2>
					<p class="card-text"><?php esc_html_e( 'Sponsorship packages give local businesses meaningful visibility with Spartan families.', 'broad-run-boosters' ); ?></p>
					<div class="btn-row">
						<?php brab_button( home_url( '/sponsorships/#packages' ), __( 'View Packages', 'broad-run-boosters' ), 'btn-maroon' ); ?>
					</div>
				</article>
			</div>
			<p class="section-note section-note--center">
				<?php esc_html_e( 'All purchases are processed securely by Square.', 'broad-run-boosters' ); ?>
				<a href="<?php echo esc_url( $store ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Visit the full store', 'broad-run-boosters' ); ?> &rarr;</a>
			</p>
		</div>
	</section>
</main>

<?php
get_footer();
