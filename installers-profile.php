<?php
/*
	Template Name: Restricted Access: Installers Profile
*/

installer_user_check();

$current_user = wp_get_current_user();

$error = array();
$success = array();   
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
	
	//echo '<pre>'; print_r($_POST); echo '</pre>'; wp_die();
	
    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] ) {
        	wp_set_password( $_POST['pass1'], $current_user->ID );
            //wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
		 	$creds['user_login'] = $current_user->user_login;
			$creds['user_password'] = $_POST['pass1'];
			$creds['remember'] = true;
			$user = wp_signon( $creds, false );

            $success[] = __('Password updated', 'profile');
        } else {
            $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
        }
    }
    
    /* Update user information. */
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        elseif(	$_POST['email'] != $current_user->user_email ) {
	        if (email_exists(esc_attr( $_POST['email'] ))){
	            $error[] = __('This email is already used by another user.  try a different one.', 'profile');
	        } else {
	            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
	            $success[] = __('Email updated', 'profile');
	        }
        }
    }
    
    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
        $success[] = __('First Name updated', 'profile');
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
        $success[] = __('Last Name updated', 'profile');
    if ( !empty( $_POST['telephone'] ) )
        update_user_meta($current_user->ID, 'telephone', esc_attr( $_POST['telephone'] ) );
        $success[] = __('Telephone updated', 'profile');
    if ( !empty( $_POST['mobile'] ) )
        update_user_meta($current_user->ID, 'mobile', esc_attr( $_POST['mobile'] ) );
        $success[] = __('Mobile updated', 'profile');
    
}

get_header();
?>

		<?php include('installers-nav.php'); ?>

			<div id="main" class="offset">
				<div id="content">
					  
					<div class="installers-conent">
						
						<?php 
							if ($error) {
								echo '<div class="errors">';
									foreach ($error as $theerror) {
										echo '<p>'.$theerror.'</p>';
									}
								echo '</div>';
							} elseif ($success) {
								echo '<div class="success">';
								echo '<p>Your Profile has been updated successfully!</p>';
								echo '</div>';
							}
						?>
						
						<div class="feedback profile">
							<form method="post">
							
								<div class="field">
									<label for="first-name"><?php _e('First Name', 'profile'); ?></label>
									<input class="text" name="first-name" type="text" id="first-name" value="<?php echo get_user_meta( $current_user->ID, 'first_name', true ); ?>" />
								</div>
								
								<div class="field">
									<label for="last-name"><?php _e('Last Name', 'profile'); ?></label>
									<input class="text" name="last-name" type="text" id="last-name" value="<?php echo get_user_meta( $current_user->ID, 'last_name', true ); ?>" />
								</div>
								
								<div class="field">
									<label for="email"><?php _e('E-mail *', 'profile'); ?></label>
									<input class="text" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
								</div>
								
								<div class="field">
									<label for="telephone"><?php _e('Telephone', 'profile'); ?></label>
									<input class="text" name="telephone" type="text" id="telephone" value="<?php echo get_user_meta( $current_user->ID, 'telephone', true ); ?>" />
								</div>
								
								<div class="field">
									<label for="mobile"><?php _e('Mobile', 'profile'); ?></label>
									<input class="text" name="mobile" type="text" id="mobile" value="<?php echo get_user_meta( $current_user->ID, 'mobile', true ); ?>" />
								</div>
								
								<div class="field">
									<label for="pass1"><?php _e('Password *', 'profile'); ?> </label>
									<input class="text" name="pass1" type="password" id="pass1" />
								</div>
								
								<div class="field">
									<label for="pass2"><?php _e('Repeat Password *', 'profile'); ?></label>
									<input class="text" name="pass2" type="password" id="pass2" />
								</div>
			
								<div class="field">
				                    <input name="updateuser" type="submit" id="updateuser" class="btn-submit" value="<?php _e('Update', 'profile'); ?>" />
				                    <?php wp_nonce_field( 'update-user' ) ?>
				                    <input name="action" type="hidden" id="action" value="update-user" />
								</div>
							
							</form>
						</div>

						
					</div>

				</div>
				

			</div><!-- /main -->
<?php get_footer();?>