<?php
/*
Template Name: Contribute Classified
*/
?>

<?php
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {


$title 							= $_POST['title'];
$description 					= $_POST['description'];
$author 						= $_POST['author'];
$ecpt_classifiedsfullname 		= $_POST['ecpt_classifiedsfullname'];
$ecpt_classifiedsusername 		= $_POST['ecpt_classifiedsusername'];
$ecpt_classifiedsemail 			= $_POST['ecpt_classifiedsemail'];
$ecpt_classifiedscategory 		= $_POST['ecpt_classifiedscategory'];
$ecpt_classifiedscontact 		= $_POST['ecpt_classifiedscontact'];

$subject = "New Classified";
$message = "A New Classified was submitted on the website. Login to http://www.hobokenmommies.com/wp-admin/ and review the submission.";
$recipient = get_bloginfo('admin_email');
mail($recipient, $subject, $message);

$new_post = array(
'post_title'				=>	$title,
'post_content'				=>	$description,
'post_author' 				=> 	$author,
'post_status'				=>	'draft',
'post_type'					=>	'classifieds',
'ecpt_classifiedsfullname'	=>	$ecpt_classifiedsfullname,
'ecpt_classifiedsusername'	=>	$ecpt_classifiedsusername,
'ecpt_classifiedsemail'		=>	$ecpt_classifiedsemail,
'ecpt_classifiedscategory'	=>	$ecpt_classifiedscategory,
'ecpt_classifiedscontact'		=>	$ecpt_classifiedscontact
);

$pid = wp_insert_post($new_post);

wp_set_post_tags($pid, $_POST['post_tags']);

wp_redirect( '/contribute/thanks/');

add_post_meta($pid, 'ecpt_classifiedsfullname', $ecpt_classifiedsfullname, true);
add_post_meta($pid, 'ecpt_classifiedsusername', $ecpt_classifiedsusername, true);
add_post_meta($pid, 'ecpt_classifiedsemail', $ecpt_classifiedsemail, true);
add_post_meta($pid, 'ecpt_classifiedscategory', $ecpt_classifiedscategory, true);
add_post_meta($pid, 'ecpt_classifiedscontact', $ecpt_classifiedscontact, true);

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
<li>New Classified</li>
</ul>
</div>
</div>

<h2>contribute a new classified</h2>

<p>Hello <a href="<?php echo bp_loggedin_user_domain() ?>profile"><?php echo bp_get_user_firstname() ?></a>. Please provide the following information and send it over to us. All classifieds submissions are carefully reviewed by our Mommy experts before being made live on our site. Classifieds will be posted for a period of 30 days. Please contact Hoboken Mommies at <a href="mailto:info@hobokenmommies.com">info@hobokenmommies.com</a> if you would like your classified removed prior.</p>

<div class="line-long-home"></div>

<div id="card-form">

<?php if ( is_user_logged_in() ) : ?>
<?php global $bp, $current_user; ?>
<?php $authorid = $bp->loggedin_user->id; ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<form id="new_post" name="new_post" method="post" action="">

<h3>Classifieds Info</h3>

<input type="hidden" name="ecpt_classifiedsusername" id="ecpt_classifiedsusername" class="field" value="<?php echo $current_user->user_login; ?>" />
<input type="hidden" name="ecpt_classifiedsemail" id="ecpt_classifiedsemail" class="field" value="<?php echo $current_user->user_email; ?>" />

<p><label>Your Name</label><br />
<input type="text" id="ecpt_classifiedsfullname" name="ecpt_classifiedsfullname" class="field" size="80" value="<?php echo $current_user->display_name; ?>" /></p>

<p>
<input type="radio" name="ecpt_classifiedscategory" id="ecpt_classifiedscategory" value="Clothing" /> Clothing<br />
<input type="radio" name="ecpt_classifiedscategory" id="ecpt_classifiedscategory" value="Free Items" /> Free Items<br />
<input type="radio" name="ecpt_classifiedscategory" id="ecpt_classifiedscategory" value="Gear" /> Gear<br />
<input type="radio" name="ecpt_classifiedscategory" id="ecpt_classifiedscategory" value="Home Goods and Furnishings" /> Home Goods and Furnishings<br />
<input type="radio" name="ecpt_classifiedscategory" id="ecpt_classifiedscategory" value="Miscellaneous" /> Miscellaneous<br />
<input type="radio" name="ecpt_classifiedscategory" id="ecpt_classifiedscategory" value="Real Estate" /> Real Estate<br />
<input type="radio" name="ecpt_classifiedscategory" id="ecpt_classifiedscategory" value="Toys and Play" /> Toys and Play
</p>

<p><label>Title for your classified.<br />
<input type="text" name="title" id="title" class="field" size="80" /></p>

<p><label>Please describe your classified.</label><br />
<textarea name="description" id="description" class="textfield"></textarea></p>

<p><label>Contact information<br />
<input type="text" name="ecpt_classifiedscontact" id="ecpt_classifiedscontact" value="" class="field" size="80" /></p>

<div class="line-long"></div>

<p><input type="submit" id="submit" value="submit" /></p>

<input type="hidden" name="action" value="new_post" />
<?php wp_nonce_field( 'new-post' ); ?>

</form>

</div>

<?php endwhile;  ?>

<?php else : ?>
<p>It looks like you're not logged or or do not have anHoboken Mommies account. Only Hoboken Mommies Members can contribute content. Please <a href="<?php echo site_url() ?>/register/">signup</a> for a free account.</p>
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