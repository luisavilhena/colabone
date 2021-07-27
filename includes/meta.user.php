<?php

add_action( 'show_user_profile', 'katharine_extra_profile_fields' );
add_action( 'edit_user_profile', 'katharine_extra_profile_fields' );

function katharine_extra_profile_fields( $user ) {
	?>
	<h3>Extra social information</h3>
	<table class="form-table">
		<tr>
			<th><label for="facebook">Facebook</label></th>
			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Facebook username.</span>
			</td>
		</tr>
		<tr>
			<th><label for="twitter">Twitter</label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Twitter username.</span>
			</td>
		</tr>
		<tr>
			<th><label for="Tumblr">Tumblr</label></th>
			<td>
				<input type="text" name="tumblr" id="tumblr" value="<?php echo esc_attr( get_the_author_meta( 'tumblr', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Tumblr username.</span>
			</td>
		</tr>
		<tr>
			<th><label for="gplus">Google+</label></th>
			<td>
				<input type="text" name="gplus" id="gplus" value="<?php echo esc_attr( get_the_author_meta( 'gplus', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Google+ username.</span>
			</td>
		</tr>
	</table>
	<?php
}


add_action( 'personal_options_update', 'katharine_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'katharine_save_extra_profile_fields' );

function katharine_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) ){
		return false;
	}

	update_user_meta( $user_id, 'facebook', esc_attr($_POST['facebook']) );
	update_user_meta( $user_id, 'twitter', esc_attr($_POST['twitter']) );
	update_user_meta( $user_id, 'tumblr', esc_attr($_POST['tumblr']) );
	update_user_meta( $user_id, 'gplus', esc_attr($_POST['gplus']) );
}

?>