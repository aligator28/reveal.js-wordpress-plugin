<?php get_header(); ?>

<div class="preloader" id="poa-plugin-preloader">
	<div class="cssload-wrap">
		<div class="cssload-cssload-spinner"></div>
	</div>
</div>

<div class="poa-reveal" id="poa-reveal">
	<header>
		<?php 
			if ( !empty(get_option('poa_option_name')['poa_nav_menus']) ) : 
				$location = get_option('poa_option_name')['poa_nav_menus']; 
		?>
			<button class="toggle_mnu" id="main-nav-button">
				<span id="sandwich" class="sandwich">
				  <span class="sw-topper"></span>
				  <span class="sw-bottom"></span>
				  <span class="sw-footer"></span>
				</span>
			</button>
			<nav class="main-nav-container" id="main-nav-container">
				<?php
					wp_nav_menu( array(
						'theme_location'  => $location,
						'menu'            => '', 
						'container'       => 'div', 
						'container_class' => '', 
						'container_id'    => '',
						'menu_class'      => 'menu', 
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => '',
					) );
				?>		
			</nav>
		<?php endif; ?>

		<?php /* if ( !empty(get_option('poa_option_name')['poa_enable_navigation']) && get_option('poa_option_name')['poa_enable_navigation'] == 1 ) : 
			$position = !empty(get_option('poa_option_name')['poa_position_navigation']) ? get_option('poa_option_name')['poa_position_navigation'] : 'top';
			$position = esc_html($position);

			// check if 'slidesmenu' exists
			$locations = get_nav_menu_locations();
			if ( empty($locations['slidesmenu']) ) :
		?>
		<div class="menu-slides-error">
			<h2>
				<?php echo esc_html__("Menu for Slides doesn't exist. Go to Dashboard->Appearance->Menus and create new Navigation Menu for slides. Also check 'Display location' like Slides Menu.", 'poa-presentation-slides') ?>
			</h2>
		</div>

			<?php else : ?>

			<nav class="main-nav-container" id="slides-nav-container" <?php poa_position_nav($position); ?>>
				<?php 
				wp_nav_menu( array(
					'theme_location'  => 'slidesmenu',
					'menu'            => '', 
					'container'       => 'div', 
					'container_class' => '', 
					'container_id'    => '',
					'menu_class'      => 'menu', 
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => '',
				) );
				?>
			</nav>
		<?php	endif; //if ( empty($locations['slidesmenu']) ) :
		endif; //if ( !empty(get_option('poa_option_name')... 
		*/ ?>
	</header>
	<?php
		$bg_text = !empty(get_option('poa_option_name')['poa_background_text']) ? get_option('poa_option_name')['poa_background_text'] : ''; 
	?>
	<h2 class="reveal-bg-title"><?php echo $bg_text; ?></h2>
	<div class="slides">
		<section>
			<h2 style="display: none"><?php echo esc_html__('Title', 'poa-presentation-slides') ?></h2>
		<?php
		while ( $slides_loop->have_posts() ) : $slides_loop->the_post();

			if ( empty( rwmb_meta('reveal_use_slide') ) 
				&& rwmb_meta('reveal_use_slide') == 0 ) {
				continue;
			}
			if( file_exists( POA_PLUGIN_DIR . '/templates/slides.php' ) ) {

				include POA_PLUGIN_DIR . '/templates/slides.php';
			}

		endwhile;
		?>
		</section>
	</div> <!-- .slides --> 
</div> <!-- .reveal -->

<?php get_footer(); ?>