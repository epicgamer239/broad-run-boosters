<?php
/**
 * About Us — who we are, what we do, board, meeting schedule.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
the_post();
$parts = brab_page_parts();

$what_we_do = array(
	array( 'Fundraising', 'Mulch Madness, concessions, memberships and sponsorships fund everything we do.', 'M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6' ),
	array( 'Equipment & Facilities', 'Equipment, upgrades and resources our teams need to compete.', 'M2 12h20M6 8v8M18 8v8M9 6v12M15 6v12' ),
	array( 'Team Support', 'Team needs, travel support and special programs across all sports.', 'M9 5.5a2.5 2.5 0 110 5 2.5 2.5 0 010-5zM15 5.5a2.5 2.5 0 110 5 2.5 2.5 0 010-5zM4 18c1-2.5 3-4 5-4s4 1.5 5 4M10 18c1-2.5 3-4 5-4s4 1.5 5 4' ),
	array( 'Scholarships', 'Annual scholarships for deserving senior student-athletes.', 'M4 9l8-5 8 5v2H4V9zM6 11v5c2 1.5 4 2.2 6 2.2s4-.7 6-2.2v-5M12 16v3' ),
	array( 'Events & Recognition', 'Senior nights, awards, banquets and celebrations of our athletes.', 'M8 21h8M12 17v4M7 4h10v4a5 5 0 01-10 0V4zM7 4H4v2a3 3 0 003 3M17 4h3v2a3 3 0 01-3 3' ),
	array( 'Community Engagement', 'Bringing families, alumni and local businesses together around Spartan teams.', 'M12 21s-7-4.5-7-10a4 4 0 017-2.6A4 4 0 0119 11c0 5.5-7 10-7 10z' ),
);
?>

<main id="main-content" class="site-main">
	<?php
	brab_page_hero(
		array(
			'eyebrow'  => __( 'Broad Run Athletic Booster Club', 'broad-run-boosters' ),
			'title'    => __( 'About Us', 'broad-run-boosters' ),
			'subtitle' => __( 'One community. Every team. Every season.', 'broad-run-boosters' ),
			'image'    => 'hero-placeholder.jpg',
		)
	);
	?>

	<section class="page-section" aria-label="<?php esc_attr_e( 'Who we are', 'broad-run-boosters' ); ?>">
		<div class="page-container page-container--narrow prose">
			<?php echo $parts['main']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- filtered post content. ?>
		</div>
	</section>

	<section class="page-section page-section--dark" aria-labelledby="what-we-do">
		<div class="page-container">
			<?php brab_section_heading( __( 'Our Impact', 'broad-run-boosters' ), __( 'What We Do', 'broad-run-boosters' ), 'what-we-do', true ); ?>
			<div class="icon-grid">
				<?php foreach ( $what_we_do as $item ) : ?>
					<article class="icon-item">
						<div class="icon-item-icon" aria-hidden="true">
							<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="<?php echo esc_attr( $item[2] ); ?>"/></svg>
						</div>
						<h3 class="icon-item-title"><?php echo esc_html( $item[0] ); ?></h3>
						<p class="icon-item-text"><?php echo esc_html( $item[1] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="page-section" aria-labelledby="our-board" id="board">
		<div class="page-container">
			<?php brab_section_heading( __( 'Leadership', 'broad-run-boosters' ), __( 'Our Board', 'broad-run-boosters' ), 'our-board' ); ?>
			<?php $board = brab_get_items( 'brab_board' ); ?>
			<?php if ( $board ) : ?>
				<div class="people-grid">
					<?php foreach ( $board as $person ) : ?>
						<article class="person">
							<div class="person-photo">
								<?php if ( has_post_thumbnail( $person ) ) : ?>
									<?php echo get_the_post_thumbnail( $person, 'medium', array( 'alt' => esc_attr( get_the_title( $person ) ) ) ); ?>
								<?php else : ?>
									<img src="<?php echo brab_img( 'logo-crest.png' ); ?>" alt="" class="person-photo-fallback">
								<?php endif; ?>
							</div>
							<h3 class="person-name"><?php echo esc_html( get_the_title( $person ) ); ?></h3>
							<p class="person-role"><?php echo esc_html( brab_field( $person->ID, 'position' ) ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<?php brab_empty_state( __( 'Board member information will be posted soon.', 'broad-run-boosters' ) ); ?>
			<?php endif; ?>
			<p class="section-note">
				<?php esc_html_e( 'Questions for the board?', 'broad-run-boosters' ); ?>
				<a href="<?php echo esc_url( 'mailto:' . brab_setting( 'contact_email' ) ); ?>"><?php echo esc_html( brab_setting( 'contact_email' ) ); ?></a>
			</p>
		</div>
	</section>

	<section class="page-section page-section--alt" aria-labelledby="meetings-title" id="meetings">
		<div class="page-container">
			<?php brab_section_heading( __( 'Join Us', 'broad-run-boosters' ), __( 'Booster Club Meetings', 'broad-run-boosters' ), 'meetings-title' ); ?>
			<div class="split split--wide-right">
				<div class="prose">
					<?php
					if ( $parts['extended'] ) {
						echo $parts['extended']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- filtered post content.
					}
					?>
					<?php $next = brab_get_next_meeting(); ?>
					<?php if ( $next ) : ?>
						<div class="next-callout">
							<p class="next-callout-label"><?php esc_html_e( 'Next meeting', 'broad-run-boosters' ); ?></p>
							<p class="next-callout-date"><?php echo esc_html( $next['date'] ); ?></p>
							<p class="next-callout-meta"><?php echo esc_html( implode( ' | ', array_filter( array( $next['time'], $next['location'] ) ) ) ); ?></p>
						</div>
					<?php endif; ?>
				</div>
				<div>
					<?php $meetings = brab_get_meetings(); ?>
					<?php if ( $meetings ) : ?>
						<table class="schedule-table">
							<caption class="screen-reader-text"><?php esc_html_e( 'Meeting schedule', 'broad-run-boosters' ); ?></caption>
							<thead>
								<tr>
									<th scope="col"><?php esc_html_e( 'Date', 'broad-run-boosters' ); ?></th>
									<th scope="col"><?php esc_html_e( 'Time', 'broad-run-boosters' ); ?></th>
									<th scope="col"><?php esc_html_e( 'Location', 'broad-run-boosters' ); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $meetings as $m ) : ?>
									<?php $mt = brab_format_meeting( $m ); ?>
									<tr class="<?php echo $mt['is_past'] ? 'is-past' : ''; ?>">
										<td data-label="<?php esc_attr_e( 'Date', 'broad-run-boosters' ); ?>">
											<strong><?php echo esc_html( $mt['date'] ); ?></strong>
											<?php if ( $mt['notes'] ) : ?>
												<span class="schedule-note"><?php echo esc_html( $mt['notes'] ); ?></span>
											<?php endif; ?>
										</td>
										<td data-label="<?php esc_attr_e( 'Time', 'broad-run-boosters' ); ?>"><?php echo esc_html( $mt['time'] ); ?></td>
										<td data-label="<?php esc_attr_e( 'Location', 'broad-run-boosters' ); ?>"><?php echo esc_html( $mt['location'] ); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php else : ?>
						<?php brab_empty_state( __( 'This year’s meeting schedule will be posted soon.', 'broad-run-boosters' ) ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
