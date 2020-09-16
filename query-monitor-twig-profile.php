<?php
/**
 * Plugin Name:  Query monitor Twig profile
 * Description:  Displays Twig profiler output in Query Monitor. Automatically works with Timber.
 * Version:      1.0.0
 * Plugin URI:   https://github.com/NielsdeBlaauw/query-monitor-twig-profile
 * Author:       Niels de Blaauw
 * Author URI:   https://actd.nl/
 * Text Domain:  ndb_qm_twig
 * Requires PHP: 7.2.0
 *
 * @package NdB\QM_Twig_Profile
 */

namespace NdB\QM_Twig_Profile;

use QM_Collectors;
use Twig\Environment;
use Twig\Extension\ProfilerExtension;
use Twig\Profiler\Profile;

/**
 * Adds our profile collector to Query Monitor.
 *
 * @param array<string, \QM_Collector> $collectors Query Monitors collectors.
 * @return array<string, \QM_Collector>
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
 * @param array<string, \QM_Output> $output Query monitors prepared output.
 * @return array<string, \QM_Output>
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

/**
 * Automatically collects twig profiles from timber.
 *
 * @param \Twig\Environment $twig Timbers twig instance.
 * @return \Twig\Environment
 */
function collect_timber( Environment $twig ):Environment {
	$profile = new Profile();
	$twig->addExtension( new ProfilerExtension( $profile ) );
	$collector = QM_Collectors::get( 'twig_profile' );
	if ( $collector instanceof Collector ) {
		$collector->add( $profile );
	}
	return $twig;
}

add_filter( 'timber/twig', 'NdB\QM_Twig_Profile\collect_timber' );
