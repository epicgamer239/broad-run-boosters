<?php
/**
 * Spartan Sponsors — CPT + helpers for homepage display.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Sponsor post type.
 */
function brab_register_sponsor_cpt() {
	$labels = array(
		'name'               => __( 'Sponsors', 'broad-run-boosters' ),
		'singular_name'      => __( 'Sponsor', 'broad-run-boosters' ),
		'add_new'            => __( 'Add New', 'broad-run-boosters' ),
		'add_new_item'       => __( 'Add New Sponsor', 'broad-run-boosters' ),
		'edit_item'          => __( 'Edit Sponsor', 'broad-run-boosters' ),
		'new_item'           => __( 'New Sponsor', 'broad-run-boosters' ),
		'view_item'          => __( 'View Sponsor', 'broad-run-boosters' ),
		'search_items'       => __( 'Search Sponsors', 'broad-run-boosters' ),
		'not_found'          => __( 'No sponsors found.', 'broad-run-boosters' ),
		'not_found_in_trash' => __( 'No sponsors found in Trash.', 'broad-run-boosters' ),
		'menu_name'          => __( 'Sponsors', 'broad-run-boosters' ),
		'all_items'          => __( 'All Sponsors', 'broad-run-boosters' ),
	);

	register_post_type(
		'brab_sponsor',
		array(
			'labels'              => $labels,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 25,
			'menu_icon'           => 'dashicons-awards',
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'supports'            => array( 'title', 'thumbnail', 'page-attributes' ),
			'has_archive'         => false,
			'rewrite'             => false,
			'query_var'           => false,
			'show_in_rest'        => true,
		)
	);
}
add_action( 'init', 'brab_register_sponsor_cpt' );

/**
 * Sponsor tier choices.
 *
 * @return array<string,string>
 */
function brab_get_sponsor_tiers() {
	return array(
		'gold'   => __( 'Gold', 'broad-run-boosters' ),
		'silver' => __( 'Silver', 'broad-run-boosters' ),
		'bronze' => __( 'Bronze', 'broad-run-boosters' ),
	);
}

/**
 * Register meta box for tier + URL.
 */
function brab_sponsor_meta_boxes() {
	add_meta_box(
		'brab_sponsor_details',
		__( 'Sponsor Details', 'broad-run-boosters' ),
		'brab_render_sponsor_meta_box',
		'brab_sponsor',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'brab_sponsor_meta_boxes' );

/**
 * Meta box markup.
 *
 * @param WP_Post $post Current post.
 */
function brab_render_sponsor_meta_box( $post ) {
	wp_nonce_field( 'brab_save_sponsor_meta', 'brab_sponsor_meta_nonce' );

	$tier     = get_post_meta( $post->ID, '_brab_sponsor_tier', true );
	$url      = get_post_meta( $post->ID, '_brab_sponsor_url', true );
	$homepage = get_post_meta( $post->ID, '_brab_show_on_homepage', true );

	if ( ! $tier ) {
		$tier = 'gold';
	}
	?>
	<p>
		<label for="brab_sponsor_tier"><strong><?php esc_html_e( 'Sponsorship tier', 'broad-run-boosters' ); ?></strong></label><br>
		<select name="brab_sponsor_tier" id="brab_sponsor_tier">
			<?php foreach ( brab_get_sponsor_tiers() as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $tier, $value ); ?>>
					<?php echo esc_html( $label ); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label for="brab_sponsor_url"><strong><?php esc_html_e( 'Website URL', 'broad-run-boosters' ); ?></strong></label><br>
		<input type="url" class="large-text" name="brab_sponsor_url" id="brab_sponsor_url" value="<?php echo esc_attr( $url ); ?>" placeholder="https://">
	</p>
	<p>
		<label>
			<input type="checkbox" name="brab_show_on_homepage" value="1" <?php checked( $homepage, '1' ); ?> />
			<strong><?php esc_html_e( 'Show on homepage', 'broad-run-boosters' ); ?></strong>
		</label>
	</p>
	<p class="description">
		<?php esc_html_e( 'Set the featured image as the sponsor logo. Use Order (page attributes) to control display order within a tier. Only sponsors marked “Show on homepage” appear in the homepage Spartan Sponsors section; all published sponsors remain available for a full sponsors page later.', 'broad-run-boosters' ); ?>
	</p>
	<?php
}

/**
 * Save sponsor meta.
 *
 * @param int $post_id Post ID.
 */
function brab_save_sponsor_meta( $post_id ) {
	if ( ! isset( $_POST['brab_sponsor_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['brab_sponsor_meta_nonce'] ) ), 'brab_save_sponsor_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( 'brab_sponsor' !== get_post_type( $post_id ) ) {
		return;
	}

	$tiers = array_keys( brab_get_sponsor_tiers() );
	$tier  = isset( $_POST['brab_sponsor_tier'] ) ? sanitize_key( wp_unslash( $_POST['brab_sponsor_tier'] ) ) : 'gold';
	if ( ! in_array( $tier, $tiers, true ) ) {
		$tier = 'gold';
	}
	update_post_meta( $post_id, '_brab_sponsor_tier', $tier );

	$url = isset( $_POST['brab_sponsor_url'] ) ? esc_url_raw( wp_unslash( $_POST['brab_sponsor_url'] ) ) : '';
	update_post_meta( $post_id, '_brab_sponsor_url', $url );

	$show = ( isset( $_POST['brab_show_on_homepage'] ) && '1' === (string) $_POST['brab_show_on_homepage'] ) ? '1' : '0';
	update_post_meta( $post_id, '_brab_show_on_homepage', $show );
}
add_action( 'save_post_brab_sponsor', 'brab_save_sponsor_meta' );

/**
 * Admin list columns.
 *
 * @param array<string,string> $columns Columns.
 * @return array<string,string>
 */
function brab_sponsor_columns( $columns ) {
	$new = array();
	foreach ( $columns as $key => $label ) {
		$new[ $key ] = $label;
		if ( 'title' === $key ) {
			$new['brab_logo']     = __( 'Logo', 'broad-run-boosters' );
			$new['brab_tier']     = __( 'Tier', 'broad-run-boosters' );
			$new['brab_homepage'] = __( 'Homepage', 'broad-run-boosters' );
			$new['brab_url']      = __( 'Website', 'broad-run-boosters' );
		}
	}
	return $new;
}
add_filter( 'manage_brab_sponsor_posts_columns', 'brab_sponsor_columns' );

/**
 * Render custom admin columns.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function brab_sponsor_column_content( $column, $post_id ) {
	if ( 'brab_logo' === $column ) {
		if ( has_post_thumbnail( $post_id ) ) {
			echo get_the_post_thumbnail( $post_id, array( 80, 40 ) );
		} else {
			echo '&mdash;';
		}
		return;
	}

	if ( 'brab_tier' === $column ) {
		$tier  = get_post_meta( $post_id, '_brab_sponsor_tier', true );
		$tiers = brab_get_sponsor_tiers();
		echo isset( $tiers[ $tier ] ) ? esc_html( $tiers[ $tier ] ) : '&mdash;';
		return;
	}

	if ( 'brab_homepage' === $column ) {
		$show = get_post_meta( $post_id, '_brab_show_on_homepage', true );
		echo ( '1' === $show ) ? esc_html__( 'Yes', 'broad-run-boosters' ) : esc_html__( 'No', 'broad-run-boosters' );
		return;
	}

	if ( 'brab_url' === $column ) {
		$url = get_post_meta( $post_id, '_brab_sponsor_url', true );
		if ( $url ) {
			printf(
				'<a href="%1$s" target="_blank" rel="noopener noreferrer">%2$s</a>',
				esc_url( $url ),
				esc_html( wp_parse_url( $url, PHP_URL_HOST ) ? wp_parse_url( $url, PHP_URL_HOST ) : $url )
			);
		} else {
			echo '&mdash;';
		}
	}
}
add_action( 'manage_brab_sponsor_posts_custom_column', 'brab_sponsor_column_content', 10, 2 );

/**
 * Make tier column sortable.
 *
 * @param array<string,string> $columns Columns.
 * @return array<string,string>
 */
function brab_sponsor_sortable_columns( $columns ) {
	$columns['brab_tier'] = 'brab_tier';
	return $columns;
}
add_filter( 'manage_edit-brab_sponsor_sortable_columns', 'brab_sponsor_sortable_columns' );

/**
 * Sort by tier in admin.
 *
 * @param WP_Query $query Query.
 */
function brab_sponsor_admin_orderby( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( 'brab_tier' === $query->get( 'orderby' ) ) {
		$query->set( 'meta_key', '_brab_sponsor_tier' );
		$query->set( 'orderby', 'meta_value' );
	}
}
add_action( 'pre_get_posts', 'brab_sponsor_admin_orderby' );

/**
 * Featured image labels for sponsors.
 */
function brab_sponsor_admin_scripts( $hook ) {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || 'brab_sponsor' !== $screen->post_type ) {
		return;
	}

	add_filter( 'admin_post_thumbnail_html', 'brab_sponsor_featured_image_note' );
}
add_action( 'admin_enqueue_scripts', 'brab_sponsor_admin_scripts' );

/**
 * Clarify featured image usage.
 *
 * @param string $content HTML.
 * @return string
 */
function brab_sponsor_featured_image_note( $content ) {
	$screen = get_current_screen();
	if ( ! $screen || 'brab_sponsor' !== $screen->post_type ) {
		return $content;
	}
	$content .= '<p class="description">' . esc_html__( 'Upload the sponsor logo here. A transparent PNG works best.', 'broad-run-boosters' ) . '</p>';
	return $content;
}

/**
 * Placeholder sponsors used when none are published yet.
 *
 * @return array<string,array<int,array{name:string,logo:string,url:string}>>
 */
function brab_get_sponsor_placeholders() {
	return array(
		'gold'   => array(
			array(
				'name' => 'Image360',
				'logo' => 'sponsor-gold-1.svg',
				'url'  => '',
			),
			array(
				'name' => 'WaveGuide',
				'logo' => 'sponsor-gold-2.svg',
				'url'  => '',
			),
			array(
				'name' => 'Ourisman',
				'logo' => 'sponsor-silver-1.svg',
				'url'  => '',
			),
		),
		'silver' => array(
			array(
				'name' => 'Chick-fil-A',
				'logo' => 'sponsor-silver-3.svg',
				'url'  => '',
			),
			array(
				'name' => 'AST',
				'logo' => 'sponsor-silver-2.svg',
				'url'  => '',
			),
		),
		'bronze' => array(
			array(
				'name' => 'Inova',
				'logo' => 'sponsor-bronze-1.svg',
				'url'  => '',
			),
			array(
				'name' => 'Riverside Healthcare',
				'logo' => 'sponsor-bronze-2.svg',
				'url'  => '',
			),
		),
	);
}

/**
 * Map a sponsor post to display data.
 *
 * @param WP_Post $post Sponsor post.
 * @return array{name:string,logo_url:string,url:string,is_placeholder:bool,tier:string,show_on_homepage:bool}
 */
function brab_format_sponsor_for_display( $post ) {
	$tier = get_post_meta( $post->ID, '_brab_sponsor_tier', true );
	if ( ! in_array( $tier, array_keys( brab_get_sponsor_tiers() ), true ) ) {
		$tier = 'gold';
	}

	$logo_url = get_the_post_thumbnail_url( $post->ID, 'medium' );
	if ( ! $logo_url ) {
		$logo_url = '';
	}

	return array(
		'name'             => get_the_title( $post ),
		'logo_url'         => $logo_url,
		'url'              => (string) get_post_meta( $post->ID, '_brab_sponsor_url', true ),
		'is_placeholder'   => false,
		'tier'             => $tier,
		'show_on_homepage' => ( '1' === (string) get_post_meta( $post->ID, '_brab_show_on_homepage', true ) ),
	);
}

/**
 * Get all published sponsors grouped by tier (for a future full sponsors page).
 *
 * @return array<string,array<int,array{name:string,logo_url:string,url:string,is_placeholder:bool}>>
 */
function brab_get_all_sponsors_by_tier() {
	return brab_query_sponsors_by_tier( false );
}

/**
 * Get sponsors grouped by tier for the homepage (homepage-flagged only).
 *
 * @return array<string,array<int,array{name:string,logo_url:string,url:string,is_placeholder:bool}>>
 */
function brab_get_sponsors_for_display() {
	return brab_query_sponsors_by_tier( true );
}

/**
 * Query sponsors grouped by tier.
 *
 * @param bool $homepage_only When true, only include sponsors marked for homepage.
 * @return array<string,array<int,array{name:string,logo_url:string,url:string,is_placeholder:bool}>>
 */
function brab_query_sponsors_by_tier( $homepage_only = false ) {
	$tiers  = array_keys( brab_get_sponsor_tiers() );
	$result = array_fill_keys( $tiers, array() );

	$args = array(
		'post_type'      => 'brab_sponsor',
		'post_status'    => 'publish',
		'posts_per_page' => 100,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'title'      => 'ASC',
		),
		'no_found_rows'  => true,
	);

	if ( $homepage_only ) {
		$args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			array(
				'key'   => '_brab_show_on_homepage',
				'value' => '1',
			),
		);
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		foreach ( $query->posts as $post ) {
			$item = brab_format_sponsor_for_display( $post );
			$tier = $item['tier'];
			unset( $item['tier'], $item['show_on_homepage'] );
			$result[ $tier ][] = $item;
		}
		wp_reset_postdata();
		return $result;
	}

	// Homepage with no flagged sponsors yet, but other sponsors exist: show nothing from CPT
	// and fall through to placeholders only when zero sponsors exist at all.
	if ( $homepage_only ) {
		$any = new WP_Query(
			array(
				'post_type'      => 'brab_sponsor',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
				'fields'         => 'ids',
				'no_found_rows'  => true,
			)
		);
		if ( $any->have_posts() ) {
			return $result;
		}
	}

	// No published sponsors yet — show clearly labeled theme placeholders.
	foreach ( brab_get_sponsor_placeholders() as $tier => $items ) {
		foreach ( $items as $item ) {
			$result[ $tier ][] = array(
				'name'           => $item['name'],
				'logo_url'       => brab_img( $item['logo'] ),
				'url'            => $item['url'],
				'is_placeholder' => true,
			);
		}
	}

	return $result;
}

/**
 * Render a single sponsor logo (link optional).
 *
 * @param array{name:string,logo_url:string,url:string,is_placeholder?:bool} $sponsor Sponsor data.
 */
function brab_render_sponsor_logo( $sponsor ) {
	$classes = array( 'sponsor-logo' );
	if ( ! empty( $sponsor['is_placeholder'] ) || empty( $sponsor['logo_url'] ) ) {
		$classes[] = 'sponsor-logo--placeholder';
	}

	ob_start();
	if ( ! empty( $sponsor['logo_url'] ) ) {
		printf(
			'<img src="%1$s" alt="%2$s" loading="lazy" decoding="async">',
			esc_url( $sponsor['logo_url'] ),
			esc_attr( $sponsor['name'] )
		);
	} else {
		printf(
			'<span class="sponsor-logo-fallback">%s</span>',
			esc_html( $sponsor['name'] )
		);
	}
	$inner = ob_get_clean();

	$class_attr = esc_attr( implode( ' ', $classes ) );

	if ( ! empty( $sponsor['url'] ) ) {
		printf(
			'<a class="%1$s" href="%2$s" target="_blank" rel="noopener noreferrer">%3$s</a>',
			$class_attr,
			esc_url( $sponsor['url'] ),
			$inner
		);
		return;
	}

	printf( '<span class="%1$s">%2$s</span>', $class_attr, $inner );
}
