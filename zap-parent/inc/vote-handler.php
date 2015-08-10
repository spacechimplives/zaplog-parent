<?php

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