<?php
/**
 * Test Theme by Sunny.
 *
 * @package  WordPress
 * @subpackage  Sunny
 * @author:  Sunny <sunny92geek@gmail.com>
 * @since Sunny 1.0
 * @link https://github.com/geek92sunny/wp-test-idan
 */

$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;

	$timber = new Timber\Timber();
	\Carbon_Fields\Carbon_Fields::boot();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

/* Twig will look for templates in these directories */
Timber::$dirname = array( 'templates' );

/* Means, remember to escape */
Timber::$autoescape = false;


include __DIR__ . '/includes/class-theme.php';

include __DIR__ . '/includes/class-custom-fields.php';

include __DIR__ . '/includes/class-ajax.php';
