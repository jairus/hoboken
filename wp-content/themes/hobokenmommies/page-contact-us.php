<?php
/*
Template Name: Contact Us
*/
?>

<?php 
//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['comments']) === '') {
			$commentError = 'You forgot to enter your comments.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = 'info@mommies247.com';
			$subject = 'Hoboken Mommies 247 - '.$name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			if($sendCopy == true) {
				$subject = 'You emailed Your Name';
				$headers = 'From: Your Name <noreply@somedomain.com>';
				mail($email, $subject, $body, $headers);
			}

			$emailSent = true;

		}
	}
} ?>

<?php get_header() ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/contact-form.js"></script>

<div id="column-one">

<div id="box">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li><?php the_title(); ?></li>
</ul>
</div>
</div>

<h2><?php the_title(); ?></h2>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if(isset($emailSent) && $emailSent == true) { ?>

<div id="message" class="updated">
<p>Your email was successfully sent. We will be in touch soon.</p>
</div>

<?php } else { ?>

<?php the_content(); ?>
		
<?php if(isset($hasError) || isset($captchaError)) { ?>
<div id="message" class="updated">
<p>There was an error submitting your info to us.</p>
</div>
<?php } ?>

<div id="card-form">
	
<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
	
<p><label for="contactName">Name</label><br />
<input type="text" name="contactName" id="contactName" size="100" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField field" />
<?php if($nameError != '') { ?>
<span class="error"><?=$nameError;?></span> 
<?php } ?></p>
				
<p><label for="email">Email</label><br />
<input type="text" name="email" id="email" size="200" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email field" />
<?php if($emailError != '') { ?>
<span class="error"><?=$emailError;?></span>
<?php } ?></p

<p><label for="commentsText">Comments</label><br />
<textarea name="comments" id="commentsText" class="requiredField textfield"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
<?php if($commentError != '') { ?>
<span class="error"><?=$commentError;?></span> 
<?php } ?></p>

<input type="hidden" name="submitted" id="submitted" value="true" />

<p><input type="submit" id="submit" value="Send" /></p>

</form>

</div>

<div class="line-long"></div>

<p>For advertising opportunities, please email us at <a href="mailto:sarah@mommies247.com">sarah@mommies247.com</a>. For all other inquiries, contact us at <a href="mailto:info@mommies247.com">info@mommies247.com</a> or call 718-404-2565.</p>
	
<?php } ?>

</div><!-- #post -->

<?php endwhile; endif; ?>

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