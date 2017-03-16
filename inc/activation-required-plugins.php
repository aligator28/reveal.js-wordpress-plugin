<?php

add_action( 'tgmpa_register', 'poa_register_required_plugins' );
// add_action( 'plugins_loaded', 'poa_register_required_plugins' );

function poa_register_required_plugins() {

// global $wp_version;
// exit($wp_version);

    $plugins = array(
        array(
            'name'      => 'Page Builder',
            'slug'      => 'pagebuilder',
            'required'  => false,
            'force_activation' => false,
            'source' => 'https://downloads.wordpress.org/plugin/siteorigin-panels.2.4.24.zip',
            'path'=>'pagebuilder/siteorigin-panels.php',
            'function_or_class' => 'function',
            'function_class_name' => 'siteorigin_panels_activate'
        ),
        array(
            'name'      => 'Meta Box',
            'slug'      => 'metabox',
            'required'  => true,
            'force_activation' => true,
            'source' => 'https://downloads.wordpress.org/plugin/meta-box.4.10.1.zip',
            'path'=>'metabox/meta-box.php',
            'function_or_class' => 'function',
            'function_class_name' => 'rwmb_meta'
        ),
        array(
            'name'      => 'Mega Menu',
            'slug'      => 'maxmegamenu',
            'required'  => false,
            'force_activation' => false,
            'source' => 'https://downloads.wordpress.org/plugin/megamenu.2.3.5.zip',
            'path' => 'megamenu/megamenu.php',
            'function_or_class' => 'class',
            'function_class_name' => 'Mega_Menu'
        ),
    );

    $plugins_to_istall = array();

    foreach($plugins as $key => $aPlugin) {
        // Check if plugin exists
        if ($aPlugin['function_or_class'] == 'class') {
            if ( class_exists( $aPlugin['function_class_name'] ) ) {
                // echo $aPlugin['name'] . ' -----<br/>';
                continue;
            }
        }
        elseif ($aPlugin['function_or_class'] == 'function') {
            if ( function_exists( $aPlugin['function_class_name'] ) ) {
                // echo  $aPlugin['name'] . '<br>';
                continue;
            }
        }
        // else /*( !is_plugin_active( $aPlugin['path'] ) )*/ {
            $plugins_to_istall[$key]['name'] = $aPlugin['name'];
            $plugins_to_istall[$key]['slug'] = $aPlugin['slug'];
            $plugins_to_istall[$key]['required'] = $aPlugin['required'];
            if ( !empty($aPlugin['force_activation']) ) {
                $plugins_to_istall[$key]['force_activation'] = $aPlugin['force_activation'];
            }
            if (!empty($aPlugin['source'])) {
                $plugins_to_istall[$key]['source'] = $aPlugin['source'];
            }
        // }
    }

// echo '<pre>';
// var_dump($plugins_to_istall);
// exit;

    $config = array(
        'id'           => 'poa-presentation-slides',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa( $plugins_to_istall, $config );











//     $plugin_messages = array();
//     $aRequired_plugins = array();

//     // include_once( ABSPATH . 'wp-admin/includes/plugin.php' );//removed to functions.php

//     $aRequired_plugins = array(
//         array(
//                 'name'=>'Contact Form 7', 
//                 'download'=>'https://wordpress.org/plugins/contact-form-7/', 
//                 'path'=>'contact-form-7/wp-contact-form-7.php'
//             ),
//     	array(
// 	    		'name'=>'Meta Box', 
// 	    		'download'=>'https://wordpress.org/plugins/meta-box/', 
// 	    		'path'=>'meta-box/meta-box.php'
//     		),
//         array(
//                 'name'=>'Options Framework', 
//                 'download'=>'https://wordpress.org/plugins/options-framework/', 
//                 'path'=>'options-framework/options-framework.php'
//             ),    );

    
//     foreach($aRequired_plugins as $aPlugin){
//         // Check if plugin exists
//         if(!is_plugin_active( $aPlugin['path'] ))
//         {
//             $plugin_messages[] = '<div id="message" class="notice notice-error is-dismissible"><p style="background-color: #dc3232; padding: 5px 20px; width: 50%; color: #f9f9f9">
//             This theme requires you to install the ' . $aPlugin['name'] . ' plugin.</p> 
//             Go to Plugins->Add New->Search plugins and type ' . $aPlugin['name'] . ', or download it from <strong><a href=' . $aPlugin['download'] . '>here</a></strong><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
//         }
//     }

//     if (count($plugin_messages) > 0)
//     {
//         echo '
// ';

//             foreach($plugin_messages as $message)
//             {
//                 echo '<h2>
// '.$message.'

// </h2>';
//             }

//         echo '
// ';
//     }

}