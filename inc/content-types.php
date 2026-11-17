<?php
/**
 * Editable content lists (board, meetings, positions, recipients, etc.).
 *
 * Every list is a simple custom post type with a few extra fields so Booster
 * Board members can add, edit, reorder or remove items without touching code.
 * All of them live under the "Booster Site" admin menu.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Definitions for each content list.
 *
 * Field types: text, url, email, date, textarea, select, checkbox, file.
 *
 * @return array<string,array<string,mixed>>
 */
function brab_get_content_types() {
	return array(
		'brab_board'     => array(
			'singular' => __( 'Board Member', 'broad-run-boosters' ),
			'plural'   => __( 'Board Members', 'broad-run-boosters' ),
			'supports' => array( 'title', 'thumbnail', 'page-attributes' ),
			'title'    => __( 'Full name', 'broad-run-boosters' ),
			'help'     => __( 'Shown in “Our Board” on the About Us page. Photo (featured image) is optional. Use Order to set the display order.', 'broad-run-boosters' ),
			'fields'   => array(
				'position' => array(
					'label' => __( 'Position', 'broad-run-boosters' ),
					'type'  => 'text',
					'hint'  => __( 'e.g. President, Treasurer', 'broad-run-boosters' ),
				),
			),
		),
		'brab_meeting'   => array(
			'singular' => __( 'Meeting', 'broad-run-boosters' ),
			'plural'   => __( 'Meetings', 'broad-run-boosters' ),
			'supports' => array( 'title' ),
			'title'    => __( 'Meeting name, e.g. November General Meeting', 'broad-run-boosters' ),
			'help'     => __( 'The next upcoming meeting is featured on the homepage automatically. All meetings appear in the schedule on the About Us page.', 'broad-run-boosters' ),
			'fields'   => array(
				'date'     => array(
					'label' => __( 'Date', 'broad-run-boosters' ),
					'type'  => 'date',
				),
				'time'     => array(
					'label'   => __( 'Time', 'broad-run-boosters' ),
					'type'    => 'text',
					'default' => '6:00 PM',
				),
				'location' => array(
					'label'   => __( 'Location', 'broad-run-boosters' ),
					'type'    => 'text',
					'default' => 'Broad Run High School, Room 636',
				),
				'notes'    => array(
					'label' => __( 'Notes (optional)', 'broad-run-boosters' ),
					'type'  => 'text',
					'hint'  => __( 'e.g. Elections, Virtual option available', 'broad-run-boosters' ),
				),
			),
		),
		'brab_position'  => array(
			'singular' => __( 'Open Position', 'broad-run-boosters' ),
			'plural'   => __( 'Open Positions', 'broad-run-boosters' ),
			'supports' => array( 'title', 'editor', 'page-attributes' ),
			'title'    => __( 'Position title', 'broad-run-boosters' ),
			'help'     => __( 'Listed under “Open Board & Committee Positions” on the Get Involved page. Put a brief description in the main editor. Move to Trash once filled.', 'broad-run-boosters' ),
			'fields'   => array(
				'responsibilities' => array(
					'label' => __( 'Responsibilities (one per line)', 'broad-run-boosters' ),
					'type'  => 'textarea',
				),
				'contact'          => array(
					'label' => __( 'Contact email or interest-form link', 'broad-run-boosters' ),
					'type'  => 'text',
					'hint'  => __( 'Leave blank to use the general Booster Club email.', 'broad-run-boosters' ),
				),
			),
		),
		'brab_recipient' => array(
			'singular' => __( 'Scholarship Recipient', 'broad-run-boosters' ),
			'plural'   => __( 'Scholarship Recipients', 'broad-run-boosters' ),
			'supports' => array( 'title', 'thumbnail' ),
			'title'    => __( 'Student name', 'broad-run-boosters' ),
			'help'     => __( 'Recipients are grouped by graduating class on the Scholarships page. Photo (featured image) is optional.', 'broad-run-boosters' ),
			'fields'   => array(
				'class_year'  => array(
					'label' => __( 'Graduating class', 'broad-run-boosters' ),
					'type'  => 'text',
					'hint'  => __( 'e.g. 2026', 'broad-run-boosters' ),
				),
				'scholarship' => array(
					'label' => __( 'Scholarship / award name (optional)', 'broad-run-boosters' ),
					'type'  => 'text',
				),
				'sport'       => array(
					'label' => __( 'Sport(s) (optional)', 'broad-run-boosters' ),
					'type'  => 'text',
				),
			),
		),
		'brab_document'  => array(
			'singular' => __( 'Scholarship Document', 'broad-run-boosters' ),
			'plural'   => __( 'Scholarship Documents', 'broad-run-boosters' ),
			'supports' => array( 'title', 'page-attributes' ),
			'title'    => __( 'Document name, e.g. 2027 Scholarship Application', 'broad-run-boosters' ),
			'help'     => __( 'Downloadable files listed on the Scholarships page. To replace a document for a new year, edit this entry and choose the new file.', 'broad-run-boosters' ),
			'fields'   => array(
				'file'        => array(
					'label' => __( 'File', 'broad-run-boosters' ),
					'type'  => 'file',
				),
				'description' => array(
					'label' => __( 'Short description (optional)', 'broad-run-boosters' ),
					'type'  => 'text',
				),
			),
		),
		'brab_fundraiser' => array(
			'singular' => __( 'Fundraiser', 'broad-run-boosters' ),
			'plural'   => __( 'Fundraisers', 'broad-run-boosters' ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'title'    => __( 'Fundraiser name', 'broad-run-boosters' ),
			'help'     => __( 'Additional fundraisers shown on the Fundraising page (Mulch Madness has its own page). Move to Trash when it is over.', 'broad-run-boosters' ),
			'fields'   => array(
				'dates'      => array(
					'label' => __( 'Dates (optional)', 'broad-run-boosters' ),
					'type'  => 'text',
				),
				'link_url'   => array(
					'label' => __( 'Button link (optional)', 'broad-run-boosters' ),
					'type'  => 'url',
				),
				'link_label' => array(
					'label'   => __( 'Button text', 'broad-run-boosters' ),
					'type'    => 'text',
					'default' => 'Learn More',
				),
			),
		),
		'brab_member'    => array(
			'singular' => __( 'Booster Member', 'broad-run-boosters' ),
			'plural'   => __( 'Booster Members', 'broad-run-boosters' ),
			'supports' => array( 'title' ),
			'title'    => __( 'Name as it should appear, e.g. The Smith Family', 'broad-run-boosters' ),
			'help'     => __( 'Members are listed alphabetically by membership year on the Membership page — only when “Permission to publish” is checked.', 'broad-run-boosters' ),
			'fields'   => array(
				'year'       => array(
					'label' => __( 'Membership year', 'broad-run-boosters' ),
					'type'  => 'text',
					'hint'  => __( 'e.g. 2026–27', 'broad-run-boosters' ),
				),
				'permission' => array(
					'label' => __( 'Permission to publish this name on the website', 'broad-run-boosters' ),
					'type'  => 'checkbox',
				),
			),
		),
		'brab_product'   => array(
			'singular' => __( 'Shop Item', 'broad-run-boosters' ),
			'plural'   => __( 'Shop Items', 'broad-run-boosters' ),
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'title'    => __( 'Item name', 'broad-run-boosters' ),
			'help'     => __( 'Items shown on the Shop page. Set the product photo as the featured image and paste the item’s Square link so buyers check out securely on Square.', 'broad-run-boosters' ),
			'fields'   => array(
				'category'     => array(
					'label'   => __( 'Section', 'broad-run-boosters' ),
					'type'    => 'select',
					'options' => array(
						'yard-signs'  => __( 'Yard Signs', 'broad-run-boosters' ),
						'car-decals'  => __( 'Car Decals', 'broad-run-boosters' ),
						'spirit-wear' => __( 'Other Items', 'broad-run-boosters' ),
					),
				),
				'price'        => array(
					'label' => __( 'Price', 'broad-run-boosters' ),
					'type'  => 'text',
					'hint'  => __( 'e.g. $25', 'broad-run-boosters' ),
				),
				'url'          => array(
					'label' => __( 'Square purchase link', 'broad-run-boosters' ),
					'type'  => 'url',
				),
				'button_label' => array(
					'label'   => __( 'Button text', 'broad-run-boosters' ),
					'type'    => 'text',
					'default' => 'Buy Now',
				),
			),
		),
		'brab_package'   => array(
			'singular' => __( 'Sponsorship Package', 'broad-run-boosters' ),
			'plural'   => __( 'Sponsorship Packages', 'broad-run-boosters' ),
			'supports' => array( 'title', 'page-attributes' ),
			'title'    => __( 'Package name, e.g. Gold Sponsor', 'broad-run-boosters' ),
			'help'     => __( 'Sponsorship levels shown on the Sponsorships page. Use Order to control the order.', 'broad-run-boosters' ),
			'fields'   => array(
				'tier'     => array(
					'label'   => __( 'Color accent', 'broad-run-boosters' ),
					'type'    => 'select',
					'options' => array(
						'gold'   => __( 'Gold', 'broad-run-boosters' ),
						'silver' => __( 'Silver', 'broad-run-boosters' ),
						'bronze' => __( 'Bronze', 'broad-run-boosters' ),
						'maroon' => __( 'Maroon', 'broad-run-boosters' ),
					),
				),
				'price'    => array(
					'label' => __( 'Price', 'broad-run-boosters' ),
					'type'  => 'text',
					'hint'  => __( 'e.g. $1,000 / year', 'broad-run-boosters' ),
				),
				'benefits' => array(
					'label' => __( 'Benefits (one per line)', 'broad-run-boosters' ),
					'type'  => 'textarea',
				),
				'url'      => array(
					'label' => __( 'Square purchase link', 'broad-run-boosters' ),
					'type'  => 'url',
					'hint'  => __( 'Leave blank to use the general sponsorship link from Booster Site → Site Settings.', 'broad-run-boosters' ),
				),
			),
		),
	);
}

/**
 * Register all content-list post types.
 */
function brab_register_content_types() {
	foreach ( brab_get_content_types() as $type => $def ) {
		register_post_type(
			$type,
			array(
				'labels'       => array(
					'name'               => $def['plural'],
					'singular_name'      => $def['singular'],
					'menu_name'          => $def['plural'],
					'all_items'          => $def['plural'],
					/* translators: %s: item type */
					'add_new_item'       => sprintf( __( 'Add %s', 'broad-run-boosters' ), $def['singular'] ),
					/* translators: %s: item type */
					'edit_item'          => sprintf( __( 'Edit %s', 'broad-run-boosters' ), $def['singular'] ),
					'not_found'          => __( 'Nothing added yet.', 'broad-run-boosters' ),
					'not_found_in_trash' => __( 'Nothing in Trash.', 'broad-run-boosters' ),
				),
				'public'       => false,
				'show_ui'      => true,
				'show_in_menu' => 'brab-site',
				'show_in_rest' => in_array( 'editor', $def['supports'], true ),
				'supports'     => $def['supports'],
				'rewrite'      => false,
				'query_var'    => false,
			)
		);
	}
}
add_action( 'init', 'brab_register_content_types' );

/**
 * Title placeholder per type.
 *
 * @param string  $text Placeholder.
 * @param WP_Post $post Post.
 * @return string
 */
function brab_content_type_title_placeholder( $text, $post ) {
	$types = brab_get_content_types();
	return isset( $types[ $post->post_type ]['title'] ) ? $types[ $post->post_type ]['title'] : $text;
}
add_filter( 'enter_title_here', 'brab_content_type_title_placeholder', 10, 2 );

/**
 * Meta boxes.
 */
function brab_content_type_meta_boxes() {
	foreach ( brab_get_content_types() as $type => $def ) {
		add_meta_box( 'brab_fields', __( 'Details', 'broad-run-boosters' ), 'brab_render_content_type_box', $type, 'normal', 'high' );
	}
}
add_action( 'add_meta_boxes', 'brab_content_type_meta_boxes' );

/**
 * Render the details box for any content type.
 *
 * @param WP_Post $post Post.
 */
function brab_render_content_type_box( $post ) {
	$types = brab_get_content_types();
	$def   = $types[ $post->post_type ];
	$fresh = ( 'auto-draft' === $post->post_status );

	wp_nonce_field( 'brab_save_fields', 'brab_fields_nonce' );

	echo '<p class="description" style="margin-bottom:1em">' . esc_html( $def['help'] ) . '</p>';
	echo '<table class="form-table" role="presentation"><tbody>';

	foreach ( $def['fields'] as $key => $field ) {
		$id    = 'brab_f_' . $key;
		$name  = 'brab_fields[' . $key . ']';
		$value = get_post_meta( $post->ID, '_brab_' . $key, true );
		if ( $fresh && '' === $value && isset( $field['default'] ) ) {
			$value = $field['default'];
		}

		echo '<tr><th scope="row"><label for="' . esc_attr( $id ) . '">' . esc_html( $field['label'] ) . '</label></th><td>';

		switch ( $field['type'] ) {
			case 'textarea':
				printf( '<textarea class="large-text" rows="5" id="%s" name="%s">%s</textarea>', esc_attr( $id ), esc_attr( $name ), esc_textarea( $value ) );
				break;
			case 'select':
				printf( '<select id="%s" name="%s">', esc_attr( $id ), esc_attr( $name ) );
				foreach ( $field['options'] as $opt => $label ) {
					printf( '<option value="%s" %s>%s</option>', esc_attr( $opt ), selected( $value, $opt, false ), esc_html( $label ) );
				}
				echo '</select>';
				break;
			case 'checkbox':
				printf( '<input type="checkbox" id="%s" name="%s" value="1" %s />', esc_attr( $id ), esc_attr( $name ), checked( $value, '1', false ) );
				break;
			case 'file':
				printf(
					'<input type="url" class="regular-text brab-media-url" id="%1$s" name="%2$s" value="%3$s" placeholder="https://" /> <button type="button" class="button brab-media-pick" data-target="%1$s" data-type="file">%4$s</button>',
					esc_attr( $id ),
					esc_attr( $name ),
					esc_attr( $value ),
					esc_html__( 'Choose / upload file', 'broad-run-boosters' )
				);
				break;
			default:
				$input_type = in_array( $field['type'], array( 'url', 'email', 'date' ), true ) ? $field['type'] : 'text';
				printf( '<input type="%s" class="regular-text" id="%s" name="%s" value="%s" />', esc_attr( $input_type ), esc_attr( $id ), esc_attr( $name ), esc_attr( $value ) );
		}

		if ( ! empty( $field['hint'] ) ) {
			echo '<p class="description">' . esc_html( $field['hint'] ) . '</p>';
		}
		echo '</td></tr>';
	}

	echo '</tbody></table>';
}

/**
 * Save fields.
 *
 * @param int     $post_id Post ID.
 * @param WP_Post $post    Post.
 */
function brab_save_content_type_fields( $post_id, $post ) {
	$types = brab_get_content_types();
	if ( ! isset( $types[ $post->post_type ] ) ) {
		return;
	}
	if ( ! isset( $_POST['brab_fields_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['brab_fields_nonce'] ) ), 'brab_save_fields' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$input = isset( $_POST['brab_fields'] ) && is_array( $_POST['brab_fields'] ) ? wp_unslash( $_POST['brab_fields'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

	foreach ( $types[ $post->post_type ]['fields'] as $key => $field ) {
		$raw = isset( $input[ $key ] ) ? $input[ $key ] : '';
		switch ( $field['type'] ) {
			case 'textarea':
				$val = sanitize_textarea_field( $raw );
				break;
			case 'url':
			case 'file':
				$val = esc_url_raw( trim( $raw ) );
				break;
			case 'email':
				$val = sanitize_email( $raw );
				break;
			case 'checkbox':
				$val = ( '1' === (string) $raw ) ? '1' : '0';
				break;
			case 'select':
				$val = array_key_exists( $raw, $field['options'] ) ? $raw : (string) key( $field['options'] );
				break;
			case 'date':
				$val = preg_match( '/^\d{4}-\d{2}-\d{2}$/', $raw ) ? $raw : '';
				break;
			default:
				$val = sanitize_text_field( $raw );
		}
		update_post_meta( $post_id, '_brab_' . $key, $val );
	}
}
add_action( 'save_post', 'brab_save_content_type_fields', 10, 2 );

/**
 * Admin list columns: show the first couple of fields.
 */
function brab_content_type_columns_setup() {
	foreach ( brab_get_content_types() as $type => $def ) {
		add_filter(
			"manage_{$type}_posts_columns",
			function ( $columns ) use ( $def ) {
				$new = array();
				foreach ( $columns as $key => $label ) {
					$new[ $key ] = $label;
					if ( 'title' === $key ) {
						foreach ( array_slice( $def['fields'], 0, 2, true ) as $fkey => $field ) {
							$new[ 'brab_' . $fkey ] = $field['label'];
						}
					}
				}
				return $new;
			}
		);
		add_action(
			"manage_{$type}_posts_custom_column",
			function ( $column, $post_id ) use ( $def ) {
				if ( 0 !== strpos( $column, 'brab_' ) ) {
					return;
				}
				$key = substr( $column, 5 );
				if ( ! isset( $def['fields'][ $key ] ) ) {
					return;
				}
				$val   = get_post_meta( $post_id, '_brab_' . $key, true );
				$field = $def['fields'][ $key ];
				if ( 'checkbox' === $field['type'] ) {
					$val = '1' === $val ? __( 'Yes', 'broad-run-boosters' ) : __( 'No', 'broad-run-boosters' );
				} elseif ( 'select' === $field['type'] && isset( $field['options'][ $val ] ) ) {
					$val = $field['options'][ $val ];
				} elseif ( 'date' === $field['type'] && $val ) {
					$val = date_i18n( 'M j, Y', strtotime( $val ) );
				}
				echo '' !== (string) $val ? esc_html( wp_trim_words( $val, 10 ) ) : '&mdash;';
			},
			10,
			2
		);
	}
}
add_action( 'admin_init', 'brab_content_type_columns_setup' );

/**
 * Read a field for a post.
 *
 * @param int    $post_id Post ID.
 * @param string $key     Field key.
 * @return string
 */
function brab_field( $post_id, $key ) {
	return (string) get_post_meta( $post_id, '_brab_' . $key, true );
}

/**
 * Get published items of a content type in admin order.
 *
 * @param string $type Post type.
 * @param array  $args Extra WP_Query args.
 * @return WP_Post[]
 */
function brab_get_items( $type, $args = array() ) {
	$query = new WP_Query(
		array_merge(
			array(
				'post_type'      => $type,
				'post_status'    => 'publish',
				'posts_per_page' => 200,
				'orderby'        => array(
					'menu_order' => 'ASC',
					'title'      => 'ASC',
				),
				'no_found_rows'  => true,
			),
			$args
		)
	);
	return $query->posts;
}

/**
 * Split a textarea value into trimmed non-empty lines.
 *
 * @param string $text Text.
 * @return string[]
 */
function brab_lines( $text ) {
	return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $text ) ) ) );
}

/**
 * Meetings ordered by date.
 *
 * @param bool $upcoming_only Only today or later.
 * @return WP_Post[]
 */
function brab_get_meetings( $upcoming_only = false ) {
	$args = array(
		'meta_key' => '_brab_date', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
		'orderby'  => 'meta_value',
		'order'    => 'ASC',
	);
	if ( $upcoming_only ) {
		$args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			array(
				'key'     => '_brab_date',
				'value'   => wp_date( 'Y-m-d' ),
				'compare' => '>=',
				'type'    => 'DATE',
			),
		);
	}
	return brab_get_items( 'brab_meeting', $args );
}

/**
 * The next upcoming meeting as display data, or null.
 *
 * @return array{date:string,time:string,location:string,notes:string}|null
 */
function brab_get_next_meeting() {
	$meetings = brab_get_meetings( true );
	if ( empty( $meetings ) ) {
		return null;
	}
	return brab_format_meeting( $meetings[0] );
}

/**
 * Format a meeting post for display.
 *
 * @param WP_Post $post Meeting post.
 * @return array{title:string,date:string,date_short:string,time:string,location:string,notes:string,is_past:bool}
 */
function brab_format_meeting( $post ) {
	$raw  = brab_field( $post->ID, 'date' );
	$ts   = $raw ? strtotime( $raw . ' 12:00:00' ) : false;
	return array(
		'title'      => get_the_title( $post ),
		'date'       => $ts ? date_i18n( 'l, F j, Y', $ts ) : __( 'Date to be announced', 'broad-run-boosters' ),
		'date_short' => $ts ? date_i18n( 'M j', $ts ) : '—',
		'time'       => brab_field( $post->ID, 'time' ),
		'location'   => brab_field( $post->ID, 'location' ),
		'notes'      => brab_field( $post->ID, 'notes' ),
		'is_past'    => $raw ? ( $raw < wp_date( 'Y-m-d' ) ) : false,
	);
}

/**
 * Add a short helper note at the top of each list screen.
 */
function brab_content_type_list_notice() {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || 'edit' !== $screen->base ) {
		return;
	}
	$types = brab_get_content_types();
	if ( isset( $types[ $screen->post_type ] ) ) {
		echo '<div class="notice notice-info"><p>' . esc_html( $types[ $screen->post_type ]['help'] ) . '</p></div>';
	}
}
add_action( 'admin_notices', 'brab_content_type_list_notice' );
