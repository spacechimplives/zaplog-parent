<?php

function fb_add_custom_user_profile_fields( $user ) {
	$domain = get_user_meta( $user->ID,'domain',  true );
	$key = get_user_meta( $user->ID,'key',  true );
	if ( $domain!=null && $key == null ){
		$key = uniqid();
		update_usermeta( $user->ID, 'key', $key );
	}
	
?>
	<h3><?php _e('Zaplog Connection Information', 'zaplog'); ?></h3>
	
	<table class="form-table">
		<tr>
			<th>
				<label for="domain"><?php _e('Child Blog URL', 'zaplog'); ?>
			</label></th>
			<td>
				<input type="text" name="domain" id="domain" value="<?php echo esc_url( get_user_meta(  $user->ID, 'domain', true ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your domain.', 'zaplog'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="key"><?php _e('Key', 'zaplog'); ?>
			</label></th>
			<td>
				<input type="text" name="key" id="key" value="<?php echo esc_attr( get_user_meta(  $user->ID,'key', true ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Your Key.', 'zaplog'); ?></span>
			</td>
		</tr>
	</table>
<?php }

function fb_save_custom_user_profile_fields( $user_id ) {
	
	if ( !current_user_can( 'edit_user', $user_id ) )
		return FALSE;
	
	update_user_meta( $user_id, 'domain', $_POST['domain'] );
}

add_action( 'show_user_profile', 'fb_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'fb_add_custom_user_profile_fields' );

add_action( 'personal_options_update', 'fb_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'fb_save_custom_user_profile_fields' );