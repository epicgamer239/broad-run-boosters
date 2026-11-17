<?php
/**
 * "Booster Site" admin menu + Site Settings (links, photos, contact info).
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BRAB_SQUARE_STORE', 'https://broad-run-athletic-booster-club.square.site/s/shop' );

/**
 * Site setting field definitions, grouped by section.
 *
 * @return array<string,array{title:string,desc:string,fields:array<string,array<string,mixed>>}>
 */
function brab_get_site_setting_sections() {
	return array(
		'photos'    => array(
			'title'  => __( 'Homepage Photos', 'broad-run-boosters' ),
			'desc'   => __( 'Swap these periodically to showcase different sports. Large landscape photos (2000px wide or more) look best for the hero.', 'broad-run-boosters' ),
			'fields' => array(
				'hero_image'     => array(
					'label' => __( 'Hero photo', 'broad-run-boosters' ),
					'type'  => 'image',
				),
				'gallery_images' => array(
					'label' => __( '“Spartans in Action” photos', 'broad-run-boosters' ),
					'type'  => 'gallery',
					'hint'  => __( 'Pick several photos; portrait (tall) photos fit the carousel best. Leave empty to use the built-in photos.', 'broad-run-boosters' ),
				),
			),
		),
		'contact'   => array(
			'title'  => __( 'Contact & Social', 'broad-run-boosters' ),
			'desc'   => __( 'Used in the footer and on the Contact page. Personal contact info for individual board members is never shown.', 'broad-run-boosters' ),
			'fields' => array(
				'contact_email'        => array(
					'label'   => __( 'General Booster Club email', 'broad-run-boosters' ),
					'type'    => 'email',
					'default' => 'info@broadrunathleticboosters.org',
				),
				'facebook_url'         => array(
					'label' => __( 'Facebook URL', 'broad-run-boosters' ),
					'type'  => 'url',
				),
				'instagram_url'        => array(
					'label' => __( 'Instagram URL', 'broad-run-boosters' ),
					'type'  => 'url',
				),
				'x_url'                => array(
					'label' => __( 'X (Twitter) URL', 'broad-run-boosters' ),
					'type'  => 'url',
				),
				'contact_form_enabled' => array(
					'label'   => __( 'Show the contact form on the Contact page', 'broad-run-boosters' ),
					'type'    => 'checkbox',
					'default' => '1',
				),
			),
		),
		'payments'  => array(
			'title'  => __( 'Square Store & Payment Links', 'broad-run-boosters' ),
			'desc'   => __( 'All purchases and donations go through the existing Square store. Paste the Square link for each item; blank links fall back to the main store.', 'broad-run-boosters' ),
			'fields' => array(
				'square_store_url' => array(
					'label'   => __( 'Main Square store', 'broad-run-boosters' ),
					'type'    => 'url',
					'default' => BRAB_SQUARE_STORE,
				),
				'donate_url'       => array(
					'label' => __( 'General donation link', 'broad-run-boosters' ),
					'type'  => 'url',
				),
				'team_donations'   => array(
					'label'   => __( 'Team donation options', 'broad-run-boosters' ),
					'type'    => 'textarea',
					'hint'    => __( 'One team per line. Optionally add a dedicated Square link after a “|”, e.g. “Football | https://…”. Teams without a link use the general donation link.', 'broad-run-boosters' ),
					'default' => implode(
						"\n",
						array( 'Baseball', 'Boys Basketball', 'Girls Basketball', 'Cheer', 'Cross Country', 'Field Hockey', 'Football', 'Golf', 'Boys Lacrosse', 'Girls Lacrosse', 'Boys Soccer', 'Girls Soccer', 'Softball', 'Swim & Dive', 'Tennis', 'Track & Field', 'Volleyball', 'Wrestling' )
					),
				),
				'membership_url'   => array(
					'label' => __( 'Membership purchase link', 'broad-run-boosters' ),
					'type'  => 'url',
				),
				'membership_fee'   => array(
					'label' => __( 'Membership fee (text)', 'broad-run-boosters' ),
					'type'  => 'text',
					'hint'  => __( 'e.g. “$25 per family, per school year”. Leave blank to hide.', 'broad-run-boosters' ),
				),
				'sponsor_url'      => array(
					'label' => __( 'General sponsorship purchase link', 'broad-run-boosters' ),
					'type'  => 'url',
				),
			),
		),
		'volunteer' => array(
			'title'  => __( 'Volunteering', 'broad-run-boosters' ),
			'desc'   => __( 'Sign-up links change during the school year — update them here and every button on the site follows.', 'broad-run-boosters' ),
			'fields' => array(
				'concessions_signup_url' => array(
					'label' => __( 'Concessions SignUpGenius link', 'broad-run-boosters' ),
					'type'  => 'url',
				),
				'volunteer_signup_url'   => array(
					'label' => __( 'General volunteer sign-up link (optional)', 'broad-run-boosters' ),
					'type'  => 'url',
				),
			),
		),
		'mulch'     => array(
			'title'  => __( 'Mulch Madness', 'broad-run-boosters' ),
			'desc'   => __( 'Turn ordering on during the sale. When it is off, the Order button is replaced with the closed message.', 'broad-run-boosters' ),
			'fields' => array(
				'mulch_order_open'     => array(
					'label' => __( 'Ordering is open', 'broad-run-boosters' ),
					'type'  => 'checkbox',
				),
				'mulch_order_url'      => array(
					'label' => __( 'Mulch order link', 'broad-run-boosters' ),
					'type'  => 'url',
				),
				'mulch_closed_message' => array(
					'label'   => __( 'Message when ordering is closed', 'broad-run-boosters' ),
					'type'    => 'text',
					'default' => 'Mulch ordering is currently closed. Check back in the new year for next season’s sale!',
				),
				'mulch_dates'          => array(
					'label' => __( 'Important dates (one per line)', 'broad-run-boosters' ),
					'type'  => 'textarea',
					'hint'  => __( 'Format: “Label | Date”, e.g. “Ordering opens | January 15”.', 'broad-run-boosters' ),
				),
				'mulch_photos'         => array(
					'label' => __( 'Photos from previous years', 'broad-run-boosters' ),
					'type'  => 'gallery',
				),
			),
		),
		'scholar'   => array(
			'title'  => __( 'Scholarships', 'broad-run-boosters' ),
			'desc'   => '',
			'fields' => array(
				'scholarship_dates' => array(
					'label' => __( 'Important deadlines (one per line)', 'broad-run-boosters' ),
					'type'  => 'textarea',
					'hint'  => __( 'Format: “Label | Date”, e.g. “Applications due | March 31”.', 'broad-run-boosters' ),
				),
			),
		),
	);
}

/**
 * Flat list of all site setting fields.
 *
 * @return array<string,array<string,mixed>>
 */
function brab_get_site_setting_fields() {
	$fields = array();
	foreach ( brab_get_site_setting_sections() as $section ) {
		$fields = array_merge( $fields, $section['fields'] );
	}
	return $fields;
}

/**
 * Get a single site setting (with defaults).
 *
 * @param string $key Setting key.
 * @return string
 */
function brab_setting( $key ) {
	static $stored = null;
	if ( null === $stored ) {
		$stored = get_option( 'brab_site_settings', array() );
		$stored = is_array( $stored ) ? $stored : array();
	}
	$fields = brab_get_site_setting_fields();

	if ( array_key_exists( $key, $stored ) ) {
		$val = (string) $stored[ $key ];
		// Text-like fields fall back to defaults when cleared; checkboxes respect "0".
		if ( '' !== $val || ( isset( $fields[ $key ]['type'] ) && 'checkbox' === $fields[ $key ]['type'] ) ) {
			return $val;
		}
	}
	return isset( $fields[ $key ]['default'] ) ? (string) $fields[ $key ]['default'] : '';
}

/**
 * Resolve a payment/sign-up link with fallbacks.
 *
 * @param string $key Setting key.
 * @return string
 */
function brab_link( $key ) {
	$url = brab_setting( $key );
	if ( '' !== $url ) {
		return $url;
	}
	switch ( $key ) {
		case 'volunteer_signup_url':
			return home_url( '/get-involved/' );
		case 'concessions_signup_url':
			return '';
		default:
			return brab_setting( 'square_store_url' );
	}
}

/**
 * Parse "Label | value" lines.
 *
 * @param string $key Setting key.
 * @return array<int,array{0:string,1:string}>
 */
function brab_setting_pairs( $key ) {
	$out = array();
	foreach ( brab_lines( brab_setting( $key ) ) as $line ) {
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		$out[] = array( $parts[0], isset( $parts[1] ) ? $parts[1] : '' );
	}
	return $out;
}

/**
 * Image URLs for a gallery setting.
 *
 * @param string $key  Setting key.
 * @param string $size Image size.
 * @return array<int,array{src:string,alt:string}>
 */
function brab_setting_gallery( $key, $size = 'large' ) {
	$out = array();
	foreach ( array_filter( array_map( 'absint', explode( ',', brab_setting( $key ) ) ) ) as $id ) {
		$src = wp_get_attachment_image_url( $id, $size );
		if ( $src ) {
			$out[] = array(
				'src' => $src,
				'alt' => (string) get_post_meta( $id, '_wp_attachment_image_alt', true ),
			);
		}
	}
	return $out;
}

/**
 * Sanitize site settings.
 *
 * @param mixed $input Raw.
 * @return array<string,string>
 */
function brab_sanitize_site_settings( $input ) {
	$input = is_array( $input ) ? $input : array();
	$clean = array();
	foreach ( brab_get_site_setting_fields() as $key => $field ) {
		$raw = isset( $input[ $key ] ) ? (string) $input[ $key ] : '';
		switch ( $field['type'] ) {
			case 'url':
				$clean[ $key ] = esc_url_raw( trim( $raw ) );
				break;
			case 'email':
				$clean[ $key ] = sanitize_email( $raw );
				break;
			case 'textarea':
				$clean[ $key ] = sanitize_textarea_field( $raw );
				break;
			case 'checkbox':
				$clean[ $key ] = '1' === $raw ? '1' : '0';
				break;
			case 'image':
				$clean[ $key ] = (string) absint( $raw );
				break;
			case 'gallery':
				$clean[ $key ] = implode( ',', array_filter( array_map( 'absint', explode( ',', $raw ) ) ) );
				break;
			default:
				$clean[ $key ] = sanitize_text_field( $raw );
		}
	}
	return $clean;
}

/**
 * Register settings.
 */
function brab_register_site_settings() {
	register_setting(
		'brab_site_settings_group',
		'brab_site_settings',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'brab_sanitize_site_settings',
		)
	);

	foreach ( brab_get_site_setting_sections() as $section_id => $section ) {
		add_settings_section(
			'brab_' . $section_id,
			$section['title'],
			function () use ( $section ) {
				if ( $section['desc'] ) {
					echo '<p>' . esc_html( $section['desc'] ) . '</p>';
				}
			},
			'brab-site'
		);
		foreach ( $section['fields'] as $key => $field ) {
			add_settings_field(
				'brab_s_' . $key,
				$field['label'],
				'brab_render_site_setting_field',
				'brab-site',
				'brab_' . $section_id,
				array(
					'key'       => $key,
					'field'     => $field,
					'label_for' => 'brab_s_' . $key,
				)
			);
		}
	}
}
add_action( 'admin_init', 'brab_register_site_settings' );

/**
 * Render one settings field.
 *
 * @param array $args Args.
 */
function brab_render_site_setting_field( $args ) {
	$key   = $args['key'];
	$field = $args['field'];
	$id    = 'brab_s_' . $key;
	$name  = 'brab_site_settings[' . $key . ']';
	$value = brab_setting( $key );

	switch ( $field['type'] ) {
		case 'textarea':
			printf( '<textarea class="large-text" rows="6" id="%s" name="%s">%s</textarea>', esc_attr( $id ), esc_attr( $name ), esc_textarea( $value ) );
			break;
		case 'checkbox':
			printf( '<input type="hidden" name="%2$s" value="0" /><input type="checkbox" id="%1$s" name="%2$s" value="1" %3$s />', esc_attr( $id ), esc_attr( $name ), checked( $value, '1', false ) );
			break;
		case 'image':
		case 'gallery':
			$ids = array_filter( array_map( 'absint', explode( ',', $value ) ) );
			echo '<div class="brab-media-preview" id="' . esc_attr( $id ) . '_preview" style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:8px">';
			foreach ( $ids as $img_id ) {
				echo wp_get_attachment_image( $img_id, array( 90, 90 ), false, array( 'style' => 'width:90px;height:90px;object-fit:cover;border-radius:4px' ) );
			}
			echo '</div>';
			printf( '<input type="hidden" id="%s" name="%s" value="%s" />', esc_attr( $id ), esc_attr( $name ), esc_attr( implode( ',', $ids ) ) );
			printf(
				'<button type="button" class="button brab-media-pick" data-target="%s" data-type="%s">%s</button> <button type="button" class="button-link brab-media-clear" data-target="%1$s">%s</button>',
				esc_attr( $id ),
				esc_attr( $field['type'] ),
				'gallery' === $field['type'] ? esc_html__( 'Choose photos', 'broad-run-boosters' ) : esc_html__( 'Choose photo', 'broad-run-boosters' ),
				esc_html__( 'Use default', 'broad-run-boosters' )
			);
			break;
		default:
			$type = in_array( $field['type'], array( 'url', 'email' ), true ) ? $field['type'] : 'text';
			printf( '<input type="%s" class="regular-text" id="%s" name="%s" value="%s" />', esc_attr( $type ), esc_attr( $id ), esc_attr( $name ), esc_attr( $value ) );
	}

	if ( ! empty( $field['hint'] ) ) {
		echo '<p class="description">' . esc_html( $field['hint'] ) . '</p>';
	}
}

/**
 * Top-level "Booster Site" menu.
 */
function brab_add_site_menu() {
	add_menu_page(
		__( 'Booster Site Settings', 'broad-run-boosters' ),
		__( 'Booster Site', 'broad-run-boosters' ),
		'manage_options',
		'brab-site',
		'brab_render_site_settings_page',
		'dashicons-flag',
		3
	);
	add_submenu_page( 'brab-site', __( 'Booster Site Settings', 'broad-run-boosters' ), __( 'Site Settings', 'broad-run-boosters' ), 'manage_options', 'brab-site', 'brab_render_site_settings_page' );
}
add_action( 'admin_menu', 'brab_add_site_menu', 9 );

/**
 * Render the settings page.
 */
function brab_render_site_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<p><?php esc_html_e( 'Everything here updates the live site immediately after saving. Lists like board members, meetings and open positions are in the Booster Site menu on the left.', 'broad-run-boosters' ); ?></p>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'brab_site_settings_group' );
			do_settings_sections( 'brab-site' );
			submit_button( __( 'Save Settings', 'broad-run-boosters' ) );
			?>
		</form>
	</div>
	<?php
}

/**
 * Media picker script on our admin screens.
 *
 * @param string $hook Hook suffix.
 */
function brab_admin_assets( $hook ) {
	$screen  = get_current_screen();
	$is_ours = ( false !== strpos( $hook, 'brab-site' ) ) || ( $screen && 'brab_document' === $screen->post_type );
	if ( ! $is_ours ) {
		return;
	}
	wp_enqueue_media();
	$path = BRAB_DIR . '/assets/js/admin.js';
	wp_enqueue_script( 'brab-admin', BRAB_URI . '/assets/js/admin.js', array( 'jquery' ), file_exists( $path ) ? (string) filemtime( $path ) : BRAB_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'brab_admin_assets' );
