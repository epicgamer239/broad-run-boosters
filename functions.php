<?php
/**
 * Broad Run Athletic Boosters theme functions.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BRAB_VERSION', '1.0.0' );
define( 'BRAB_DIR', get_template_directory() );
define( 'BRAB_URI', get_template_directory_uri() );

require_once BRAB_DIR . '/inc/sponsors.php';

/**
 * Theme setup.
 */
function brab_setup() {
	load_theme_textdomain( 'broad-run-boosters', BRAB_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 80,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', 'broad-run-boosters' ),
			'footer'  => __( 'Footer Quick Links', 'broad-run-boosters' ),
		)
	);
}
add_action( 'after_setup_theme', 'brab_setup' );

/**
 * Enqueue styles and scripts.
 */
function brab_enqueue_assets() {
	wp_enqueue_style(
		'brab-google-fonts',
		'https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600;1,700&display=swap',
		array(),
		null
	);

	$css_path = BRAB_DIR . '/assets/css/main.css';
	$js_path  = BRAB_DIR . '/assets/js/main.js';

	wp_enqueue_style(
		'brab-main',
		BRAB_URI . '/assets/css/main.css',
		array( 'brab-google-fonts' ),
		file_exists( $css_path ) ? (string) filemtime( $css_path ) : BRAB_VERSION
	);

	wp_enqueue_script(
		'brab-main',
		BRAB_URI . '/assets/js/main.js',
		array(),
		file_exists( $js_path ) ? (string) filemtime( $js_path ) : BRAB_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'brab_enqueue_assets' );

/**
 * Helper: theme image URL.
 *
 * @param string $filename Image filename inside assets/images/.
 * @return string
 */
function brab_img( $filename ) {
	return esc_url( BRAB_URI . '/assets/images/' . ltrim( $filename, '/' ) );
}

/**
 * Default next-meeting values (match original homepage copy).
 *
 * @return array{date:string,time:string,location:string}
 */
function brab_get_meeting_defaults() {
	return array(
		'date'     => 'Tuesday, November 17, 2026',
		'time'     => '6:00 PM',
		'location' => 'Broad Run High School, Room 636',
	);
}

/**
 * Retrieve next-meeting settings with defaults.
 *
 * @return array{date:string,time:string,location:string}
 */
function brab_get_meeting_settings() {
	$defaults = brab_get_meeting_defaults();
	$stored   = get_option( 'brab_meeting_settings', array() );

	if ( ! is_array( $stored ) ) {
		$stored = array();
	}

	return array(
		'date'     => isset( $stored['date'] ) && '' !== trim( (string) $stored['date'] ) ? (string) $stored['date'] : $defaults['date'],
		'time'     => isset( $stored['time'] ) && '' !== trim( (string) $stored['time'] ) ? (string) $stored['time'] : $defaults['time'],
		'location' => isset( $stored['location'] ) && '' !== trim( (string) $stored['location'] ) ? (string) $stored['location'] : $defaults['location'],
	);
}

/**
 * Sanitize meeting settings before save.
 *
 * @param mixed $input Raw form input.
 * @return array{date:string,time:string,location:string}
 */
function brab_sanitize_meeting_settings( $input ) {
	$defaults = brab_get_meeting_defaults();
	$input    = is_array( $input ) ? $input : array();

	return array(
		'date'     => isset( $input['date'] ) ? sanitize_text_field( $input['date'] ) : $defaults['date'],
		'time'     => isset( $input['time'] ) ? sanitize_text_field( $input['time'] ) : $defaults['time'],
		'location' => isset( $input['location'] ) ? sanitize_text_field( $input['location'] ) : $defaults['location'],
	);
}

/**
 * Register Settings API fields for the next booster meeting.
 */
function brab_register_meeting_settings() {
	register_setting(
		'brab_meeting_settings_group',
		'brab_meeting_settings',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'brab_sanitize_meeting_settings',
			'default'           => brab_get_meeting_defaults(),
		)
	);

	add_settings_section(
		'brab_meeting_section',
		__( 'Next Booster Meeting', 'broad-run-boosters' ),
		'brab_meeting_settings_section_cb',
		'brab-meeting-settings'
	);

	add_settings_field(
		'brab_meeting_date',
		__( 'Date', 'broad-run-boosters' ),
		'brab_meeting_field_date_cb',
		'brab-meeting-settings',
		'brab_meeting_section'
	);

	add_settings_field(
		'brab_meeting_time',
		__( 'Time', 'broad-run-boosters' ),
		'brab_meeting_field_time_cb',
		'brab-meeting-settings',
		'brab_meeting_section'
	);

	add_settings_field(
		'brab_meeting_location',
		__( 'Location', 'broad-run-boosters' ),
		'brab_meeting_field_location_cb',
		'brab-meeting-settings',
		'brab_meeting_section'
	);
}
add_action( 'admin_init', 'brab_register_meeting_settings' );

/**
 * Section description callback.
 */
function brab_meeting_settings_section_cb() {
	echo '<p>' . esc_html__( 'These details appear in the “Next Booster Meeting” block on the homepage.', 'broad-run-boosters' ) . '</p>';
}

/**
 * Meeting date field.
 */
function brab_meeting_field_date_cb() {
	$settings = brab_get_meeting_settings();
	printf(
		'<input type="text" class="regular-text" id="brab_meeting_date" name="brab_meeting_settings[date]" value="%s" />',
		esc_attr( $settings['date'] )
	);
	echo '<p class="description">' . esc_html__( 'Example: Tuesday, November 17, 2026', 'broad-run-boosters' ) . '</p>';
}

/**
 * Meeting time field.
 */
function brab_meeting_field_time_cb() {
	$settings = brab_get_meeting_settings();
	printf(
		'<input type="text" class="regular-text" id="brab_meeting_time" name="brab_meeting_settings[time]" value="%s" />',
		esc_attr( $settings['time'] )
	);
	echo '<p class="description">' . esc_html__( 'Example: 6:00 PM', 'broad-run-boosters' ) . '</p>';
}

/**
 * Meeting location field.
 */
function brab_meeting_field_location_cb() {
	$settings = brab_get_meeting_settings();
	printf(
		'<input type="text" class="regular-text" id="brab_meeting_location" name="brab_meeting_settings[location]" value="%s" />',
		esc_attr( $settings['location'] )
	);
	echo '<p class="description">' . esc_html__( 'Example: Broad Run High School, Room 636', 'broad-run-boosters' ) . '</p>';
}

/**
 * Add settings page under Settings → Booster Meeting.
 */
function brab_add_meeting_settings_page() {
	add_options_page(
		__( 'Booster Meeting', 'broad-run-boosters' ),
		__( 'Booster Meeting', 'broad-run-boosters' ),
		'manage_options',
		'brab-meeting-settings',
		'brab_render_meeting_settings_page'
	);
}
add_action( 'admin_menu', 'brab_add_meeting_settings_page' );

/**
 * Render the meeting settings page.
 */
function brab_render_meeting_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'brab_meeting_settings_group' );
			do_settings_sections( 'brab-meeting-settings' );
			submit_button( __( 'Save Meeting Details', 'broad-run-boosters' ) );
			?>
		</form>
	</div>
	<?php
}

/**
 * Default announcement banner values (match original homepage copy).
 *
 * @return array{enabled:string,headline:string,text:string,button_text:string,button_url:string}
 */
function brab_get_announcement_defaults() {
	return array(
		'enabled'     => '1',
		'headline'    => 'Concessions volunteers needed this Friday!',
		'text'        => 'Help support our teams and earn money for your sport.',
		'button_text' => 'Sign Up Here',
		'button_url'  => home_url( '/get-involved/' ),
	);
}

/**
 * Retrieve announcement settings with defaults.
 *
 * @return array{enabled:string,headline:string,text:string,button_text:string,button_url:string}
 */
function brab_get_announcement_settings() {
	$defaults = brab_get_announcement_defaults();
	$stored   = get_option( 'brab_announcement_settings', array() );

	if ( ! is_array( $stored ) ) {
		$stored = array();
	}

	$settings = array(
		'enabled'     => ( isset( $stored['enabled'] ) && '1' === (string) $stored['enabled'] ) ? '1' : ( array_key_exists( 'enabled', $stored ) ? '0' : $defaults['enabled'] ),
		'headline'    => isset( $stored['headline'] ) && '' !== trim( (string) $stored['headline'] ) ? (string) $stored['headline'] : $defaults['headline'],
		'text'        => isset( $stored['text'] ) && '' !== trim( (string) $stored['text'] ) ? (string) $stored['text'] : $defaults['text'],
		'button_text' => isset( $stored['button_text'] ) && '' !== trim( (string) $stored['button_text'] ) ? (string) $stored['button_text'] : $defaults['button_text'],
		'button_url'  => isset( $stored['button_url'] ) && '' !== trim( (string) $stored['button_url'] ) ? (string) $stored['button_url'] : $defaults['button_url'],
	);

	// When option has never been saved, keep enabled default on.
	if ( empty( $stored ) ) {
		$settings['enabled'] = $defaults['enabled'];
	}

	return $settings;
}

/**
 * Sanitize announcement settings before save.
 *
 * @param mixed $input Raw form input.
 * @return array{enabled:string,headline:string,text:string,button_text:string,button_url:string}
 */
function brab_sanitize_announcement_settings( $input ) {
	$defaults = brab_get_announcement_defaults();
	$input    = is_array( $input ) ? $input : array();

	$url = isset( $input['button_url'] ) ? esc_url_raw( trim( (string) $input['button_url'] ) ) : '';
	if ( '' === $url ) {
		$url = $defaults['button_url'];
	}

	return array(
		'enabled'     => ( isset( $input['enabled'] ) && '1' === (string) $input['enabled'] ) ? '1' : '0',
		'headline'    => isset( $input['headline'] ) ? sanitize_text_field( $input['headline'] ) : $defaults['headline'],
		'text'        => isset( $input['text'] ) ? sanitize_text_field( $input['text'] ) : $defaults['text'],
		'button_text' => isset( $input['button_text'] ) ? sanitize_text_field( $input['button_text'] ) : $defaults['button_text'],
		'button_url'  => $url,
	);
}

/**
 * Register Settings API fields for the announcement banner.
 */
function brab_register_announcement_settings() {
	register_setting(
		'brab_announcement_settings_group',
		'brab_announcement_settings',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'brab_sanitize_announcement_settings',
			'default'           => brab_get_announcement_defaults(),
		)
	);

	add_settings_section(
		'brab_announcement_section',
		__( 'Homepage Announcement Banner', 'broad-run-boosters' ),
		'brab_announcement_settings_section_cb',
		'brab-announcement-settings'
	);

	add_settings_field(
		'brab_announcement_enabled',
		__( 'Show banner', 'broad-run-boosters' ),
		'brab_announcement_field_enabled_cb',
		'brab-announcement-settings',
		'brab_announcement_section'
	);

	add_settings_field(
		'brab_announcement_headline',
		__( 'Headline', 'broad-run-boosters' ),
		'brab_announcement_field_headline_cb',
		'brab-announcement-settings',
		'brab_announcement_section'
	);

	add_settings_field(
		'brab_announcement_text',
		__( 'Announcement text', 'broad-run-boosters' ),
		'brab_announcement_field_text_cb',
		'brab-announcement-settings',
		'brab_announcement_section'
	);

	add_settings_field(
		'brab_announcement_button_text',
		__( 'Button text', 'broad-run-boosters' ),
		'brab_announcement_field_button_text_cb',
		'brab-announcement-settings',
		'brab_announcement_section'
	);

	add_settings_field(
		'brab_announcement_button_url',
		__( 'Button URL', 'broad-run-boosters' ),
		'brab_announcement_field_button_url_cb',
		'brab-announcement-settings',
		'brab_announcement_section'
	);
}
add_action( 'admin_init', 'brab_register_announcement_settings' );

/**
 * Section description callback.
 */
function brab_announcement_settings_section_cb() {
	echo '<p>' . esc_html__( 'Control the gold announcement bar that appears below the site header.', 'broad-run-boosters' ) . '</p>';
}

/**
 * Enable/disable field.
 */
function brab_announcement_field_enabled_cb() {
	$settings = brab_get_announcement_settings();
	printf(
		'<label><input type="checkbox" id="brab_announcement_enabled" name="brab_announcement_settings[enabled]" value="1" %s /> %s</label>',
		checked( $settings['enabled'], '1', false ),
		esc_html__( 'Display the announcement banner on the site', 'broad-run-boosters' )
	);
}

/**
 * Headline field.
 */
function brab_announcement_field_headline_cb() {
	$settings = brab_get_announcement_settings();
	printf(
		'<input type="text" class="large-text" id="brab_announcement_headline" name="brab_announcement_settings[headline]" value="%s" />',
		esc_attr( $settings['headline'] )
	);
	echo '<p class="description">' . esc_html__( 'Shown in bold at the start of the banner.', 'broad-run-boosters' ) . '</p>';
}

/**
 * Announcement body text field.
 */
function brab_announcement_field_text_cb() {
	$settings = brab_get_announcement_settings();
	printf(
		'<input type="text" class="large-text" id="brab_announcement_text" name="brab_announcement_settings[text]" value="%s" />',
		esc_attr( $settings['text'] )
	);
}

/**
 * Button text field.
 */
function brab_announcement_field_button_text_cb() {
	$settings = brab_get_announcement_settings();
	printf(
		'<input type="text" class="regular-text" id="brab_announcement_button_text" name="brab_announcement_settings[button_text]" value="%s" />',
		esc_attr( $settings['button_text'] )
	);
}

/**
 * Button URL field.
 */
function brab_announcement_field_button_url_cb() {
	$settings = brab_get_announcement_settings();
	printf(
		'<input type="url" class="regular-text" id="brab_announcement_button_url" name="brab_announcement_settings[button_url]" value="%s" placeholder="https://" />',
		esc_attr( $settings['button_url'] )
	);
}

/**
 * Add settings page under Settings → Booster Announcement.
 */
function brab_add_announcement_settings_page() {
	add_options_page(
		__( 'Booster Announcement', 'broad-run-boosters' ),
		__( 'Booster Announcement', 'broad-run-boosters' ),
		'manage_options',
		'brab-announcement-settings',
		'brab_render_announcement_settings_page'
	);
}
add_action( 'admin_menu', 'brab_add_announcement_settings_page' );

/**
 * Render the announcement settings page.
 */
function brab_render_announcement_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'brab_announcement_settings_group' );
			do_settings_sections( 'brab-announcement-settings' );
			submit_button( __( 'Save Announcement', 'broad-run-boosters' ) );
			?>
		</form>
	</div>
	<?php
}

/**
 * Fallback primary menu markup when no menu is assigned.
 */
function brab_fallback_primary_menu() {
	$items = array(
		'Home'         => home_url( '/' ),
		'About Us'     => home_url( '/about-us/' ),
		'Get Involved' => home_url( '/get-involved/' ),
		'Fundraising'  => home_url( '/fundraising/' ),
		'Scholarships' => home_url( '/scholarships/' ),
		'Shop'         => home_url( '/shop/' ),
		'Contact'      => home_url( '/contact/' ),
	);

	echo '<ul class="nav-menu">';
	foreach ( $items as $label => $url ) {
		$current = ( 'Home' === $label && is_front_page() ) ? ' current-menu-item' : '';
		printf(
			'<li class="menu-item%s"><a href="%s">%s</a></li>',
			esc_attr( $current ),
			esc_url( $url ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Fallback footer menu.
 */
function brab_fallback_footer_menu() {
	$items = array(
		'Home'         => home_url( '/' ),
		'About Us'     => home_url( '/about-us/' ),
		'Get Involved' => home_url( '/get-involved/' ),
		'Fundraising'  => home_url( '/fundraising/' ),
		'Scholarships' => home_url( '/scholarships/' ),
		'Shop'         => home_url( '/shop/' ),
		'Contact'      => home_url( '/contact/' ),
	);

	echo '<ul class="footer-links">';
	foreach ( $items as $label => $url ) {
		printf(
			'<li><a href="%s">%s</a></li>',
			esc_url( $url ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}
