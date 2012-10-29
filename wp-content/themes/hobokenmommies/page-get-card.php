<?php
/*
Template Name: Card Request
*/
?>

<?php
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {

if (isset ($_POST['title'])) {
$title =  $_POST['title'];
} else {
echo 'Please enter a title for your Membership Card Request';
}
	
$author 						= $_POST['author'];
$tags 							= $_POST['post_tags'];
$ecpt_cardfullname 				= $_POST['ecpt_cardfullname'];
$ecpt_cardusername 				= $_POST['ecpt_cardusername'];
$ecpt_cardemail 				= $_POST['ecpt_cardemail'];
$ecpt_cardaddress 				= $_POST['ecpt_cardaddress'];
$ecpt_cardcity 					= $_POST['ecpt_cardcity'];
$ecpt_cardstate 				= $_POST['ecpt_cardstate'];
$ecpt_cardzip 					= $_POST['ecpt_cardzip'];
$ecpt_cardphone 				= $_POST['ecpt_cardphone'];
$ecpt_cardbirthday				= $_POST['ecpt_cardbirthdayyear']."-".$_POST['ecpt_cardbirthdaymonth']."-".$_POST['ecpt_cardbirthdayday'];
$ecpt_cardpregnant 				= $_POST['ecpt_cardpregnant'];
$ecpt_cardpregnantdate			= $_POST['ecpt_cardpregnantdateyear']."-".$_POST['ecpt_cardpregnantdatemonth']."-".$_POST['ecpt_cardpregnantdateday'];
$ecpt_cardhavekids 				= $_POST['ecpt_cardhavekids'];
$ecpt_cardchildname1 			= $_POST['ecpt_cardchildname1'];
$ecpt_cardchildage1 			= $_POST['ecpt_cardchildage1'];
$ecpt_cardchildbirthday1		= $_POST['ecpt_cardchildbirthdayyear1']."-".$_POST['ecpt_cardchildbirthdaymonth1']."-".$_POST['ecpt_cardchildbirthdayday1'];
$ecpt_cardchildname2 			= $_POST['ecpt_cardchildname2'];
$ecpt_cardchildage2 			= $_POST['ecpt_cardchildage2'];
$ecpt_cardchildbirthday2		= $_POST['ecpt_cardchildbirthdayyear2']."-".$_POST['ecpt_cardchildbirthdaymonth2']."-".$_POST['ecpt_cardchildbirthdayday2'];
$ecpt_cardchildname3 			= $_POST['ecpt_cardchildname3'];
$ecpt_cardchildage3 			= $_POST['ecpt_cardchildage3'];
$ecpt_cardchildbirthday3		= $_POST['ecpt_cardchildbirthdayyear3']."-".$_POST['ecpt_cardchildbirthdaymonth3']."-".$_POST['ecpt_cardchildbirthdayday3'];

$new_post = array(
'post_title'				=>	$title,
'post_content'				=>	$description,
'post_author' 				=> 	$author,
'post_category'				=>	array($_POST['cat']),  	// Usable for custom taxonomies too
'tags_input'				=>	array($tags),
'post_status'				=>	'draft',           		// Choose: publish, preview, future, draft, etc.
'post_type'					=>	'card-requests',  		//'post',page' or use a custom post type if you want to
'ecpt_cardfullname'			=>	$ecpt_cardfullname,
'ecpt_cardusername'			=>	$ecpt_cardusername,
'ecpt_cardemail'			=>	$ecpt_cardemail,
'ecpt_cardaddress'			=>	$ecpt_cardaddress,
'ecpt_cardcity'				=>	$ecpt_cardcity,
'ecpt_cardstate'			=>	$ecpt_cardstate,
'ecpt_cardzip'				=>	$ecpt_cardzip,
'ecpt_cardphone'			=>	$ecpt_cardphone,
'ecpt_cardbirthday'			=>	$ecpt_cardbirthday,
'ecpt_cardpregnant'			=>	$ecpt_cardpregnant,
'ecpt_cardpregnantdate'		=>	$ecpt_cardpregnantdate,
'ecpt_cardhavekids'			=>	$ecpt_cardhavekids,
'ecpt_cardchildname1'		=>	$ecpt_cardchildname1,
'ecpt_cardchildage1'		=>	$ecpt_cardchildage1,
'ecpt_cardchildbirthday1'	=>	$ecpt_cardchildbirthday1,
'ecpt_cardchildname2'		=>	$ecpt_cardchildname2,
'ecpt_cardchildage2'		=>	$ecpt_cardchildage2,
'ecpt_cardchildbirthday2'	=>	$ecpt_cardchildbirthday2,
'ecpt_cardchildname3'		=>	$ecpt_cardchildname3,
'ecpt_cardchildage3'		=>	$ecpt_cardchildage3,
'ecpt_cardchildbirthday3'	=>	$ecpt_cardchildbirthday3
);

$pid = wp_insert_post($new_post);

wp_set_post_tags($pid, $_POST['post_tags']);

wp_redirect( '/card-request/thanks/');

add_post_meta($pid, 'ecpt_cardfullname', $ecpt_cardfullname, true);
add_post_meta($pid, 'ecpt_cardusername', $ecpt_cardusername, true);
add_post_meta($pid, 'ecpt_cardemail', $ecpt_cardemail, true);
add_post_meta($pid, 'ecpt_cardaddress', $ecpt_cardaddress, true);
add_post_meta($pid, 'ecpt_cardcity', $ecpt_cardcity, true);
add_post_meta($pid, 'ecpt_cardstate', $ecpt_cardstate, true);
add_post_meta($pid, 'ecpt_cardzip', $ecpt_cardzip, true);
add_post_meta($pid, 'ecpt_cardphone', $ecpt_cardphone, true);
add_post_meta($pid, 'ecpt_cardbirthday', $ecpt_cardbirthday, true);
add_post_meta($pid, 'ecpt_cardpregnant', $ecpt_cardpregnant, true);
add_post_meta($pid, 'ecpt_cardpregnantdate', $ecpt_cardpregnantdate, true);
add_post_meta($pid, 'ecpt_cardhavekids', $ecpt_cardhavekids, true);
add_post_meta($pid, 'ecpt_cardchildname1', $ecpt_cardchildname1, true);
add_post_meta($pid, 'ecpt_cardchildage1', $ecpt_cardchildage1, true);
add_post_meta($pid, 'ecpt_cardchildbirthday1', $ecpt_cardchildbirthday1, true);
add_post_meta($pid, 'ecpt_cardchildname2', $ecpt_cardchildname2, true);
add_post_meta($pid, 'ecpt_cardchildage2', $ecpt_cardchildage2, true);
add_post_meta($pid, 'ecpt_cardchildbirthday2', $ecpt_cardchildbirthday2, true);
add_post_meta($pid, 'ecpt_cardchildname3', $ecpt_cardchildname3, true);
add_post_meta($pid, 'ecpt_cardchildage3', $ecpt_cardchildage3, true);
add_post_meta($pid, 'ecpt_cardchildbirthday3', $ecpt_cardchildbirthday3, true);

if ($_FILES) {
foreach ($_FILES as $file => $array) {
$newupload = insert_attachment($file,$pid);
}
}
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
<li>Membership Card Request</li>
</ul>
</div>
</div>

<h2>membership card request</h2>

<p>Welcome <a href="<?php echo bp_loggedin_user_domain() ?>profile"><?php echo bp_get_user_firstname() ?></a>. Now that you're a member, fill out the form to receive your very own Hoboken Mommies Membership card. With your card, you'll receive discounts at local vendors and restaurants.</p>

<div class="line-long"></div>

<div id="card-form">

<?php if ( is_user_logged_in() ) : ?>
<?php global $bp, $current_user; ?>
<?php $authorid = $bp->loggedin_user->id; ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<form id="new_post" name="new_post" method="post" action="" enctype="multipart/form-data">

<h3>Basic Information</h3>

<p><label>Full Name</label><br />
<input type="hidden" id="ecpt_cardfullname" class="field" name="ecpt_cardfullname" value="<?php echo $current_user->display_name; ?>" /><input type="text" id="title" class="field" name="title" size="100" value="<?php echo $current_user->display_name; ?>" /></p>

<p><label>Username</label><br />
<input type="text" name="ecpt_cardusername" id="ecpt_cardusername" class="field" size="80" value="<?php echo $current_user->user_login; ?>" /></p>

<p><label>Email Address</label><br />
<input type="text" name="ecpt_cardemail" id="ecpt_cardemail" class="field" size="100" value="<?php echo $current_user->user_email; ?>" /></p>

<p><label>Address</label><br />
<input type="text" name="ecpt_cardaddress" id="ecpt_cardaddress" class="field" size="100" value="" /></p>

<div>
<div class="left">
<label>City</label>
<p><input type="text" name="ecpt_cardcity" id="ecpt_cardcity" class="field" size="40" value="" /></p>
</div>
<div class="left">
<label>State</label>
<p><input type="text" name="ecpt_cardstate" id="ecpt_cardstate" class="field" size="2" value="" /></p>
</div>
<div class="left">
<label>Zip</label>
<p><input type="text" name="ecpt_cardzip" id="ecpt_cardzip" class="field" size="5" value="" /></p>
</div>
<div class="left">
<p><label>Phone Number</label><br />
<input type="text" name="ecpt_cardphone" id="ecpt_cardphone" class="field" size="20" value="" /></p>
</div>
</div>

<br clear="all" />
<br />

<p><label>Birthday</label><br />
<select name="ecpt_cardbirthdaymonth" id="ecpt_cardbirthdaymonth" class="select-menu">
<option value="" selected="selected">Month</option>
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
<select name="ecpt_cardbirthdayday" id="ecpt_cardbirthdayday" class="select-menu">
<option value="" selected="selected">Day</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<select name="ecpt_cardbirthdayyear" id="ecpt_cardbirthdayyear" class="select-menu">
<option value="" selected="selected">Year</option>
<option value="1950">1950</option>
<option value="1951">1951</option>
<option value="1952">1952</option>
<option value="1953">1953</option>
<option value="1954">1954</option>
<option value="1955">1955</option>
<option value="1956">1956</option>
<option value="1957">1957</option>
<option value="1958">1958</option>
<option value="1959">1959</option>
<option value="1960">1960</option>
<option value="1961">1961</option>
<option value="1962">1962</option>
<option value="1963">1963</option>
<option value="1964">1964</option>
<option value="1965">1965</option>
<option value="1966">1966</option>
<option value="1967">1967</option>
<option value="1968">1968</option>
<option value="1969">1969</option>
<option value="1970">1970</option>
<option value="1971">1971</option>
<option value="1972">1972</option>
<option value="1973">1973</option>
<option value="1974">1974</option>
<option value="1975">1975</option>
<option value="1976">1976</option>
<option value="1977">1977</option>
<option value="1978">1978</option>
<option value="1979">1979</option>
<option value="1980">1980</option>
<option value="1981">1981</option>
<option value="1982">1982</option>
<option value="1983">1983</option>
<option value="1984">1984</option>
<option value="1985">1985</option>
<option value="1986">1986</option>
<option value="1987">1987</option>
<option value="1988">1988</option>
<option value="1989">1989</option>
<option value="1990">1990</option>
<option value="1991">1991</option>
<option value="1992">1992</option>
<option value="1993">1993</option>
<option value="1994">1994</option>
<option value="1995">1995</option>
<option value="1996">1996</option>
<option value="1997">1997</option>
<option value="1998">1998</option>
<option value="1999">1999</option>
<option value="2000">2000</option>
<option value="2001">2001</option>
<option value="2002">2002</option>
<option value="2003">2003</option>
<option value="2004">2004</option>
<option value="2005">2005</option>
<option value="2006">2006</option>
<option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
</select>
</p>

<div class="line-long"></div>

<h3>Pregnancy Information</h3>

<p><label>Are you currently pregnant? and if so, what's your due date?</label><br />
Yes <input type="radio" name="ecpt_cardpregnant" id="ecpt_cardpregnant" value="yes" /> No <input type="radio" name="ecpt_cardpregnant" id="ecpt_cardpregnant" value="no" /> 
<select name="ecpt_cardpregnantdatemonth" id="ecpt_cardpregnantdatemonth" class="select-menu">
<option value="" selected="selected">Month</option>
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
<select name="ecpt_cardpregnantdateday" id="ecpt_cardpregnantdateday" class="select-menu">
<option value="" selected="selected">Day</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<select name="ecpt_cardpregnantdateyear" id="ecpt_cardpregnantdateyear" class="select-menu">
<option value="" selected="selected">Year</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
<option value="2014">2014</option>
</select>
</p>

<div class="line-long"></div>

<h3>Child Information</h3>

<p><label>Do you have children?</label><br />
Yes <input type="radio" name="ecpt_cardhavekids" id="ecpt_cardhavekids" value="yes" /> No <input type="radio" name="ecpt_cardhavekids" id="ecpt_cardhavekids" value="no" /></p>

<div>
<div class="left">
<p><label>First Child's Name</label><br />
<input type="text" name="ecpt_cardchildname1" id="ecpt_cardchildname1" class="field" size="40" value="" /></p>
</div>
<div class="left">
<p><label>Age</label><br />
<input type="text" name="ecpt_cardchildage1" id="ecpt_cardchildage1" class="field" size="2" value="" /></p>
</div>
<div class="left">
<p><label>Birthday</label><br />
<select name="ecpt_cardchildbirthdaymonth1" id="ecpt_cardchildbirthdaymonth1" class="select-menu">
<option value="" selected="selected">Month</option>
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
<select name="ecpt_cardchildbirthdayday1" id="ecpt_cardchildbirthdayday1" class="select-menu">
<option value="" selected="selected">Day</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<select name="ecpt_cardchildbirthdayyear1" id="ecpt_cardchildbirthdayyear1" class="select-menu">
<option value="" selected="selected">Year</option>
<option value="1990">1990</option>
<option value="1991">1991</option>
<option value="1992">1992</option>
<option value="1993">1993</option>
<option value="1994">1994</option>
<option value="1995">1995</option>
<option value="1996">1996</option>
<option value="1997">1997</option>
<option value="1998">1998</option>
<option value="1999">1999</option>
<option value="2000">2000</option>
<option value="2001">2001</option>
<option value="2002">2002</option>
<option value="2003">2003</option>
<option value="2004">2004</option>
<option value="2005">2005</option>
<option value="2006">2006</option>
<option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
</select>
</p>
</div>
</div>

<br clear="all" />
<br />

<div>
<div class="left">
<p><label>Second Child's Name</label><br />
<input type="text" name="ecpt_cardchildname2" id="ecpt_cardchildname2" class="field" size="40" value="" /></p>
</div>
<div class="left">
<p><label>Age</label><br />
<input type="text" name="ecpt_cardchildage2" id="ecpt_cardchildage2" class="field" size="2" value="" /></p>
</div>
<div class="left">
<p><label>Birthday</label><br />
<select name="ecpt_cardchildbirthdaymonth2" id="ecpt_cardchildbirthdaymonth2" class="select-menu">
<option value="" selected="selected">Month</option>
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
<select name="ecpt_cardchildbirthdayday2" id="ecpt_cardchildbirthdayday2" class="select-menu">
<option value="" selected="selected">Day</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<select name="ecpt_cardchildbirthdayyear2" id="ecpt_cardchildbirthdayyear2" class="select-menu">
<option value="" selected="selected">Year</option>
<option value="1990">1990</option>
<option value="1991">1991</option>
<option value="1992">1992</option>
<option value="1993">1993</option>
<option value="1994">1994</option>
<option value="1995">1995</option>
<option value="1996">1996</option>
<option value="1997">1997</option>
<option value="1998">1998</option>
<option value="1999">1999</option>
<option value="2000">2000</option>
<option value="2001">2001</option>
<option value="2002">2002</option>
<option value="2003">2003</option>
<option value="2004">2004</option>
<option value="2005">2005</option>
<option value="2006">2006</option>
<option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
</select>
</p>
</div>
</div>

<br clear="all" />
<br />

<div>
<div class="left">
<p><label>Third Child's Name</label><br />
<input type="text" name="ecpt_cardchildname3" id="ecpt_cardchildname3" class="field" size="40" value="" /></p>
</div>
<div class="left">
<p><label>Age</label><br />
<input type="text" name="ecpt_cardchildage3" id="ecpt_cardchildage3" class="field" size="2" value="" /></p>
</div>
<div class="left">
<p><label>Birthday</label><br />
<select name="ecpt_cardchildbirthdaymonth3" id="ecpt_cardchildbirthdaymonth3" class="select-menu">
<option value="" selected="selected">Month</option>
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
<select name="ecpt_cardchildbirthdayday3" id="ecpt_cardchildbirthdayday3" class="select-menu">
<option value="" selected="selected">Day</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<select name="ecpt_cardchildbirthdayyear3" id="ecpt_cardchildbirthdayyear3" class="select-menu">
<option value="" selected="selected">Year</option>
<option value="1990">1990</option>
<option value="1991">1991</option>
<option value="1992">1992</option>
<option value="1993">1993</option>
<option value="1994">1994</option>
<option value="1995">1995</option>
<option value="1996">1996</option>
<option value="1997">1997</option>
<option value="1998">1998</option>
<option value="1999">1999</option>
<option value="2000">2000</option>
<option value="2001">2001</option>
<option value="2002">2002</option>
<option value="2003">2003</option>
<option value="2004">2004</option>
<option value="2005">2005</option>
<option value="2006">2006</option>
<option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
</select>
</p>
</div>
</div>

<br clear="all" />
<div class="line-long"></div>

<p><input type="submit" id="submit" value="request card" /></p>

<input type="hidden" name="action" value="new_post" />
<?php wp_nonce_field( 'new-post' ); ?>

</form>

</div>

<?php endwhile;  ?>

<?php else : ?>
<p>It looks like you're not logged or or do not have anHoboken Mommies account. Only Hoboken Mommies Members can apply for Membership Cards. Please <a href="<?php echo site_url() ?>/register">signup</a> for a free account.</p>
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