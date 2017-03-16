<?php 
add_action( 'init', 'poa_load_plugin_textdomain' );

function poa_load_plugin_textdomain() {
	$plugin_dir = basename(dirname(__FILE__))."/languages/";
	load_plugin_textdomain( 'poa-presentation-slides', false, $plugin_dir );
}


add_action( 'plugins_loaded', 'poa_ps_setup' );

function poa_ps_setup() {

	add_action( 'wp_enqueue_scripts', 'poa_ps_enqueue_scripts' );
	add_action('init', 'poa_ps_register_post_types');
}

function poa_ps_enqueue_scripts() {


	if ( is_category() ) :
		$cat = get_category(get_query_var('cat'));
		$slides_loop = new WP_Query( array( 'post_type' => POA_POST_TYPE_NAME, 'category__in' => $cat->term_id, 'posts_per_page' => -1, 'order' => 'asc' ) );
		if ( !empty($slides_loop) ) :

			wp_enqueue_style( 'reveal_preloader_css', POA_PLUGIN_URL . '/css/preloader.css', array(), '2017' );
			wp_enqueue_style( 'reveal_css', POA_PLUGIN_URL . '/js/libs/reveal/css/reveal.css', array(), '2017' );
			// reveal.js scripts
			wp_register_script( 'reveal_js', POA_PLUGIN_URL . '/js/libs/reveal/js/reveal.js', array('jquery'), '3.7.3', '1.0', true );
			wp_enqueue_script( 'reveal_js' );

			wp_enqueue_style( 'reveal_custom_css', POA_PLUGIN_URL . '/css/poa_style.css', array(), '20160816' );

			wp_register_script( 'reveal_speaker_notes_js', POA_PLUGIN_URL . '/js/libs/reveal/plugin/notes/notes.js', array(), null, true );
			wp_enqueue_script( 'reveal_speaker_notes_js' );

			// reveal.js current config and work
			wp_register_script( 'reveal_front_js', POA_PLUGIN_URL . '/js/front-js.js', array(), '3.7.3', true );
			
			// get plugin options from admin page Settings->Presentation Slides
			$autoslide = isset(get_option('poa_option_name')['poa_enable_autoslide']) ? get_option('poa_option_name')['poa_enable_autoslide'] : 0;
			$loop = isset(get_option('poa_option_name')['poa_enable_continuous_loop']) ? get_option('poa_option_name')['poa_enable_continuous_loop'] : 0;
			$transition = isset(get_option('poa_option_name')['poa_slides_transition']) ? get_option('poa_option_name')['poa_slides_transition'] : 0;

			// Localize the script with new data
			$php_vars = array(
				'enable_autoslide' => intval( $autoslide ),
			// 	'autoslide_time' => esc_html( of_get_option('reveal_autoslide_time') ),
				'loop_presentation' => intval( $loop ),
				'transition' => esc_html($transition)
			);
			wp_localize_script( 'reveal_front_js', 'php_vars', $php_vars );

			wp_enqueue_script( 'reveal_front_js' );

			if (!empty(get_option('poa_option_name')['poa_position_navigation'])) {
				$position = esc_html(get_option('poa_option_name')['poa_position_navigation']);
				if ($position == 'left' || $position == 'right') {
					wp_enqueue_style( 'position_css', POA_PLUGIN_URL . '/css/poa-position-nav.css', array(), '2017' );
				}
			}
			endif;
	endif; //is_category()
}

function poa_ps_register_post_types() {
	$labels = array( 
    'name' => esc_html__( 'Slides', 'poa-presentation-slides' ),
    'singular_name' => esc_html__( 'Slide', 'poa-presentation-slides' ),
    'add_new' => esc_html__( 'New Slide', 'poa-presentation-slides' ),
    'add_new_item' => esc_html__( 'Add New Slide', 'poa-presentation-slides' ),
    'edit_item' => esc_html__( 'Edit Slide', 'poa-presentation-slides' ),
    'new_item' => esc_html__( 'New Slide', 'poa-presentation-slides' ),
    'view_item' => esc_html__( 'View Slide', 'poa-presentation-slides' ),
    'search_items' => esc_html__( 'Search Slides', 'poa-presentation-slides' ),
    'not_found' =>  esc_html__( 'No Slides Found', 'poa-presentation-slides' ),
    'not_found_in_trash' => esc_html__( 'No Slides found in Trash', 'poa-presentation-slides' ),
  );
  $args = array(
    'labels' => $labels,
    'has_archive' => true,
    'public' => true,
    'hierarchical' => false,
    // 'exclude_from_search' => true,
    'rewrite' => array( 'slug' => 'slides' ),
    'menu_icon' => 'dashicons-tickets-alt',
    'supports' => array(
      'title', 
      'editor', 
      'thumbnail',
      'page-attributes'
    ),
    'taxonomies' => array( /*'post_tag',*/ 'category' ), 
  );

	register_post_type( POA_POST_TYPE_NAME, $args );
}

function poa_admin_stylesheet() { 
   	wp_enqueue_style( 'admin_css', POA_PLUGIN_URL . '/css/poa-admin-style.css' );
   	wp_enqueue_script( 'admin_js', POA_PLUGIN_URL . '/js/admin-js.js' );
}
add_action('admin_head', 'poa_admin_stylesheet' );

function poa_register_nav_menu() {
	register_nav_menu( 'slidesmenu', 'Slides Menu' );
}
add_action( 'after_setup_theme', 'poa_register_nav_menu' );



// add_action( 'after_menu_locations_table', 'test' );

// function test() {
// 	echo '<h1 style="font-size: 5rem;">hello</h1>';
// }
// /** This action is documented in wp-includes/nav-menu.php */
// // do_action( 'wp_update_nav_menu', $nav_menu_selected_id );


// function poa_auto_register_nav_menu_location() {
// 	$menu_slug = esc_html( get_option('menu_slug') );
// 	$menu_name = esc_html( get_option('menu_name') );

//     register_nav_menu($menu_slug, $menu_name);
// }
// if ( get_option('menu_slug') !== null && get_option('menu_name')  !== null ) {
// 	add_action( 'after_setup_theme', 'poa_auto_register_nav_menu_location' );
// }

// // define the wp_create_nav_menu callback 
// function poa_wp_create_nav_menu( $menu_term_id, $menu_data ) { 
    
//     $menu_name = trim( $menu_data["menu-name"] );
//     $menu_slug = mb_strtolower( str_replace(' ', '', $menu_name) );

//     add_option('menu_name', $menu_name, '', 'yes');
//     add_option('menu_slug', $menu_slug, '', 'yes');

// }; 
         
// add_action( 'wp_create_nav_menu', 'poa_wp_create_nav_menu', 10, 2 ); 