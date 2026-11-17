<?php
/**
 * Site pages: automatic creation, starter content, template helpers,
 * contact form handling.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BRAB_PAGES_VERSION', 1 );

/**
 * Build simple block-editor markup.
 *
 * @param array<int,array{0:string,1:mixed}> $blocks List of [tag, content].
 * @return string
 */
function brab_blocks( $blocks ) {
	$out = '';
	foreach ( $blocks as $block ) {
		list( $tag, $content ) = $block;
		switch ( $tag ) {
			case 'h2':
			case 'h3':
				$level = 'h3' === $tag ? ' {"level":3}' : '';
				$out  .= "<!-- wp:heading{$level} -->\n<{$tag} class=\"wp-block-heading\">" . esc_html( $content ) . "</{$tag}>\n<!-- /wp:heading -->\n\n";
				break;
			case 'ul':
				$items = '';
				foreach ( $content as $item ) {
					$items .= "<!-- wp:list-item -->\n<li>" . esc_html( $item ) . "</li>\n<!-- /wp:list-item -->\n";
				}
				$out .= "<!-- wp:list -->\n<ul class=\"wp-block-list\">" . $items . "</ul>\n<!-- /wp:list -->\n\n";
				break;
			case 'more':
				$out .= "<!-- wp:more -->\n<!--more-->\n<!-- /wp:more -->\n\n";
				break;
			default:
				$out .= "<!-- wp:paragraph -->\n<p>" . esc_html( $content ) . "</p>\n<!-- /wp:paragraph -->\n\n";
		}
	}
	return trim( $out );
}

/**
 * Page definitions: slug => title, parent slug, starter content and what
 * the template adds around the editable text.
 *
 * @return array<string,array{title:string,parent:string,content:array,note:string}>
 */
function brab_get_page_definitions() {
	return array(
		'about-us'      => array(
			'title'   => 'About Us',
			'parent'  => '',
			'note'    => 'Text above the “More” block appears in “Who We Are”. Text below it appears with the meeting schedule (who may attend, etc.). The “What We Do” icons, Board Members (Booster Site → Board Members) and Meetings (Booster Site → Meetings) are added automatically.',
			'content' => array(
				array( 'h2', 'Who We Are' ),
				array( 'p', 'The Broad Run Athletic Booster Club is a volunteer organization of parents, families, alumni and community members dedicated to supporting every athletic program at Broad Run High School in Ashburn, Virginia.' ),
				array( 'h3', 'Our Mission' ),
				array( 'p', 'To enhance the student-athlete experience at Broad Run by raising funds, providing resources and building a strong, supportive community around every Spartan team.' ),
				array( 'h3', 'Who We Support' ),
				array( 'p', 'We support Broad Run student-athletes, coaches and teams across every sport, every level and every season.' ),
				array( 'more', '' ),
				array( 'p', 'Booster Club meetings are open to all Broad Run parents, guardians, coaches and community members — you do not need to be a member to attend. Come hear what is happening across our programs and find out how you can help.' ),
			),
		),
		'get-involved'  => array(
			'title'   => 'Get Involved',
			'parent'  => '',
			'note'    => 'Text above the “More” block is the page introduction. Text below it appears in the Concessions section. The concessions sign-up button uses the link in Booster Site → Site Settings. Open positions come from Booster Site → Open Positions.',
			'content' => array(
				array( 'p', 'Volunteers are the heart of the Booster Club. Whether you have an hour or a whole season to give, there is a place for you to make a difference for Spartan athletes.' ),
				array( 'more', '' ),
				array( 'h3', 'How Concessions Work' ),
				array( 'p', 'The Booster Club runs the concession stands at Broad Run home games and events. Every stand is staffed by parent and family volunteers.' ),
				array( 'h3', 'How Teams Earn Money' ),
				array( 'p', 'When families from a team volunteer for concessions shifts, that team earns a share of the proceeds. The more shifts a team covers, the more it earns.' ),
				array( 'h3', 'Team Payouts' ),
				array( 'p', 'Team earnings are tallied throughout the season and paid out to each team’s account. Contact the Booster Club for the current payout schedule and rates.' ),
				array( 'h3', 'Available Shifts' ),
				array( 'p', 'Shifts are posted on SignUpGenius for fall, winter and spring seasons. Most shifts run from about an hour before an event until it ends.' ),
			),
		),
		'fundraising'   => array(
			'title'   => 'Fundraising',
			'parent'  => '',
			'note'    => 'This text is the fundraising overview. Mulch Madness is featured automatically, and other fundraisers come from Booster Site → Fundraisers.',
			'content' => array(
				array( 'p', 'Every dollar raised by the Booster Club goes back to Broad Run athletics — funding equipment and facility upgrades, team needs, senior scholarships and the events that celebrate our student-athletes. Our fundraisers are only possible thanks to the families, volunteers and businesses who take part.' ),
			),
		),
		'mulch-madness' => array(
			'title'   => 'Mulch Madness',
			'parent'  => 'fundraising',
			'note'    => 'Text above the “More” block is the sale overview. Text below it appears under “Ordering Information”. Turn ordering on/off, set the order link, dates and photos in Booster Site → Site Settings → Mulch Madness.',
			'content' => array(
				array( 'p', 'Mulch Madness is the Booster Club’s largest fundraiser of the year. Each spring, Spartan athletes and families deliver bags of mulch right to your driveway — and every bag supports Broad Run athletics.' ),
				array( 'more', '' ),
				array( 'p', 'Orders are placed online while the sale is open. Choose your mulch type and number of bags, add delivery details, and our student-athletes and volunteers will deliver on delivery day.' ),
				array( 'p', 'Questions about your order? Contact us and we will be happy to help.' ),
			),
		),
		'scholarships'  => array(
			'title'   => 'Scholarships',
			'parent'  => '',
			'note'    => 'Text above the “More” block is the scholarship overview. Text below it appears under “Eligibility & How to Apply”. Deadlines are in Booster Site → Site Settings; documents in Booster Site → Scholarship Documents; recipients in Booster Site → Scholarship Recipients.',
			'content' => array(
				array( 'p', 'Each year the Broad Run Athletic Booster Club awards scholarships to graduating senior student-athletes who have made a lasting impact on Spartan athletics, in the classroom and in our community.' ),
				array( 'more', '' ),
				array( 'h3', 'Eligibility' ),
				array( 'ul', array( 'Graduating senior at Broad Run High School', 'Participated in at least one Broad Run varsity or junior varsity sport', 'Plans to continue education after graduation' ) ),
				array( 'h3', 'Application Process' ),
				array( 'ul', array( 'Download the application and instructions below', 'Complete all sections and gather any required forms', 'Submit your application by the deadline listed on this page' ) ),
			),
		),
		'shop'          => array(
			'title'   => 'Shop',
			'parent'  => '',
			'note'    => 'This text is the shop introduction. Products come from Booster Site → Shop Items; checkout links and team donations are set in Booster Site → Site Settings.',
			'content' => array(
				array( 'p', 'Show your Spartan pride and support Broad Run athletics. All purchases are completed securely through our Square store.' ),
			),
		),
		'membership'    => array(
			'title'   => 'Membership',
			'parent'  => '',
			'note'    => 'Text above the “More” block appears in “Why Join?”. Text below it appears in “Become a Member”. The fee and purchase link are in Booster Site → Site Settings; the member list is in Booster Site → Booster Members.',
			'content' => array(
				array( 'p', 'Booster Club membership is one of the simplest ways to support every Broad Run team at once. Membership dues go directly toward equipment, team support, scholarships and recognition events for Spartan student-athletes.' ),
				array( 'h3', 'Member Benefits' ),
				array( 'ul', array( 'Support all Broad Run athletic programs', 'Stay informed about Booster Club news and events', 'Voting privileges at Booster Club meetings', 'Recognition as a Spartan Booster (optional)' ) ),
				array( 'more', '' ),
				array( 'p', 'Memberships run for the school year. Join online in just a few minutes through our secure Square store.' ),
			),
		),
		'sponsorships'  => array(
			'title'   => 'Sponsorships',
			'parent'  => '',
			'note'    => 'This text appears in “Why Sponsor?”. Packages come from Booster Site → Sponsorship Packages and logos from Sponsors.',
			'content' => array(
				array( 'p', 'Business sponsors play a vital role in Broad Run athletics. Your partnership directly supports student-athletes with equipment, facilities, team needs and scholarships.' ),
				array( 'h3', 'Benefits for Your Business' ),
				array( 'ul', array( 'Visibility with thousands of Broad Run families and fans', 'Recognition on our website and social media', 'Signage and recognition at Spartan events, depending on package', 'A meaningful, visible investment in your local community' ) ),
			),
		),
		'donate'        => array(
			'title'   => 'Donate',
			'parent'  => '',
			'note'    => 'This text is the donation introduction. Donation links and the team list are in Booster Site → Site Settings.',
			'content' => array(
				array( 'p', 'Your gift directly supports Broad Run student-athletes. Give to the Booster Club to help every team, or choose a specific team to support.' ),
			),
		),
		'contact'       => array(
			'title'   => 'Contact',
			'parent'  => '',
			'note'    => 'This text is the contact introduction. Email, social links and the contact form switch are in Booster Site → Site Settings.',
			'content' => array(
				array( 'p', 'Have a question about membership, volunteering, sponsorships or an upcoming event? We would love to hear from you.' ),
			),
		),
	);
}

/**
 * Create any missing pages (never overwrites existing ones).
 */
function brab_ensure_pages() {
	$ids = array();
	foreach ( brab_get_page_definitions() as $slug => $def ) {
		$parent_id = ( $def['parent'] && isset( $ids[ $def['parent'] ] ) ) ? $ids[ $def['parent'] ] : 0;
		$path      = $def['parent'] ? $def['parent'] . '/' . $slug : $slug;
		$existing  = get_page_by_path( $path );
		if ( ! $existing && $def['parent'] ) {
			$existing = get_page_by_path( $slug );
		}

		if ( $existing ) {
			$ids[ $slug ] = $existing->ID;
			continue;
		}

		$ids[ $slug ] = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => $def['title'],
				'post_name'    => $slug,
				'post_parent'  => $parent_id,
				'post_content' => brab_blocks( $def['content'] ),
			)
		);
	}

	// Seed the Meetings list once from the old single "next meeting" setting.
	if ( ! get_option( 'brab_meetings_seeded' ) ) {
		$count = wp_count_posts( 'brab_meeting' );
		if ( empty( $count->publish ) ) {
			$old   = get_option( 'brab_meeting_settings', array() );
			$old   = is_array( $old ) ? $old : array();
			$date  = ! empty( $old['date'] ) ? $old['date'] : 'Tuesday, November 17, 2026';
			$ts    = strtotime( $date );
			$id    = wp_insert_post(
				array(
					'post_type'   => 'brab_meeting',
					'post_status' => 'publish',
					'post_title'  => $ts ? wp_date( 'F', $ts ) . ' Booster Meeting' : 'Booster Meeting',
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_brab_date', $ts ? gmdate( 'Y-m-d', $ts ) : '' );
				update_post_meta( $id, '_brab_time', ! empty( $old['time'] ) ? $old['time'] : '6:00 PM' );
				update_post_meta( $id, '_brab_location', ! empty( $old['location'] ) ? $old['location'] : 'Broad Run High School, Room 636' );
			}
		}
		update_option( 'brab_meetings_seeded', 1 );
	}

	update_option( 'brab_pages_version', BRAB_PAGES_VERSION );
}
add_action( 'after_switch_theme', 'brab_ensure_pages' );

/**
 * Also run once for sites where the theme was already active.
 */
function brab_maybe_ensure_pages() {
	if ( (int) get_option( 'brab_pages_version' ) < BRAB_PAGES_VERSION && current_user_can( 'publish_pages' ) ) {
		brab_ensure_pages();
	}
}
add_action( 'admin_init', 'brab_maybe_ensure_pages' );

/**
 * Tell editors which parts of a page are automatic.
 */
function brab_page_edit_notice() {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || 'page' !== $screen->post_type || 'post' !== $screen->base ) {
		return;
	}
	$post = get_post();
	$defs = brab_get_page_definitions();
	if ( $post && isset( $defs[ $post->post_name ] ) ) {
		echo '<div class="notice notice-info"><p><strong>' . esc_html__( 'Page layout:', 'broad-run-boosters' ) . '</strong> ' . esc_html( $defs[ $post->post_name ]['note'] ) . '</p></div>';
	}
}
add_action( 'admin_notices', 'brab_page_edit_notice' );

/**
 * Show the same note in the block editor (classic admin notices are hidden there).
 */
function brab_page_edit_notice_block_editor() {
	$post = get_post();
	$defs = brab_get_page_definitions();
	if ( ! $post || 'page' !== $post->post_type || ! isset( $defs[ $post->post_name ] ) ) {
		return;
	}
	$note = __( 'Page layout: ', 'broad-run-boosters' ) . $defs[ $post->post_name ]['note'];
	wp_add_inline_script(
		'wp-notices',
		'wp.domReady(function(){wp.data.dispatch("core/notices").createNotice("info",' . wp_json_encode( $note ) . ',{isDismissible:true});});',
		'after'
	);
}
add_action( 'enqueue_block_editor_assets', 'brab_page_edit_notice_block_editor' );

/* -------------------------------------------------------------------------- */
/* Template helpers                                                             */
/* -------------------------------------------------------------------------- */

/**
 * Editable page text split at the "More" block.
 *
 * @return array{main:string,extended:string}
 */
function brab_page_parts() {
	$post = get_post();
	if ( ! $post ) {
		return array(
			'main'     => '',
			'extended' => '',
		);
	}
	$parts = get_extended( $post->post_content );
	return array(
		'main'     => trim( $parts['main'] ) ? apply_filters( 'the_content', $parts['main'] ) : '',
		'extended' => trim( $parts['extended'] ) ? apply_filters( 'the_content', $parts['extended'] ) : '',
	);
}

/**
 * Inner-page hero banner.
 *
 * @param array{eyebrow?:string,title?:string,subtitle?:string,image?:string} $args Args.
 */
function brab_page_hero( $args = array() ) {
	$image = '';
	if ( has_post_thumbnail() ) {
		$image = get_the_post_thumbnail_url( null, 'full' );
	} elseif ( ! empty( $args['image'] ) ) {
		$image = brab_img( $args['image'] );
	}
	$title = ! empty( $args['title'] ) ? $args['title'] : get_the_title();
	?>
	<section class="page-hero<?php echo $image ? '' : ' page-hero--plain'; ?>"<?php echo $image ? ' style="--page-hero-image: url(\'' . esc_url( $image ) . '\');"' : ''; ?>>
		<div class="page-hero-inner">
			<?php if ( ! empty( $args['eyebrow'] ) ) : ?>
				<p class="page-hero-eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
			<?php endif; ?>
			<h1 class="page-hero-title"><?php echo esc_html( $title ); ?></h1>
			<?php if ( ! empty( $args['subtitle'] ) ) : ?>
				<p class="page-hero-sub"><?php echo esc_html( $args['subtitle'] ); ?></p>
			<?php endif; ?>
		</div>
	</section>
	<?php
}

/**
 * Section heading with eyebrow + serif title.
 *
 * @param string $eyebrow Small label.
 * @param string $title   Heading.
 * @param string $id      Heading id.
 * @param bool   $light   Light text for dark sections.
 */
function brab_section_heading( $eyebrow, $title, $id = '', $light = false ) {
	?>
	<header class="section-heading<?php echo $light ? ' section-heading--light' : ''; ?>">
		<?php if ( $eyebrow ) : ?>
			<p class="section-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<?php endif; ?>
		<h2 class="section-title"<?php echo $id ? ' id="' . esc_attr( $id ) . '"' : ''; ?>><?php echo esc_html( $title ); ?></h2>
	</header>
	<?php
}

/**
 * Button with arrow.
 *
 * @param string $url     Link.
 * @param string $label   Text.
 * @param string $variant btn-maroon, btn-gold, etc.
 * @param bool   $external Open in new tab.
 */
function brab_button( $url, $label, $variant = 'btn-maroon', $external = false ) {
	$is_external = $external || ( 0 === strpos( $url, 'http' ) && false === strpos( $url, home_url() ) );
	printf(
		'<a class="btn %1$s" href="%2$s"%3$s>%4$s <span class="btn-arrow" aria-hidden="true">&rarr;</span></a>',
		esc_attr( $variant ),
		esc_url( $url ),
		$is_external ? ' target="_blank" rel="noopener noreferrer"' : '',
		esc_html( $label )
	);
}

/**
 * Empty state message.
 *
 * @param string $text Text.
 */
function brab_empty_state( $text ) {
	echo '<p class="empty-state">' . esc_html( $text ) . '</p>';
}

/**
 * Is a value an email address?
 *
 * @param string $value Value.
 * @return string Link href.
 */
function brab_contact_href( $value ) {
	$value = trim( $value );
	if ( '' === $value ) {
		$value = brab_setting( 'contact_email' );
	}
	return is_email( $value ) ? 'mailto:' . $value : $value;
}

/**
 * Social links (only those with URLs set).
 *
 * @return array<string,array{label:string,url:string,icon:string}>
 */
function brab_social_links() {
	$icons = array(
		'facebook'  => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 10-11.5 9.9v-7H8v-3h2.5V9.5c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.4h-1.2c-1.2 0-1.6.8-1.6 1.5V12H17l-.4 3h-2.7v7A10 10 0 0022 12z"/></svg>',
		'instagram' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm5 5a5 5 0 100 10 5 5 0 000-10zm6.5-.9a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0zM12 9a3 3 0 110 6 3 3 0 010-6z"/></svg>',
		'x'         => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 2H22l-6.8 7.8L23.2 22h-6.3l-4.9-6.4L6.4 22H3.3l7.3-8.3L2.9 2h6.4l4.4 5.9L18.9 2zm-1.1 18h1.7L7.3 3.9H5.5L17.8 20z"/></svg>',
	);
	$labels = array(
		'facebook'  => 'Facebook',
		'instagram' => 'Instagram',
		'x'         => 'X',
	);
	$out = array();
	foreach ( $labels as $key => $label ) {
		$url = brab_setting( $key . '_url' );
		if ( $url ) {
			$out[ $key ] = array(
				'label' => $label,
				'url'   => $url,
				'icon'  => $icons[ $key ],
			);
		}
	}
	return $out;
}

/* -------------------------------------------------------------------------- */
/* Navigation                                                                   */
/* -------------------------------------------------------------------------- */

/**
 * Which top-level nav slug is "current" for the fallback menu.
 *
 * @return string
 */
function brab_current_nav_slug() {
	if ( is_front_page() ) {
		return '';
	}
	$post = get_queried_object();
	if ( ! ( $post instanceof WP_Post ) || 'page' !== $post->post_type ) {
		return '-';
	}
	$ancestors = get_post_ancestors( $post );
	$top       = $ancestors ? get_post( end( $ancestors ) ) : $post;
	return $top->post_name;
}

/* -------------------------------------------------------------------------- */
/* Contact form                                                                 */
/* -------------------------------------------------------------------------- */

/**
 * Handle contact form posts.
 */
function brab_handle_contact_form() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/contact/' );
	$back = remove_query_arg( array( 'contact' ), $back );

	$ok_nonce = isset( $_POST['brab_contact_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['brab_contact_nonce'] ) ), 'brab_contact' );
	$honeypot = isset( $_POST['website'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['website'] ) ) ) : '';

	if ( ! $ok_nonce || '' !== $honeypot || '1' !== brab_setting( 'contact_form_enabled' ) ) {
		wp_safe_redirect( add_query_arg( 'contact', 'error', $back ) . '#contact-form' );
		exit;
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$topic   = isset( $_POST['topic'] ) ? sanitize_text_field( wp_unslash( $_POST['topic'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( '' === $name || ! is_email( $email ) || '' === $message ) {
		wp_safe_redirect( add_query_arg( 'contact', 'invalid', $back ) . '#contact-form' );
		exit;
	}

	// Basic flood protection: one message per minute per visitor.
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key = 'brab_contact_' . md5( $ip );
	if ( get_transient( $key ) ) {
		wp_safe_redirect( add_query_arg( 'contact', 'wait', $back ) . '#contact-form' );
		exit;
	}
	set_transient( $key, 1, MINUTE_IN_SECONDS );

	$to      = brab_setting( 'contact_email' );
	$subject = sprintf( '[Booster Website] %s — %s', $topic ? $topic : 'General question', $name );
	$body    = "Name: {$name}\nEmail: {$email}\nTopic: {$topic}\n\n{$message}\n";
	$sent    = wp_mail( $to, $subject, $body, array( 'Reply-To: ' . $name . ' <' . $email . '>' ) );

	wp_safe_redirect( add_query_arg( 'contact', $sent ? 'sent' : 'error', $back ) . '#contact-form' );
	exit;
}
add_action( 'admin_post_nopriv_brab_contact', 'brab_handle_contact_form' );
add_action( 'admin_post_brab_contact', 'brab_handle_contact_form' );
