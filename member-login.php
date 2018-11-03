<?php
get_header();
?>

			<div id="main">
				<div class="form-area">
					<div class="feedback">
						
						<?php if (isset($_GET['login']) && $_GET['login'] == 'no') : ?>
							<p class="error"><strong>Sorry!</strong> Your username or password was not recognised.</p>
						<?php endif; ?>
						
						<form name="loginform" id="loginform" action="<?php bloginfo('url') ?>/wp-login.php" method="post">

							<fieldset>
								<label for="lbl-01">Username</label>
								<input class="text" type="text" id="lbl-01" name="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>">
								<label for="lbl-02">Password</label>
								<input class="text" type="password" id="lbl-02" name="pwd">
								<div class="btn-holder">
									<input id="lbl-03" class="chk" type="checkbox" name="rememberme" value="forever">
									<label for="lbl-03">Remember Me</label>
									<input class="btn-submit btn btn-submit" type="submit" name="wp-submit" value="Log In">
								</div>
								<?php do_action('login_form'); ?>
								<input type="hidden" name="user-cookie" value="1" />
							</fieldset>
						</form>
			
			

					</div>
				</div>
			</div><!-- /main -->
			
<?php get_footer();?>