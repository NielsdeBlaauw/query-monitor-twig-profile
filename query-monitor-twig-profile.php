<?php
/**
 * Plugin Name: Query monitor Twig profile
 *
 * @package NdB\QM_Twig_Profile
 */

namespace NdB\QM_Twig_Profile;

/**
 * Adds our profile collector to Query Monitor.
 *
 * @param array $collectors Query Monitors collectors.
 * @return \QM_Collectors[]
 */
function register_collector( array $collectors ) {
	require_once __DIR__ . '/src/class-collector.php';
	$collectors['twig_profile'] = new Collector();
	return $collectors;
}

add_filter( 'qm/collectors', 'NdB\QM_Twig_Profile\register_collector', 20, 1 );

/**
 * Renders the twig profile query monitor panel.
 *
 * @param array $output Query monitors prepared output.
 * @return \QM_Output[]
 */
function render( array $output ) {
	$collector = \QM_Collectors::get( 'twig_profile' );
	if ( $collector instanceof Collector ) {
		require_once __DIR__ . '/src/class-output.php';
		$output['twig_profile'] = new Output( $collector );
	}
	return $output;
}

add_filter( 'qm/outputter/html', 'NdB\QM_Twig_Profile\render' );

