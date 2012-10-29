<?php
/*
Template Name: Contribute Childcare
*/
?>

<?php
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {


$title 							= $_POST['title'];
$description 					= $_POST['description'];
$author 						= $_POST['author'];
$ecpt_childcarefullname 		= $_POST['ecpt_childcarefullname'];
$ecpt_childcareusername 		= $_POST['ecpt_childcareusername'];
$ecpt_childcareemail 			= $_POST['ecpt_childcareemail'];
$ecpt_childcarecategory 		= $_POST['ecpt_childcarecategory'];
$ecpt_childcarecontact 			= $_POST['ecpt_childcarecontact'];

$subject = "New Childacre";
$message = "A New Childcare was submitted on the website. Login to http://www.hobokenmommies.com/wp-admin/ and review the submission.";
$recipient = get_bloginfo('admin_email');
mail($recipient, $subject, $message);

$new_post = array(
'post_title'				=>	$title,
'post_content'				=>	$description,
'post_author' 				=> 	$author,
'post_status'				=>	'draft',
'post_type'					=>	'childcare',
'ecpt_childcarefullname'	=>	$ecpt_childcarefullname,
'ecpt_childcareusername'	=>	$ecpt_childcareusername,
'ecpt_childcareemail'		=>	$ecpt_childcareemail,
'ecpt_childcarecategory'	=>	$ecpt_childcarecategory,
'ecpt_childcarecontact'		=>	$ecpt_childcarecontact
);

$pid = wp_insert_post($new_post);

wp_set_post_tags($pid, $_POST['post_tags']);

wp_redirect( '/contribute/thanks/');

add_post_meta($pid, 'ecpt_childcarefullname', $ecpt_childcarefullname, true);
add_post_meta($pid, 'ecpt_childcareusername', $ecpt_childcareusername, true);
add_post_meta($pid, 'ecpt_childcareemail', $ecpt_childcareemail, true);
add_post_meta($pid, 'ecpt_childcarecategory', $ecpt_childcarecategory, true);
add_post_meta($pid, 'ecpt_childcarecontact', $ecpt_childcarecontact, true);

}

do_action('wp_insert_post', 'wp_insert_post');

?>

<?php get_header() ?>

<div id="column-one">
<div id="box">

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li><a href="<?php echo site_url() ?>/contribute/">Contribute</a></li>
<li>New Childcare</li>
</ul>
</div>
</div>

<h2>request / offer a childcare service</h2>

<p>Hello <a href="<?php echo bp_loggedin_user_domain() ?>profile"><?php echo bp_get_user_firstname() ?></a>. Please provide the following information and send it over to us. All Childcare submissions are carefully reviewed by our Mommy experts before being made live on our site.</p>

<div class="line-long-home"></div>

<div id="card-form">

<?php if ( is_user_logged_in() ) : ?>
<?php global $bp, $current_user; ?>
<?php $authorid = $bp->loggedin_user->id; ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<form id="new_post" name="new_post" method="post" action="">

<h3>Childcare Info</h3>

<input type="hidden" name="ecpt_childcareusername" id="ecpt_childcareusername" class="field" value="<?php echo $current_user->user_login; ?>" />
<input type="hidden" name="ecpt_childcareemail" id="ecpt_childcareemail" class="field" value="<?php echo $current_user->user_email; ?>" />

<p><label>Your Name</label><br />
<input type="text" id="ecpt_childcarefullname" name="ecpt_childcarefullname" class="field" size="80" value="<?php echo $current_user->display_name; ?>" /></p>

<p><input type="radio" name="ecpt_childcarecategory" id="ecpt_childcarecategory" value="Offering" />Offering Service <input type="radio" name="ecpt_childcarecategory" id="ecpt_childcarecategory" value="Requesting" /> Requesting Service</p>

<p><label>Title for your Childcare Service/Request<br />
<input type="text" name="title" id="title" class="field" size="80" /></p>

<p><label>Please describe your request or service and your include contact info.</label><br />
<textarea name="description" id="description" class="textfield"></textarea></p>

<p><label>Contact information<br />
<input type="text" name="ecpt_childcarecontact" id="ecpt_childcarecontact" value="" class="field" size="80" /></p>

<div class="line-long"></div>

<p><input type="submit" id="submit" value="submit" /></p>

<input type="hidden" name="action" value="new_post" />
<?php wp_nonce_field( 'new-post' ); ?>

</form>

</div>

<?php endwhile;  ?>

<?php else : ?>
<p>It looks like you're not logged or or do not have a Hoboken Mommies account. Only Hoboken Mommies Members can contribute content. Please <a href="<?php echo site_url() ?>/register/">signup</a> for a free account.</p>
<?php endif ?>

</div><!-- #box -->
</div><!-- #column-one -->


<div id="column-two">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('welcome') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('adspages') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('recent') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('groups') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('topics') ) : ?><?php endif; ?>		

</div><!-- #column-two -->

<?php get_footer() ?>