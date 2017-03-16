<?php
add_filter('wp', 'poa_slides_template');

function poa_slides_template($query) {
    global $wp_query, $post;


    // echo '<pre>';
    // var_dump($wp_query->query);
    // // var_dump($query);
    // exit;

    if ( $wp_query->query['post_type'] == POA_POST_TYPE_NAME ) :
	?>

	<?php get_header(); ?>

	<div class="reveal" id="reveal">
		<div class="slides">
			<section>
				<h2 style="display: none"><?php echo __('Title', 'revealpresentation') ?></h2>
		
				<?php slides_loop(); ?>
		
				<section id="last"></section>
			</section>
		</div> <!-- .slides --> 
	</div><!-- .reveal -->

 	<?php get_footer(); ?>
 	<?php
 	endif; //if ( $post->post_type == POA_POST_TYPE_NAME )
}

