<?php
/**
 * Theme header.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'broad-run-boosters' ); ?></a>

<header class="site-header">
	<div class="header-inner">
		<a class="site-branding" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img
				class="site-logo"
				src="<?php echo brab_img( 'logo-crest.png' ); ?>"
				alt="<?php esc_attr_e( 'Broad Run Athletic Booster Club', 'broad-run-boosters' ); ?>"
				width="56"
				height="52"
			>
			<span class="site-title-block">
				<span class="site-title-main"><?php esc_html_e( 'Broad Run', 'broad-run-boosters' ); ?></span>
				<span class="site-title-sub"><?php esc_html_e( 'Athletic Booster Club', 'broad-run-boosters' ); ?></span>
			</span>
		</a>

		<button
			class="nav-toggle"
			type="button"
			aria-expanded="false"
			aria-controls="primary-navigation"
			aria-label="<?php esc_attr_e( 'Toggle navigation', 'broad-run-boosters' ); ?>"
		>
			<span class="nav-toggle-bar"></span>
			<span class="nav-toggle-bar"></span>
			<span class="nav-toggle-bar"></span>
		</button>

		<nav id="primary-navigation" class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'broad-run-boosters' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'nav-menu',
					'fallback_cb'    => 'brab_fallback_primary_menu',
					'depth'          => 1,
				)
			);
			?>
		</nav>

		<a class="btn btn-donate" href="<?php echo esc_url( home_url( '/donate/' ) ); ?>">
			<?php esc_html_e( 'Donate', 'broad-run-boosters' ); ?>
			<span class="btn-arrow" aria-hidden="true">&rarr;</span>
		</a>
	</div>
</header>

<?php
$announcement = brab_get_announcement_settings();
if ( '1' === $announcement['enabled'] ) :
	?>
<div class="announcement-bar" id="announcement-bar" role="region" aria-label="<?php esc_attr_e( 'Announcement', 'broad-run-boosters' ); ?>">
	<div class="announcement-inner">
		<span class="announcement-icon" aria-hidden="true">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M3 10v4h4l5 4V6L7 10H3z" fill="currentColor"/>
				<path d="M16.5 8.5a5 5 0 010 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
				<path d="M18.5 6a8.5 8.5 0 010 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
			</svg>
		</span>
		<p class="announcement-text">
			<strong><?php echo esc_html( $announcement['headline'] ); ?></strong>
			<?php echo esc_html( $announcement['text'] ); ?>
		</p>
		<a class="announcement-link" href="<?php echo esc_url( $announcement['button_url'] ); ?>">
			<?php echo esc_html( $announcement['button_text'] ); ?>
			<span aria-hidden="true">&rarr;</span>
		</a>
		<button class="announcement-close" type="button" aria-label="<?php esc_attr_e( 'Dismiss announcement', 'broad-run-boosters' ); ?>">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
</div>
	<?php
endif;
?>
