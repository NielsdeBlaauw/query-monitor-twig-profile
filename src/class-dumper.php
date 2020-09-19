<?php
/**
 * Custom Twig Profile dumper for QM.
 *
 * @package NdB\QM_Twig_Profile
 */

namespace Twig\Profiler\Dumper;

use Twig\Profiler\Profile;

/**
 * This custom dumper has some extra support for formatting.
 *
 * It adds compatibility with QM's dark mode.
 */
final class Dumper extends BaseDumper {

	/**
	 * Colors for rendering the profile dump.
	 *
	 * @var array<string, string> $colors
	 */
	private static $colors = array(
		'auto'       => '#fdf',
		'block'      => '#dfd',
		'macro'      => '#ddf',
		'template'   => '#ffd',
		'big'        => '#d44',
		'text-light' => '#fff',
		'text-dark'  => '#000',
	);

	/**
	 * Returns the content of the profile.
	 *
	 * @param Profile $profile The twig profile to dump.
	 */
	public function dump( Profile $profile ):string {
		return '<pre>' . parent::dump( $profile ) . '</pre>';
	}

	/**
	 * Formats a template to profile html.
	 *
	 * @param Profile $profile The twig profile to dump.
	 * @param string  $prefix Indentation depth.
	 */
	protected function formatTemplate( Profile $profile, $prefix ):string {
		return sprintf( '%s└ <span style="background-color: %s; color: %s">%s</span>', $prefix, self::$colors['template'], self::$colors['text-dark'], $profile->getTemplate() );
	}

	/**
	 * Formats everything that's not a template (blocks, macros) to profile html.
	 *
	 * @param Profile $profile The twig profile to dump.
	 * @param string  $prefix Indentation depth.
	 */
	protected function formatNonTemplate( Profile $profile, $prefix ):string {
		return sprintf( '%s└ %s::%s(<span style="background-color: %s; color: %s">%s</span>)', $prefix, $profile->getTemplate(), $profile->getType(), isset( self::$colors[ $profile->getType() ] ) ? self::$colors[ $profile->getType() ] : self::$colors['auto'], self::$colors['text-dark'], $profile->getName() );
	}

	/**
	 * Colors the time to mark everything 20% and up.
	 *
	 * @param Profile $profile The twig profile to dump.
	 * @param string  $percent The relative duration.
	 */
	protected function formatTime( Profile $profile, $percent ):string {
		return sprintf( '<span style="color: %s">%.2fms/%.0f%%</span>', $percent > 20 ? self::$colors['big'] : 'auto', $profile->getDuration() * 1000, $percent );
	}
}
