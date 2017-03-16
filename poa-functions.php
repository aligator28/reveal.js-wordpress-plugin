<?php 
function poa_reveal_posts_attrs() {
	
	echo "style='position: relative; ";

	if ( !empty(rwmb_meta( 'reveal_background_color' )) ) :
		echo "background-color: " . esc_html(rwmb_meta( 'reveal_background_color' )) . "; ";
	endif;   
	if ( !empty(rwmb_meta( 'reveal_background_image' )) ) :

		$img = rwmb_meta( 'reveal_background_image' );
		$img = array_values($img);

		$bg_image = esc_html($img[0]['full_url']);
		echo "background-image: url(" . $bg_image . "); background-repeat: no-repeat; background-size: contain; background-position: center;";
	endif;
	echo "'";//style ends

	// data-autoslide
	if ( 
		!empty(get_option('poa_option_name')['poa_enable_autoslide']) && 
		!empty( rwmb_meta( 'reveal_autoslide_time' ) ) 
		) {
		echo 'data-autoslide="' . ( intval( rwmb_meta( 'reveal_autoslide_time' ) ) * 1000 ) . '"';
	}

	if ( !empty( rwmb_meta( 'reveal_slides_transition') ) ) {
		echo 'data-transition="' .esc_html( rwmb_meta( 'reveal_slides_transition') ). '"';
	}
}

// change navigation menu urls from default to #/some-url - only html anchors using
function poa_change_menu($items, $args) {

	if ($args->theme_location == 'slidesmenu') {

		foreach($items as $key => $item) {
			$cat = get_category(get_query_var('cat'));
			
			$slide_page = poa_get_page_by_post_name($item->title, OBJECT, POA_POST_TYPE_NAME);

		    $item->url = "#/section" .  $slide_page->ID;
		    // $item->attr_title = "section" .  $key;
		}
	}
  return $items;

}
add_filter('wp_nav_menu_objects', 'poa_change_menu', 10, 2);

function poa_get_page_by_post_name($post_name, $output = OBJECT, $post_type = 'post' ){
    global $wpdb;

    $page = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type= %s", $post_name, $post_type ) );

    if ( $page ) return get_post( $page, $output );

    return null;
}
add_action('init','poa_get_page_by_post_name');


function poa_position_nav($position = 'top') {

	echo 'style="';
	switch ($position) {
		case 'top':
			echo 'top: 0; left: 50%; transform: translateX(-50%);';
			break;
		case 'bottom':
			echo 'bottom: 10px; left: 50%; transform: translateX(-50%);';
			break;
		case 'left':
			echo 'top: 50%; transform: translateY(-50%); left: 0;';
			break;
		case 'right':
			echo 'top: 50%; transform: translateY(-50%); right: 0;';
			break;

		default:
			# code...
			break;
	}
	echo '"';
}

function getFrameSrc($html_code) {
	$allowed_html = array(
		'iframe' => array(
			'src' => true,
		),
		'div' => array(),
	); 
	$videoEmbed = wp_kses( $html_code, $allowed_html );
	$doc = new DOMDocument();
	$doc->loadHTML($videoEmbed);

	$embed_src = $doc->getElementsByTagName('iframe')->item(0)->getAttribute('src');
	$embed_src = esc_url( $embed_src );
	
	return $embed_src;
}