<?php
/**
 * Query Monitor Collector for twig profiles.
 *
 * @package NdB\QM_Twig_Profile
 */

namespace NdB\QM_Twig_Profile;

use Twig\Profiler\Profile;

/**
 * The Twig Profile collector.
 */
final class Collector extends \QM_Collector {
	/**
	 * Query monitor ID, used for the panel ID.
	 *
	 * @var string $id
	 */
	public $id = 'twig_profile';

	/**
	 * Store of Twig profile objects.
	 *
	 * @var array<int, \Twig\Profiler\Profile> $profiles
	 */
	private $profiles = array();

	/**
	 * Add a twig profile to the store.
	 *
	 * @param \Twig\Profiler\Profile $profile A twig profile.
	 * @return void
	 */
	public function add( Profile $profile ) {
		$this->profiles[] = $profile;
	}

	/**
	 *  Retrieves all profiles in the store.
	 *
	 * @return array<int, \Twig\Profiler\Profile>
	 */
	public function get_all() {
		return $this->profiles;
	}
}
