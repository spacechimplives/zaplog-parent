<?php

//**Post Handler
add_action( 'admin_post_post_zap', 'zlp_admin_post_zap' );
//this next action version allows users not logged in to submit requests

//if you want to have both logged in and not logged in users submitting, you have to add both actions!

add_action( 'admin_post_nopriv_post_zap', 'zlp_admin_post_zap' );


function zlp_admin_post_zap() {
//if ( empty($_POST) || !wp_verify_nonce('post_zap') ) {
//	wp_send_json_error();
//	die();
//} else {



	$zlp_zap_name = $_REQUEST['name'];
	$zlp_post_url = $_REQUEST['purl'];
	$zlp_user_key = $_REQUEST['key'];
	$zlp_post_excerpt = $_REQUEST['excerpt'];
//	$zlp_post_burl = lookup from key
//check purl versus burl, if bad, die with unauthorized, else

//If good, check against whitelist & origin??
	
	
//if purl exists (in zap), die with bad request, else make zap
//author == Blog Name

	$zap = array(
  'post_name'      => $zlp_zap_name, // The name (slug) for your post
  'post_title'     => $zlp_zap_name, // The title of your post.
  'post_status'    => 'pending', // ****CHANGE IF AUTOPUBLISH.
  'post_type'      => 'zap',
  'post_excerpt'   => $zlp_post_excerpt // For all your post excerpt needs.
);  
	
	$post_id = wp_insert_post( $zap, $wp_error );
	
	//**insert/update meta for purl and burl
	
    status_header(200);
    die();
    //request handlers should die() when they complete their task
//}
}



