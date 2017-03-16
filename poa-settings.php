<?php 
/**
 * Создаем страницу настроек плагина
 */
add_action('admin_menu', 'add_plugin_page');

function add_plugin_page(){
	add_options_page( 'Presentation Slides Settings', '	♦ Slides ♦', 'manage_options', 'ps_settings', 'presentation_slides_options_page_output' );
}

function presentation_slides_options_page_output(){
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>

		<form action="options.php" method="POST" id="ps_settings_form">
			<?php
				settings_fields( 'option_group' );     // скрытые защитные поля
				do_settings_sections( 'poa_ps_page' ); // секции с настройками (опциями). У нас она всего одна 'section_id'
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Регистрируем настройки.
 * Настройки будут храниться в массиве, а не одна настройка = одна опция.
 */
add_action('admin_init', 'plugin_settings');
function plugin_settings(){
	// параметры: $option_group, $option_name, $sanitize_callback
	register_setting( 'option_group', 'poa_option_name', 'sanitize_callback' );

	// параметры: $id, $title, $callback, $page
	add_settings_section( 'poa_section_id', 'Main settings', '', 'poa_ps_page' ); 

	// параметры: $id, $title, $callback, $page, $section, $args
	add_settings_field('poa_enable_autoslide', 'Enable autoslide', 'poa_enable_autoslide_field', 'poa_ps_page', 'poa_section_id' );
	add_settings_field('poa_enable_continuous_loop', 'Enable Slides continuous loop', 'poa_enable_continuous_loop_field', 'poa_ps_page', 'poa_section_id' );
	add_settings_field('poa_background_text', 'Background Title Text', 'poa_background_text_field', 'poa_ps_page', 'poa_section_id' );
	// add_settings_field('poa_enable_navigation', 'Enable Key Slides Navigation', 'poa_enable_navigation_field', 'poa_ps_page', 'poa_section_id' );
	// add_settings_field('poa_position_navigation', 'Slides Navigation Position', 'poa_position_navigation_field', 'poa_ps_page', 'poa_section_id' );
	add_settings_field('poa_nav_menus', 'Select your website main navigation to display on Slides page', 'poa_nav_menus_field', 'poa_ps_page', 'poa_section_id' );
	add_settings_field('poa_slides_transition', 'Slides Transition', 'poa_slides_transition_field', 'poa_ps_page', 'poa_section_id' );
}

function poa_enable_autoslide_field(){
	$val = get_option('poa_option_name');
	$val = isset($val['poa_enable_autoslide']) ? $val['poa_enable_autoslide'] : 0;
	?>
	<div class="checkbox-button">
		<input id="enable-autoslide" type="checkbox" class="checkbox" name="poa_option_name[poa_enable_autoslide]" value="1" <?php checked( 1, $val ) ?> />
		<label for="enable-autoslide">
			<?php echo esc_html__('By default autoslide time is 15 seconds. You can set time for each slide in Dashboard -> Slides -> Edit.', 'poa-presentation-slides'); ?>
		</label>
	</div>
	<?php
}

function poa_enable_continuous_loop_field(){
	$val = get_option('poa_option_name');
	$val = isset($val['poa_enable_continuous_loop']) ? $val['poa_enable_continuous_loop'] : 0;
	?>
	<div class="checkbox-button">
		<input id="enable-loop" type="checkbox" class="checkbox" name="poa_option_name[poa_enable_continuous_loop]" value="1" <?php checked( 1, $val ) ?> />
		<label for="enable-loop">
		<?php echo esc_html__('Option works only if autoslide enabled. It creates continuous loop of slides.', 'poa-presentation-slides'); ?>
		</label>
	</div>
	<?php
}

function poa_background_text_field() {
	$val = get_option('poa_option_name');
	$val = isset($val['poa_background_text']) ? $val['poa_background_text'] : '';
	?>
	<div class="checkbox-button">
		<input type="text" class="setting-textfield" name="poa_option_name[poa_background_text]" value="<?php echo $val; ?>" />
		<label>
		<?php echo esc_html__('Background Text when slides change.', 'poa-presentation-slides'); ?>
		</label>
	</div>
	<?php	
}

/*
function poa_enable_navigation_field() {
	$val = get_option('poa_option_name');
	$val = isset($val['poa_enable_navigation']) ? $val['poa_enable_navigation'] : 0;
	?>
	<div class="checkbox-button">
		<input id="enable-nav" type="checkbox" class="checkbox" name="poa_option_name[poa_enable_navigation]" value="1" <?php checked( 1, $val ) ?> />
		<label for="enable-nav">
		<?php echo esc_html__('Create navigation in Dashboard -> Appearance -> Menus and check Display location like "Slides"', 'poa-presentation-slides'); ?>
		</label>
	</div>
	<?php
}

function poa_position_navigation_field() {
	$val = get_option('poa_option_name');
	$val = isset($val['poa_position_navigation']) ? $val['poa_position_navigation'] : '0';
	?>
	<div class="checkbox-button">
		<select name="poa_option_name[poa_position_navigation]" id="position-nav" <?php if ($val != '0') : echo 'style="display: block;"'; endif; ?>>
			<option value="0"><?php echo esc_html__('Select position...', 'poa-presentation-slides'); ?></option>
			<option value="top" <?php if ($val == 'top') : ?>selected<?php endif; ?>>Top</option>
			<option value="bottom" <?php if ($val == 'bottom') : ?>selected<?php endif; ?>>Bottom</option>
			<option value="left" <?php if ($val == 'left') : ?>selected<?php endif; ?>>Left</option>
			<option value="right" <?php if ($val == 'right') : ?>selected<?php endif; ?>>Right</option>
		</select>
		<label for="position-nav">
		<?php echo esc_html__('Current position of navigation (first enable navigation)', 'poa-presentation-slides'); ?>
		</label>
	</div>
	<?php
}
*/

function poa_slides_transition_field() {
	$val = get_option('poa_option_name');
	$val = isset($val['poa_slides_transition']) ? $val['poa_slides_transition'] : '0';
	?>
	<div class="checkbox-button">
		<select name="poa_option_name[poa_slides_transition]" id="slides_transition" <?php if ($val != '0') : echo 'style="display: block;"'; endif; ?>>
			<option value="none" <?php if ($val == 'none') : ?>selected<?php endif; ?>>No transition</option>
			<option value="slide" <?php if ($val == 'slide') : ?>selected<?php endif; ?>>Slide</option>
			<option value="fade" <?php if ($val == 'fade') : ?>selected<?php endif; ?>>Fade</option>
			<option value="convex" <?php if ($val == 'convex') : ?>selected<?php endif; ?>>Convex</option>
			<option value="concave" <?php if ($val == 'concave') : ?>selected<?php endif; ?>>Concave</option>
			<option value="zoom" <?php if ($val == 'zoom') : ?>selected<?php endif; ?>>Zoom</option>
		</select>
		<label for="slides_transition">
		<?php echo esc_html__('Transition between slides (same transition for all slides)', 'poa-presentation-slides'); ?>
		</label>
	</div>
	<?php	
}

function poa_nav_menus_field() {
	$val = get_option('poa_option_name');
	$val = isset($val['poa_nav_menus']) ? $val['poa_nav_menus'] : '0';

	$menus = get_registered_nav_menus();
	?>
	<div class="checkbox-button">
		<select name="poa_option_name[poa_nav_menus]" id="nav_menus" <?php if ($val != '0') : echo 'style="display: block;"'; endif; ?>>
			<option value=""><?php echo __("No main navigation", 'poa-presentation-slides'); ?></option>
			<?php foreach ($menus as $location => $description) : ?>
			<option value="<?php echo $location; ?>" <?php if ($val == $location) : ?>selected<?php endif; ?>><?php echo $description; ?></option>
			<?php endforeach; ?>
		</select>
		<label for="slides_transition">
		<?php echo esc_html__('Select your main navigation menu to display for slides page', 'poa-presentation-slides'); ?>
		</label>
	</div>
	<?php	}

## Очистка данных
function sanitize_callback( $options ){ 
	// очищаем
	foreach( $options as $name => & $val ){
		if( $name == 'input' )
			$val = strip_tags( $val );

		if( $name == 'checkbox' )
			$val = intval( $val );
	}

	//die(print_r( $options )); // Array ( [input] => aaaa [checkbox] => 1 )

	return $options;
}