<?php
/**
 * Homepage template — matches the Broad Run Boosters mockup.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$gallery_images = array(
	array(
		'src' => 'gallery-football.jpg',
		'alt' => __( 'Spartan football action', 'broad-run-boosters' ),
	),
	array(
		'src' => 'gallery-soccer.jpg',
		'alt' => __( 'Spartan soccer', 'broad-run-boosters' ),
	),
	array(
		'src' => 'gallery-volleyball.jpg',
		'alt' => __( 'Spartan volleyball', 'broad-run-boosters' ),
	),
	array(
		'src' => 'gallery-swim.jpg',
		'alt' => __( 'Spartan swimming', 'broad-run-boosters' ),
	),
	array(
		'src' => 'gallery-lacrosse.jpg',
		'alt' => __( 'Spartan lacrosse', 'broad-run-boosters' ),
	),
	array(
		'src' => 'gallery-track.jpg',
		'alt' => __( 'Spartan track and field', 'broad-run-boosters' ),
	),
);
?>

<main id="main-content" class="site-main">

	<!-- Hero -->
	<section class="hero" style="--hero-image: url('<?php echo brab_img( 'hero.jpg' ); ?>');">
		<div class="hero-overlay"></div>
		<div class="hero-content">
			<p class="hero-eyebrow"><?php esc_html_e( 'Student Athletes | Stronger Together', 'broad-run-boosters' ); ?></p>
			<h1 class="hero-title">
				<?php esc_html_e( 'Back the Teams That', 'broad-run-boosters' ); ?>
				<br>
				<span class="hero-title-accent"><?php esc_html_e( 'Bring Us Together.', 'broad-run-boosters' ); ?></span>
			</h1>
			<p class="hero-sub"><?php esc_html_e( 'One Community. Every Team. Every Season.', 'broad-run-boosters' ); ?></p>
			<a class="btn btn-outline-light" href="<?php echo esc_url( home_url( '/donate/' ) ); ?>">
				<?php esc_html_e( 'Support Spartan Athletics', 'broad-run-boosters' ); ?>
				<span class="btn-arrow" aria-hidden="true">&rarr;</span>
			</a>
		</div>
	</section>

	<!-- Primary CTAs -->
	<section class="cta-grid" aria-label="<?php esc_attr_e( 'Ways to support', 'broad-run-boosters' ); ?>">
		<div class="cta-grid-inner">
			<article class="cta-item cta-maroon">
				<div class="cta-icon" aria-hidden="true">
					<svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
				</div>
				<h2 class="cta-title"><?php esc_html_e( 'Join', 'broad-run-boosters' ); ?></h2>
				<p class="cta-text"><?php esc_html_e( 'Become a member and support Spartan athletics.', 'broad-run-boosters' ); ?></p>
				<a class="btn btn-maroon" href="<?php echo esc_url( home_url( '/membership/' ) ); ?>">
					<?php esc_html_e( 'Become a Member', 'broad-run-boosters' ); ?>
					<span class="btn-arrow" aria-hidden="true">&rarr;</span>
				</a>
			</article>

			<article class="cta-item cta-gold">
				<div class="cta-icon" aria-hidden="true">
					<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M8 13l-2.5-2.5a2.1 2.1 0 013-3L11 10"/><path d="M16 13l2.5-2.5a2.1 2.1 0 00-3-3L13 10"/><path d="M8 13v1.5a4 4 0 004 4 4 4 0 004-4V13"/><path d="M9.5 8.5L12 11l2.5-2.5"/></svg>
				</div>
				<h2 class="cta-title"><?php esc_html_e( 'Sponsor', 'broad-run-boosters' ); ?></h2>
				<p class="cta-text"><?php esc_html_e( 'Partner with us to make a lasting impact.', 'broad-run-boosters' ); ?></p>
				<a class="btn btn-gold" href="<?php echo esc_url( home_url( '/sponsorships/' ) ); ?>">
					<?php esc_html_e( 'Become a Sponsor', 'broad-run-boosters' ); ?>
					<span class="btn-arrow" aria-hidden="true">&rarr;</span>
				</a>
			</article>

			<article class="cta-item cta-maroon">
				<div class="cta-icon" aria-hidden="true">
					<svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
				</div>
				<h2 class="cta-title"><?php esc_html_e( 'Donate', 'broad-run-boosters' ); ?></h2>
				<p class="cta-text"><?php esc_html_e( 'Directly support Spartan athletes.', 'broad-run-boosters' ); ?></p>
				<a class="btn btn-maroon" href="<?php echo esc_url( home_url( '/donate/' ) ); ?>">
					<?php esc_html_e( 'Make a Donation', 'broad-run-boosters' ); ?>
					<span class="btn-arrow" aria-hidden="true">&rarr;</span>
				</a>
			</article>

			<article class="cta-item cta-gold">
				<div class="cta-icon" aria-hidden="true">
					<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="8" r="2.5"/><circle cx="15" cy="8" r="2.5"/><circle cx="12" cy="13.5" r="2.5"/><path d="M4.5 18c.8-2.2 2.6-3.5 4.5-3.5s3.7 1.3 4.5 3.5M10.5 18c.8-2.2 2.6-3.5 4.5-3.5s3.7 1.3 4.5 3.5"/></svg>
				</div>
				<h2 class="cta-title"><?php esc_html_e( 'Volunteer', 'broad-run-boosters' ); ?></h2>
				<p class="cta-text"><?php esc_html_e( 'Your time makes a difference.', 'broad-run-boosters' ); ?></p>
				<a class="btn btn-gold" href="<?php echo esc_url( home_url( '/get-involved/' ) ); ?>">
					<?php esc_html_e( 'Get Involved', 'broad-run-boosters' ); ?>
					<span class="btn-arrow" aria-hidden="true">&rarr;</span>
				</a>
			</article>
		</div>
	</section>

	<!-- Why Boosters Matter -->
	<section class="why-boosters" style="--why-image: url('<?php echo brab_img( 'hero-placeholder.jpg' ); ?>');">
		<div class="why-boosters-overlay"></div>
		<div class="why-boosters-inner">
			<div class="why-copy">
				<p class="why-eyebrow">
					<?php esc_html_e( 'Why Boosters', 'broad-run-boosters' ); ?>
					<span class="why-eyebrow-accent"><?php esc_html_e( 'Matter', 'broad-run-boosters' ); ?></span>
				</p>
				<h2 class="why-title"><?php esc_html_e( 'Your Support. Their Success.', 'broad-run-boosters' ); ?></h2>
				<p class="why-text">
					<?php esc_html_e( 'The Broad Run Athletic Booster Club raises funds and builds community to enhance the student-athlete experience across all Spartan teams.', 'broad-run-boosters' ); ?>
				</p>
			</div>

			<div class="why-grid">
				<article class="why-item">
					<div class="why-icon" aria-hidden="true">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12h20M6 8v8M18 8v8M9 6v12M15 6v12"/></svg>
					</div>
					<h3 class="why-item-title"><?php esc_html_e( 'Equipment & Facilities', 'broad-run-boosters' ); ?></h3>
					<p class="why-item-text"><?php esc_html_e( 'Help provide equipment, upgrades and resources our teams need to compete.', 'broad-run-boosters' ); ?></p>
				</article>
				<article class="why-item">
					<div class="why-icon" aria-hidden="true">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="9" cy="8" r="2.5"/><circle cx="15" cy="8" r="2.5"/><path d="M4 18c1-2.5 3-4 5-4s4 1.5 5 4M10 18c1-2.5 3-4 5-4s4 1.5 5 4"/></svg>
					</div>
					<h3 class="why-item-title"><?php esc_html_e( 'Team Support', 'broad-run-boosters' ); ?></h3>
					<p class="why-item-text"><?php esc_html_e( 'Fund team needs, travel support and special programs across all sports.', 'broad-run-boosters' ); ?></p>
				</article>
				<article class="why-item">
					<div class="why-icon" aria-hidden="true">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 9l8-5 8 5v2H4V9z"/><path d="M6 11v5c2 1.5 4 2.2 6 2.2S16 17.5 18 16v-5"/><path d="M12 16v3"/></svg>
					</div>
					<h3 class="why-item-title"><?php esc_html_e( 'Scholarships', 'broad-run-boosters' ); ?></h3>
					<p class="why-item-text"><?php esc_html_e( 'Invest in our student-athletes\' futures with annual scholarships for deserving seniors.', 'broad-run-boosters' ); ?></p>
				</article>
				<article class="why-item">
					<div class="why-icon" aria-hidden="true">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 21h8M12 17v4M7 4h10v4a5 5 0 01-10 0V4z"/><path d="M7 4H4v2a3 3 0 003 3M17 4h3v2a3 3 0 01-3 3"/></svg>
					</div>
					<h3 class="why-item-title"><?php esc_html_e( 'Events & Recognition', 'broad-run-boosters' ); ?></h3>
					<p class="why-item-text"><?php esc_html_e( 'Support senior nights, awards, banquets and programs that celebrate our athletes.', 'broad-run-boosters' ); ?></p>
				</article>
			</div>
		</div>
	</section>

	<!-- Spartans in Action -->
	<section class="gallery-section" aria-labelledby="gallery-heading">
		<div class="gallery-header">
			<div class="gallery-heading-wrap">
				<h2 id="gallery-heading" class="gallery-title"><?php esc_html_e( 'Spartans in Action', 'broad-run-boosters' ); ?></h2>
				<span class="gallery-title-rule" aria-hidden="true"></span>
			</div>
			<p class="gallery-tagline"><?php esc_html_e( 'All Teams. One Community.', 'broad-run-boosters' ); ?></p>
			<div class="gallery-nav">
				<button type="button" class="gallery-btn gallery-prev" aria-label="<?php esc_attr_e( 'Previous photos', 'broad-run-boosters' ); ?>">
					<span aria-hidden="true">&larr;</span>
				</button>
				<button type="button" class="gallery-btn gallery-next" aria-label="<?php esc_attr_e( 'Next photos', 'broad-run-boosters' ); ?>">
					<span aria-hidden="true">&rarr;</span>
				</button>
			</div>
		</div>

		<div class="gallery-track-wrap">
			<div class="gallery-track" id="gallery-track">
				<?php foreach ( $gallery_images as $image ) : ?>
					<figure class="gallery-item">
						<img
							src="<?php echo brab_img( $image['src'] ); ?>"
							alt="<?php echo esc_attr( $image['alt'] ); ?>"
							loading="lazy"
							width="320"
							height="420"
						>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Meeting + Get Involved -->
	<section class="info-split">
		<div class="info-meeting">
			<div class="meeting-icon" aria-hidden="true">
				<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
					<rect x="3" y="5" width="18" height="16" rx="1"/>
					<path d="M3 10h18M8 3v4M16 3v4"/>
					<path d="M8 14h2M12 14h2M16 14h2M8 17h2M12 17h2"/>
				</svg>
			</div>
			<div class="meeting-content">
				<?php $meeting = brab_get_meeting_settings(); ?>
				<p class="meeting-label"><?php esc_html_e( 'Next Booster Meeting', 'broad-run-boosters' ); ?></p>
				<p class="meeting-date"><?php echo esc_html( $meeting['date'] ); ?></p>
				<p class="meeting-meta"><?php echo esc_html( $meeting['time'] . ' | ' . $meeting['location'] ); ?></p>
				<a class="btn btn-maroon" href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">
					<?php esc_html_e( 'View All Meeting Dates', 'broad-run-boosters' ); ?>
					<span class="btn-arrow" aria-hidden="true">&rarr;</span>
				</a>
			</div>
		</div>

		<div class="info-involved" style="--involved-image: url('<?php echo brab_img( 'get-involved-bg.jpg' ); ?>');">
			<div class="involved-overlay"></div>
			<div class="involved-content">
				<h2 class="involved-title"><?php esc_html_e( 'Get Involved', 'broad-run-boosters' ); ?></h2>
				<p class="involved-tags">
					<?php esc_html_e( 'Concessions | Open Positions', 'broad-run-boosters' ); ?><br>
					<?php esc_html_e( 'Fundraising | And More', 'broad-run-boosters' ); ?>
				</p>
				<a class="btn btn-gold" href="<?php echo esc_url( home_url( '/get-involved/' ) ); ?>">
					<?php esc_html_e( 'Explore Volunteer Opportunities', 'broad-run-boosters' ); ?>
					<span class="btn-arrow" aria-hidden="true">&rarr;</span>
				</a>
			</div>
		</div>
	</section>

	<!-- Sponsors -->
	<section class="sponsors-section" aria-labelledby="sponsors-heading">
		<header class="sponsors-header">
			<span class="sponsors-rule" aria-hidden="true"></span>
			<div class="sponsors-heading-block">
				<p class="sponsors-eyebrow"><?php esc_html_e( 'Thank You to Our', 'broad-run-boosters' ); ?></p>
				<h2 id="sponsors-heading" class="sponsors-title"><?php esc_html_e( 'Spartan Sponsors', 'broad-run-boosters' ); ?></h2>
			</div>
			<span class="sponsors-rule" aria-hidden="true"></span>
		</header>

		<?php
		$sponsors_by_tier = brab_get_sponsors_for_display();
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

		<div class="sponsors-cta">
			<a class="btn btn-outline-maroon" href="<?php echo esc_url( home_url( '/sponsorships/' ) ); ?>">
				<?php esc_html_e( 'Become a Sponsor', 'broad-run-boosters' ); ?>
				<span class="btn-arrow" aria-hidden="true">&rarr;</span>
			</a>
		</div>
	</section>

</main>

<?php
get_footer();
