<?php
/**
 * Plugin Name: Reveal Presentation Slides Plugin
 * Plugin URI: https://someuri
 * Description: Create custom Presentational Slides with possibility to manage and create Speaker Notes
 * Version: 1.0
 * Author: Pliuta Oleh
 * Author URI: http://author
 * License: GPL2+
 * Text Domain: poa-presentation-slides
 * Domain Path: /languages/
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define('POA_POST_TYPE_NAME', 'slides');
define('POA_PLUGIN_DIR', dirname(__FILE__));
define('POA_PLUGIN_URL', WP_PLUGIN_URL . '/poa-presentation-slides');

require POA_PLUGIN_DIR . '/inc/class-tgm-plugin-activation.php';
require POA_PLUGIN_DIR . '/inc/activation-required-plugins.php';

require POA_PLUGIN_DIR . '/poa-setup.php';
require POA_PLUGIN_DIR . '/poa-functions.php';
require POA_PLUGIN_DIR . '/poa-settings.php';
require POA_PLUGIN_DIR . '/inc/custom-meta-box-slides.php';



// фильтр передает переменную $template - путь до файла шаблона.
add_filter('template_include', 'poa_slides_template');

function poa_slides_template( $template ) {

	if( is_category() ) :

		$cat = get_category(get_query_var('cat'));

	global $slides_loop;

 	// если использовать 'category__in' а не 'cat', то дочерние категории не будут выбираться
	$slides_loop = new WP_Query( array( 'post_type' => POA_POST_TYPE_NAME, 'category__in' => $cat->term_id, 'posts_per_page' => '-1', 'order' => 'asc' ) );

	if ($slides_loop->have_posts()) :

		include POA_PLUGIN_DIR . '/templates/main.php';

	endif;

	wp_reset_query();

	endif; //if( is_category() )

	return $template;

}
