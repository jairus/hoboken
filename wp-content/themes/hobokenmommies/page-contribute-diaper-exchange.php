<?php
/*
Template Name: Contribute Diaper Exchange
*/
?>

<?php
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {


$title 						= $_POST['title'];
$description 				= $_POST['description'];
$author 					= $_POST['author'];
$ecpt_diaperfullname 		= $_POST['ecpt_diaperfullname'];
$ecpt_diaperusername 		= $_POST['ecpt_diaperusername'];
$ecpt_diaperemail 			= $_POST['ecpt_diaperemail'];
$ecpt_diaperbrand 			= $_POST['ecpt_diaperbrand'];
$ecpt_diapersize 			= $_POST['ecpt_diapersize'];
$ecpt_diapercontact 		= $_POST['ecpt_diapercontact'];

$subject = "New Diaper Exchange";
$message = "A New Diaper Exchange was submitted on the website. Login to http://www.hobokenmommies.com/wp-admin/ and review the submission.";
$recipient = get_bloginfo('admin_email');
mail($recipient, $subject, $message);

$new_post = array(
'post_title'				=>	$title,
'post_content'				=>	$description,
'post_author' 				=> 	$author,
'post_status'				=>	'draft',
'post_type'					=>	'diaper-exchange',
'ecpt_diaperfullname'		=>	$ecpt_diaperfullname,
'ecpt_diaperusername'		=>	$ecpt_diaperusername,
'ecpt_diaperemail'			=>	$ecpt_diaperemail,
'ecpt_diaperbrand'			=>	$ecpt_diaperbrand,
'ecpt_diapersize'			=>	$ecpt_diapersize,
'ecpt_diapercontact'		=>	$ecpt_diapercontact
);

$pid = wp_insert_post($new_post);

wp_set_post_tags($pid, $_POST['post_tags']);

wp_redirect( '/contribute/thanks/');

add_post_meta($pid, 'ecpt_diaperfullname', $ecpt_diaperfullname, true);
add_post_meta($pid, 'ecpt_diaperusername', $ecpt_diaperusername, true);
add_post_meta($pid, 'ecpt_diaperemail', $ecpt_diaperemail, true);
add_post_meta($pid, 'ecpt_diaperbrand', $ecpt_diaperbrand, true);
add_post_meta($pid, 'ecpt_diapersize', $ecpt_diapersize, true);
add_post_meta($pid, 'ecpt_diapercontact', $ecpt_diapercontact, true);

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
<li>New Diaper Exchange</li>
</ul>
</div>
</div>

<h2>Sell Your Diapers</h2>

<p>Hello <a href="<?php echo bp_loggedin_user_domain() ?>profile"><?php echo bp_get_user_firstname() ?></a>. Please provide the following information and send it over to us. All Diaper Exchange submissions are carefully reviewed by our Mommy experts before being made live on our site.</p>

<div class="line-long-home"></div>

<div id="card-form">

<?php if ( is_user_logged_in() ) : ?>
<?php global $bp, $current_user; ?>
<?php $authorid = $bp->loggedin_user->id; ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<form id="new_post" name="new_post" method="post" action="">

<h3>Childcare Info</h3>

<input type="hidden" name="ecpt_diaperusername" id="ecpt_diaperusername" class="field" value="<?php echo $current_user->user_login; ?>" />
<input type="hidden" name="ecpt_diaperemail" id="ecpt_diaperemail" class="field" value="<?php echo $current_user->user_email; ?>" />

<p><label>Your Name</label><br />
<input type="text" id="ecpt_diaperfullname" name="ecpt_diaperfullname" class="field" size="80" value="<?php echo $current_user->display_name; ?>" /></p>

<p><label>Title<br />
<input type="text" name="title" id="title" class="field" size="80" /></p>

<p><label>Describe the diapers. Please include your price.</label><br />
<textarea name="description" id="description" class="textfield"></textarea></p>

<p><label>Diaper Size / Brand</label><br />
<select name="ecpt_diapersize" id="ecpt_diapersize">
<option value="Size 1" selected="selected">Size 1</option>
<option value="Size 2">Size 2</option>
<option value="Size 3">Size 3</option>
<option value="Size 4">Size 4</option>
<option value="Size 5">Size 5</option>
<option value="Size 6">Size 6</option>
<option value="Swim">Swim</option>
<option value="Specialty">Specialty</option>
</select>

<select name="ecpt_diaperbrand" id="ecpt_diaperbrand">
<option value="Attitude">Attitude</option>
<option value="Babies R Us">Babies R Us</option>
<option value="Diaper Buds">Diaper Buds</option>
<option value="Earths Best">Earths Best</option>
<option value="Fisher Price">Fisher Price</option>
<option value="GroVia">GroVia</option>
<option value="Huggies">Huggies</option>
<option value="Kirkland">Kirkland</option>
<option value="Luvs">Luvs</option>
<option value="Munchkin">Munchkin</option>
<option value="Nature Babycare">Nature Babycare</option>
<option value="Nurtured by Nature">Nurtured by Nature</option>
<option value="Pampers">Pampers</option>
<option value="Seventh Generation">Seventh Generation</option>
<option value="Other">Other</option>
</select>
</p>

<p><label>Contact information<br />
<input type="text" name="ecpt_diapercontact" id="ecpt_diapercontact" value="" class="field" size="80" /></p>

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