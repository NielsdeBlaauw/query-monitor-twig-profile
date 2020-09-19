<?php
/**
 * Formats the profile data for a QM panel.
 *
 * @package NdB\QM_Twig_Profile
 */

namespace NdB\QM_Twig_Profile;

use QM_Output_Html;
use Twig\Profiler\Dumper\Dumper;

/**
 * Formats the output data for a QM panel.
 */
final class Output extends QM_Output_Html {
	const EDITOR_PROTOCOLS = array(
		'phpstorm',
		'vscode',
		'atom',
		'subl',
		'txmt',
		'nbopen',
	);

	/**
	 * Adds the twig profile panel to the menu.
	 *
	 * @param Collector $collector The Twig Profile collector.
	 */
	public function __construct( Collector $collector ) {
		parent::__construct( $collector );
		add_filter( 'qm/output/menus', array( $this, 'admin_menu' ), 110 );
	}

	/**
	 * The name of this panel.
	 *
	 * @return string
	 */
	public function name() {
		return __( 'Twig profile', 'ndb_qm_twig' );
	}

	/**
	 * Renders the panel.
	 *
	 * @return void
	 */
	public function output() {
		$collector = $this->collector;
		if ( ! $collector instanceof Collector ) {
			return;
		}
		$environment_profiles = $collector->get_all();
		?>
		<div class="qm qm-non-tabular" id="qm-twig_profile">
			<div class='qm-boxed'>
				<h2><?php echo esc_html__( 'Twig profile', 'ndb_qm_twig' ); ?></h2>
			</div>
			<?php
			if ( empty( $environment_profiles ) ) {
				echo '<div class="qm-boxed">';
				echo '<section>';
				?>
				<p><?php echo esc_html__( 'No twig profiles on this page :)', 'ndb_qm_twig' ); ?></p>
				<?php
				echo '</section>';
				echo '</div>';
			} else {
				require_once 'class-dumper.php';
				foreach ( $environment_profiles as $environment_profile ) {
					echo '<div class="qm-boxed">';
					echo '<section>';
					$dumper = new Dumper( $environment_profile->environment->getLoader() );
					echo wp_kses( $dumper->dump( $environment_profile->profile ), wp_kses_allowed_html( 'post' ), self::EDITOR_PROTOCOLS );
					echo '</section>';
					echo '</div>';
				}
			}
			?>
		</div>
		<?php
	}
}
