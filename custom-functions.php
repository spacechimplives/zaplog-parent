<?php

// Filter to replace the template of the home page
//add_filter( 'template_include', 'zlp_zap_list' );
function zlp_zap_list( $template ) {
  if ( is_front_page() ) {
    return plugin_dir_path( __FILE__ ) . 'templates/front-page.php';
  }
  return $template;
}
	

	
//**Set up custom post type
//function zlp_cpt() {
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
//}
//add_action( 'init', 'zlp_cpt' );

//**Add tables
//add usermeta (keys & domains)

//**Add Meta Fields
//burl & purl
//Add meta boxes to display votes



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







//**Vote handler
function zlp_vote_to_db($zap_id, $user_id, $vote){
	$table_name = $wpdb->prefix.'foq_zlp_db';
	global $wpdb;

	 $wpdb->show_errors();
	
	$updated = $wpdb->insert( 
		$table_name, 
		array( 
		'zapid' => $zap_id, 
		'user' => $user_id,
		'vote' => $vote
		), 
		array( 
		'%s', 
		'%d',
		'%d'
		) 
	);
	if ($updated){
		return 'success';
	} else {
		return 'no insert'.'&'.$zap_id.'&'.$user_id.'&'.$vote;
	}	
}
add_action('wp_ajax_zap_vote', 'zlp_vote_ajax_post');
function zlp_vote_ajax_post(){
	$nonce = $_REQUEST['nonce'];
	if ( empty($_POST) || !wp_verify_nonce($nonce,'zap_vote') ) {
		wp_send_json_error('unauthorized');
		die();
	} else {
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
		$zap_id = $_REQUEST['zapid'];
		$vote = $_REQUEST['vote'];
		$response = zlp_vote_to_db($zap_id, $user_id, $vote);
		if ($response == 'success' && $current_user!=null){	
			wp_send_json_success(203);
			die();
		} else {
			wp_send_json_error($response);
			die();
		}
	}	
}


//**Output zap row
//<tr id=zapid><td class=votes>
//get votes (get from votetable where zap = zapid, sum votes)
//do voting buttons w/ nonces
//</td><td> Excerpt linked to URL</td>
//<td> Mobbr buttons</td>
//</tr>
function zap_and_votes( $atts ) {
	wp_localize_script('zapvote', 'ajax_var', array(
    'url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('zap_vote')
));
    $a = shortcode_atts( array(
        'zap' => '14'
    ), $atts );

	$zapid = $a['zap'];
	$output = '';
//	$url = wp_nonce_url(admin_url('admin-ajax.php?action=zap_vote&zapid='.$zapid.'&vote=up'));
	$output .= '<a class="zapvote" data-vote-type="1" data-zap-id="'.$zapid.'" href="#">+</a>';
	$output .= '      ';
	$output .= '<a class="zapvote" data-vote-type="-1" data-zap-id="'.$zapid.'" href="#">-</a>';
	$output .= '<script type="text/javascript" src="'.get_template_directory_uri().'/js/zapparent3.js">';
$script = <<<'SCR'

SCR;
	$data = array(
    'url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('zap_vote')
);
	$output .= '</script><script type="text/javascript">var ajaxData = '.json_encode($data).';';
	$output .= $script;
	$output .= '</script>';
	

    return $output;
	

}
add_shortcode( 'zapvote', 'zap_and_votes' );





//**Settings Menu
//Autopublish Zaps?
//Blacklist (from list of all zappers)
//Frontpage Algorithms
