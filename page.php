<?php
/**
 * Generic page template — any page without a dedicated layout.
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
the_post();
?>

<main id="main-content" class="site-main">
	<?php brab_page_hero( array( 'eyebrow' => __( 'Broad Run Athletic Booster Club', 'broad-run-boosters' ) ) ); ?>

	<section class="page-section">
		<div class="page-container page-container--narrow prose">
			<?php the_content(); ?>
		</div>
	</section>
</main>

<?php
get_footer();
