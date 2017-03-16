<?php

add_filter( 'rwmb_meta_boxes', 'poa_reveal_meta_boxes_slides' );

function poa_reveal_meta_boxes_slides( $meta_boxes ) {
	$prefix = 'reveal_';

    $meta_boxes[] = array(
        'title'      => esc_html__( 'Slide Settings:', 'poa-presentation-slides' ),
        'post_types' => array('slides'),
        'fields'     => array(
			array(
				'type' => 'heading',
				'name' => esc_html__( 'Use this slide in slideshow', 'poa-presentation-slides' ),
				'desc' => esc_html__( 'If not checked this slide won\'t display on frontend slideshow', 'poa-presentation-slides' )
			),
			array(
				'name' => esc_html__( 'Use', 'poa-presentation-slides' ),
				'id'   => $prefix . "use_slide",
				'type' => 'checkbox',
				'std'  => 1
			),        	
			array(
				'type' => 'heading',
				'name' => esc_html__( 'Autoslide Time', 'poa-presentation-slides' ),
				'desc' => esc_html__( 'Option works if enabled in Theme Options->Advaced Settings->Enable Autoslide', 'poa-presentation-slides' )
			),
			// SLIDER
			array(
				'name'       => esc_html__( 'Set Autoslide Time', 'poa-presentation-slides' ),
				'id'         => $prefix . "autoslide_time",
				'type'       => 'slider',
				// Text labels displayed before and after value
				// 'prefix'     => esc_html__( '$', 'your-prefix' ),
				'suffix'     => esc_html__( ' sec', 'poa-presentation-slides' ),
				// jQuery UI slider options. See here http://api.jqueryui.com/slider/
				'js_options' => array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				),
				'std' 		=> 15,
			),

			array(
				'type' => 'divider',
			),

			array(
				'type' => 'heading',
				'name' => esc_html__( 'Transition:', 'poa-presentation-slides' )
			),
			// SELECT BOX
			array(
				'name'        => esc_html__( 'Slide Transition', 'poa-presentation-slides' ),
				'id'          => $prefix."slides_transition",
				'type'        => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'     => array(
					'none' => esc_html__( 'No transition', 'poa-presentation-slides' ),
					'slide' => esc_html__( 'Slide', 'poa-presentation-slides' ),
					'fade' => esc_html__( 'Fade', 'poa-presentation-slides' ),
					'concave' => esc_html__( 'Concave', 'poa-presentation-slides' ),
					'convex' => esc_html__( 'Convex', 'poa-presentation-slides' ),
					'zoom' => esc_html__( 'Zoom', 'poa-presentation-slides' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'slide',
				'placeholder' => esc_html__( 'Select an Item', 'poa-presentation-slides' ),
			),

			array(
				'type' => 'heading',
				'name' => esc_html__( 'Speaker Notes:', 'poa-presentation-slides' )
			),
			array(
				'name' => esc_html__( 'Enter Speaker Notes here (HTML allowed)', 'poa-presentation-slides' ),
				'desc' => esc_html__('You can add any notes for each slide', 'poa-presentation-slides'),
				'id'   => $prefix . "slide_notes",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 10,
			),
        	// HEADING
			array(
				'type' => 'heading',
				'name' => esc_html__( 'Background Settings:', 'poa-presentation-slides' )
			),
			// // heading
			// array(
			// 	'type' => 'heading',
			// 	'name' => esc_html__( 'Animated Background with Particles.js', 'poa-presentation-slides' ),
			// 	'desc' => __('<strong>http://vincentgarreau.com/particles.js</strong> You can tune particles there', 'poa-presentation-slides')
			// ),
   //          // CHECKBOX
			// array(
			// 	'name' => esc_html__( 'Use Particles.js? (moving objects) for background', 'poa-presentation-slides' ),
			// 	'id'   => $prefix . "particles",
			// 	'type' => 'checkbox',
			// 	// Value can be 0 or 1
			// 	'std'  => 0,
			// ),
			// // TEXTAREA
			// array(
			// 	'name' => esc_html__( 'Custom CSS for Particles.js', 'poa-presentation-slides' ),
			// 	'desc' => __('Get CSS on <strong>http://vincentgarreau.com/particles.js</strong>', 'poa-presentation-slides'),
			// 	'id'   => $prefix . "particles_css",
			// 	'type' => 'textarea',
			// 	'cols' => 20,
			// 	'rows' => 3,
			// ),
			// // TEXTAREA
			// array(
			// 	'name' => esc_html__( 'Custom JavaScript for Particles.js', 'poa-presentation-slides' ),
			// 	'desc' =>__('Get JavaScript on <strong>http://vincentgarreau.com/particles.js</strong>', 'poa-presentation-slides'),
			// 	'id'   => $prefix . "particles_js",
			// 	'type' => 'textarea',
			// 	'cols' => 20,
			// 	'rows' => 3,
			// ),
			// background color
			array(
				'type' => 'heading',
				'name' => esc_html__( 'Slide Background Color', 'poa-presentation-slides' )
			),
			// COLOR
			array(
				'name' => esc_html__( 'Select color', 'poa-presentation-slides' ),
				'id'   => $prefix . "background_color",
				'type' => 'color',
			),
			// background image
			array(
				'type' => 'heading',
				'name' => esc_html__( 'Full Background Image', 'poa-presentation-slides' )
			),
			// IMAGE ADVANCED (WP 3.5+)
			array(
				'name'             => esc_html__( 'Select image for background', 'poa-presentation-slides' ),
				'id'               => $prefix . "background_image",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'type' => 'heading',
				'name' => esc_html__( 'Full Background Video', 'poa-presentation-slides' )
			),
			// FILE ADVANCED (WP 3.5+)
			array(
				'name'             => esc_html__( 'Upload video for background', 'poa-presentation-slides' ),
				'id'               => $prefix . "background_video",
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => 'application,audio,video', // Leave blank for all file types
			),
			array(
				'name' => esc_html__( 'Or insert external source video code (Youtube, Vimeo, etc.)', 'poa-presentation-slides' ),
				'id'   => $prefix . "external_video",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'desc' => sprintf( wp_kses( __( 'Use embed code wich Video Hosting companies provide. <br/>For Youtube, read instructions <a href="%1s" target="_blank">HERE</a>, <br/>for Vimeo <a href="%3s" target="_blank">HERE</a>', 'poa-presentation-slides' ), array(  'br' => array(), 'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( 'https://support.google.com/youtube/answer/171780?hl=en' ), esc_url('https://help.vimeo.com/hc/en-us/articles/224969968-Embedding-videos-overview') )
			),
			array(
				'name' => esc_html__( 'Autoplay video?', 'poa-presentation-slides' ),
				'id'   => $prefix . "autoplay_video",
				'type' => 'checkbox',
				'std'  => 0,
				'desc' => esc_html__('If enabled video will start immediately when slide appears.', 'poa-presentation-slides')
			),        	
        ),
    );
    return $meta_boxes;
}



