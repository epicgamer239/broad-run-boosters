<?php
/**
 * Team-specific donation picker (used on Donate and Shop pages).
 *
 * @package Broad_Run_Boosters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$general = brab_link( 'donate_url' );
$teams   = brab_setting_pairs( 'team_donations' );
if ( ! $teams ) {
	return;
}
?>
<form class="team-donate" action="<?php echo esc_url( $general ); ?>" method="get" target="_blank">
	<label class="team-donate-label" for="team-donate-select"><?php esc_html_e( 'Choose a team to support', 'broad-run-boosters' ); ?></label>
	<div class="team-donate-row">
		<select id="team-donate-select" class="team-donate-select">
			<?php foreach ( $teams as $team ) : ?>
				<option value="<?php echo esc_url( $team[1] ? $team[1] : $general ); ?>" data-dedicated="<?php echo $team[1] ? '1' : '0'; ?>"><?php echo esc_html( $team[0] ); ?></option>
			<?php endforeach; ?>
		</select>
		<button type="submit" class="btn btn-gold">
			<?php esc_html_e( 'Donate to This Team', 'broad-run-boosters' ); ?>
			<span class="btn-arrow" aria-hidden="true">&rarr;</span>
		</button>
	</div>
	<p class="team-donate-hint" aria-live="polite">
		<?php esc_html_e( 'At checkout, please add the team name in the order note so we can direct your gift.', 'broad-run-boosters' ); ?>
	</p>
</form>
