<?php

//**Set up custom post type
function zlp_cpt() {
	register_post_type( 'zap', array(  
		'labels' => array(    'name' => 'Zaps',    
			'singular_name' => 'Zap',   ),  
		'description' => 'Posts to the Zaplog',  
		'public' => true,  
		'menu_position' => 8,  
		'menu_icon' => 'dashicons-rss', 
		'supports' => array( 'title', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields'),  
		'has_archive' => 'true')
	);
}
add_action( 'init', 'zlp_cpt' );

function zlp_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    zlp_cpt_init();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'zlp_rewrite_flush' );