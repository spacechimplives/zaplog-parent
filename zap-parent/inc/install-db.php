<?php

function zlp_db_install() {
	global $zlp_db_version;
	$zlp_db_version = '1.0';
	global $wpdb;
	global $table_prefix;
	global $zlp_db_version;

	$table_name = $table_prefix.'zlp_db';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		zapid mediumint(9) NOT NULL,
		user mediumint(9) NOT NULL,
		vote tinyint(3) NOT NULL,
		PRIMARY KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'zlp_db_version', $zlp_db_version );
}

function zlp_install_data() {
	global $wpdb;
	
	$zapid = 1;
	$user = 1;
	$vote = 'up';
	
	$table_name = $$table_prefix.'zlp_db';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'zapid' => $zapid, 
			'user' => $user, 
			'vote' => $vote,
		) 
	);
}
register_activation_hook( __FILE__, 'zlp_db_install' );
register_activation_hook( __FILE__, 'zlp_install_data' );