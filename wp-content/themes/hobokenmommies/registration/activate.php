<?php get_header() ?>

<div id="column-one">

<div id="box">

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li>Activate</li>
</ul>
</div>
</div>

<div id="login">

			<?php if ( bp_account_was_activated() ) : ?>

				<h2>Success!</h2>
				<div id="register-progress-bar" class="step-3">Step 3 of 3</div>
				
				<?php do_action( 'template_notices' ) ?>

				<?php if ( isset( $_GET['e'] ) ) : ?>
					<p class="instructions"><?php _e( 'Your account was activated successfully! Your account details have been sent to you in a separate email.', 'buddypress' ) ?></p>
				<?php else : ?>
					<p class="instructions"><?php _e( 'Your account was activated successfully! You can now log in with the username and password you provided when you signed up.', 'buddypress' ) ?></p>
					
					<div id="login-box">
				
						<form name="login-form" id="sidebar-login-form" class="standard-form register-section" action="<?php echo site_url( 'wp-login.php', 'login_post' ) ?>" method="post">
							<label><?php _e( 'Username', 'buddypress' ) ?><br />
							<input type="text" name="log" id="sidebar-user-login" class="input" value="<?php echo esc_attr(stripslashes($user_login)); ?>" /></label>
				
							<label><?php _e( 'Password', 'buddypress' ) ?><br />
							<input type="password" name="pwd" id="sidebar-user-pass" class="input" value="" /></label>
				
							<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" /> <?php _e( 'Remember Me', 'buddypress' ) ?></label></p>
				
							<?php do_action( 'bp_sidebar_login_form' ) ?>
							<p class="submit">
								<input type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php _e('Log In'); ?>" tabindex="100" />
							</p>
							<input type="hidden" name="testcookie" value="1" />
						</form>
					
					</div>
					
				<?php endif; ?>

			<?php else : ?>

				<h2><?php _e( 'Activate your Account', 'buddypress' ) ?></h2>
				
				<form action="" method="get" class="standard-form register-section" id="activation-form">

					<label for="key"><?php _e( 'Activation Key:', 'buddypress' ) ?></label>
					<input type="text" name="key" id="key" value="" />

					<p class="submit">
						<input type="submit" name="submit" value="<?php _e( 'Activate', 'buddypress' ) ?>" />
					</p>

				</form>
							

			<?php endif; ?>

			<?php do_action( 'bp_after_activate_content' ) ?>
		
</div><!-- #login -->


</div><!-- #box -->

</div><!-- #column-one -->

<div id="column-two">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('welcome') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('adspages') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('recent') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('groups') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('topics') ) : ?><?php endif; ?>		

</div><!-- #column-two -->


<?php get_footer(); ?>