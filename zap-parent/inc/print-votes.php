<?php

function zap_and_votes( $atts ) {
	wp_localize_script('zap-votes', 'ajax_var', array(
    'url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('zap_vote')
));


    $a = shortcode_atts( array(
        'zap' => '14'
    ), $atts );

	$zapid = $a['zap'];
	$output = '<div class="votes">';
//	$url = wp_nonce_url(admin_url('admin-ajax.php?action=zap_vote&zapid='.$zapid.'&vote=up'));
	$output .= '<a class="upvote" data-zap-id="'.$zapid.'" href="#">+</a>';
	$output .= '      ';
	$output .= '<a class="downvote" data-zap-id="'.$zapid.'" href="#">-</a>';
	$output .= '</div>';
	

    return $output;
	

}
add_shortcode( 'zapvote', 'zap_and_votes' );

wp_enqueue_script('zap-votes', plugin_dir_url( __FILE__ ).'../js/zapparent.js', array('jquery'), '1.0', true );

function zlc_print_votes( $zapid ) {
	wp_localize_script('zap-votes', 'ajax_var', array(
    'url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('zap_vote')
	));

//validate $zapid -- check for post	
	$output = '<div class="votes">';
//	$url = wp_nonce_url(admin_url('admin-ajax.php?action=zap_vote&zapid='.$zapid.'&vote=up'));
	$output .= '<a class="upvote" data-zap-id="'.$zapid.'" href="#">+</a>';
	$output .= '      ';
	$output .= '<a class="downvote" data-zap-id="'.$zapid.'" href="#">-</a>';
	$output .= '</div>';
	

    return $output;
	

}
add_shortcode( 'zapvote', 'zap_and_votes' );

wp_enqueue_script('zap-votes', plugin_dir_url( __FILE__ ).'../js/zapparent.js', array('jquery'), '1.001', true );


