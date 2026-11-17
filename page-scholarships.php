<?php
/**
 * Scholarships — overview, deadlines, documents, recipients by class.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
the_post();
$parts     = brab_page_parts();
$deadlines = brab_setting_pairs( 'scholarship_dates' );
$documents = brab_get_items( 'brab_document' );

// Recipients grouped by graduating class, newest first.
$by_class = array();
foreach ( brab_get_items( 'brab_recipient', array( 'orderby' => 'title', 'order' => 'ASC' ) ) as $r ) {
	$year                = brab_field( $r->ID, 'class_year' );
	$by_class[ $year ][] = $r;
}
krsort( $by_class, SORT_NATURAL );
?>

<main id="main-content" class="site-main">
	<?php
	brab_page_hero(
		array(
			'eyebrow'  => __( 'Investing in Their Futures', 'broad-run-boosters' ),
			'title'    => __( 'Scholarships', 'broad-run-boosters' ),
			'subtitle' => __( 'Honoring senior student-athletes who make Broad Run proud.', 'broad-run-boosters' ),
			'image'    => 'gallery-track.jpg',
		)
	);
	?>

	<section class="page-section" aria-labelledby="scholarship-overview">
		<div class="page-container">
			<div class="split split--wide-left">
				<div>
					<?php brab_section_heading( __( 'Our Program', 'broad-run-boosters' ), __( 'Scholarship Overview', 'broad-run-boosters' ), 'scholarship-overview' ); ?>
					<div class="prose prose--lead"><?php echo $parts['main']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				</div>
				<aside class="action-card">
					<h3 class="action-card-title"><?php esc_html_e( 'Important Deadlines', 'broad-run-boosters' ); ?></h3>
					<?php if ( $deadlines ) : ?>
						<dl class="dates-list">
							<?php foreach ( $deadlines as $row ) : ?>
								<div class="dates-row">
									<dt><?php echo esc_html( $row[0] ); ?></dt>
									<dd><?php echo esc_html( $row[1] ); ?></dd>
								</div>
							<?php endforeach; ?>
						</dl>
					<?php else : ?>
						<p class="action-card-text"><?php esc_html_e( 'Deadlines for this year’s scholarships will be posted soon.', 'broad-run-boosters' ); ?></p>
					<?php endif; ?>
				</aside>
			</div>
		</div>
	</section>

	<section class="page-section page-section--alt" aria-labelledby="how-to-apply">
		<div class="page-container">
			<?php brab_section_heading( __( 'Apply', 'broad-run-boosters' ), __( 'Eligibility & How to Apply', 'broad-run-boosters' ), 'how-to-apply' ); ?>
			<div class="split">
				<div class="prose"><?php echo $parts['extended']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				<div id="documents">
					<h3 class="subheading"><?php esc_html_e( 'Application Documents', 'broad-run-boosters' ); ?></h3>
					<?php if ( $documents ) : ?>
						<ul class="doc-list">
							<?php foreach ( $documents as $doc ) : ?>
								<?php $file = brab_field( $doc->ID, 'file' ); ?>
								<?php
								if ( ! $file ) {
									continue;
								}
								$ext = strtoupper( (string) pathinfo( (string) wp_parse_url( $file, PHP_URL_PATH ), PATHINFO_EXTENSION ) );
								?>
								<li>
									<a class="doc-link" href="<?php echo esc_url( $file ); ?>" target="_blank" rel="noopener" download>
										<span class="doc-icon" aria-hidden="true"><?php echo esc_html( $ext ? $ext : 'FILE' ); ?></span>
										<span class="doc-text">
											<span class="doc-title"><?php echo esc_html( get_the_title( $doc ) ); ?></span>
											<?php $desc = brab_field( $doc->ID, 'description' ); ?>
											<?php if ( $desc ) : ?>
												<span class="doc-desc"><?php echo esc_html( $desc ); ?></span>
											<?php endif; ?>
										</span>
										<span class="doc-download"><?php esc_html_e( 'Download', 'broad-run-boosters' ); ?></span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php else : ?>
						<?php brab_empty_state( __( 'This year’s application documents will be available here soon.', 'broad-run-boosters' ) ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="page-section" aria-labelledby="recipients">
		<div class="page-container">
			<?php brab_section_heading( __( 'Congratulations', 'broad-run-boosters' ), __( 'Scholarship Recipients', 'broad-run-boosters' ), 'recipients' ); ?>
			<?php if ( $by_class ) : ?>
				<?php foreach ( $by_class as $year => $recipients ) : ?>
					<div class="recipient-class">
						<h3 class="recipient-class-title">
							<?php
							/* translators: %s: graduation year */
							echo esc_html( $year ? sprintf( __( 'Class of %s', 'broad-run-boosters' ), $year ) : __( 'Recipients', 'broad-run-boosters' ) );
							?>
						</h3>
						<div class="people-grid people-grid--compact">
							<?php foreach ( $recipients as $r ) : ?>
								<article class="person">
									<?php if ( has_post_thumbnail( $r ) ) : ?>
										<div class="person-photo"><?php echo get_the_post_thumbnail( $r, 'medium', array( 'alt' => esc_attr( get_the_title( $r ) ) ) ); ?></div>
									<?php endif; ?>
									<h4 class="person-name"><?php echo esc_html( get_the_title( $r ) ); ?></h4>
									<?php $meta = array_filter( array( brab_field( $r->ID, 'scholarship' ), brab_field( $r->ID, 'sport' ) ) ); ?>
									<?php if ( $meta ) : ?>
										<p class="person-role"><?php echo esc_html( implode( ' · ', $meta ) ); ?></p>
									<?php endif; ?>
								</article>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<?php brab_empty_state( __( 'Scholarship recipients will be announced each spring.', 'broad-run-boosters' ) ); ?>
			<?php endif; ?>
		</div>
	</section>

	<?php get_template_part( 'template-parts/cta-band' ); ?>
</main>

<?php
get_footer();
