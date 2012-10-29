<?php
if ( !defined( 'ABSPATH' ) ) exit;

add_action('admin_menu', 'bp_mymood_admin_option');
function bp_mymood_admin_option() {
  add_submenu_page('bp-general-settings','BuddyPress MyMood Options','BuddyPress MyMood', 10,__FILE__, 'bp_mymood_adminpanel');
}



function bp_mymood_adminpanel() {   ?>

<?php

if( !current_user_can( 'manage_options' ) )  
{ 
_e('<div id="message" class="error fade">
		  <p>
		    <strong>You have no permission to access this page !</strong>
		  </p>
		</div>');
return true; 
}
	

?>

<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>

<h2>BuddyPress MyMood (<?php echo BP_MYMOOD_VERSION; ?>) <?php _e("Settings"); ?></h2>
<div style="clear:both"></div>
<?php

if(isset($_GET["delete_mood"])) {
$moods = get_option("bp_mymood_moods");
$mood_key = array_keys($moods,$_GET["delete_mood"]);
unset($moods[$mood_key[0]]);
update_option("bp_mymood_moods",$moods);
echo '<div class="updated"><p><b>'.$_GET["delete_mood"].'</b> has been deleted, <a href="?page='.$_GET["page"].'">Click here</a> to go back.</p></div>';
return true;	
} 

if(isset($_POST[Update])) {

if($_POST["bp_mymood_enable"] == "yes") {
	update_option('bp_mymood_enable',"yes");
} else {
	update_option('bp_mymood_enable',"no");
}

if($_POST["bp_mymood_req"] == "yes") {
	update_option('bp_mymood_req',"yes");
} else {
	update_option('bp_mymood_req',"no");
}

if($_POST["bp_mymood_header_meta_show"] == "yes") {
	update_option('bp_mymood_header_meta_show',"yes");
} else {
	update_option('bp_mymood_header_meta_show',"no");
}

array_unique($_POST["bp_mymood_mood"]); //remove dublicate entries
update_option("bp_mymood_moods",$_POST["bp_mymood_mood"]);

_e('<div id="message" class="updated fade">
  <p>
    <strong>Status saved.</strong>
  </p>
</div>');
} 


if(isset($_GET["sort_mood"])) {
	if($_GET["sort_mood"] == "1") {
	    $get_moods = get_option("bp_mymood_moods");
        sort($get_moods);
		update_option("bp_mymood_moods",$get_moods);
		_e('<div id="message" class="updated fade">
		  <p>
		    <strong>Mood Sorted !.</strong>
		  </p>
		</div>');
	}
	if($_GET["sort_mood"] == "2") {
	    $get_moods = get_option("bp_mymood_moods");
		rsort($get_moods);
		update_option("bp_mymood_moods",$get_moods);
		_e('<div id="message" class="updated fade">
		  <p>
		    <strong>Mood Sorted Reverse Order !.</strong>
		  </p>
		</div>');
	}	
}
?>

<?php

?>

<div class="postbox-container" style="width:70%">


<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class="form-table">

<tr valign="top">
<th scope="row">Enable :</th>
<td>
<label><input name="bp_mymood_enable" type="checkbox" value="yes" <?php if(get_option("bp_mymood_enable") == "yes"): ?> checked="checked" <?php endif; ?>> If checked then BuddyPress MyMood will not show anywhere on your site.</label>
</td>
</tr>

<tr valign="top">
<th scope="row">Mood Requred :</th>
<td>
<label><input name="bp_mymood_req" type="checkbox" value="yes" <?php if(get_option("bp_mymood_req") == "yes"): ?> checked="checked" <?php endif; ?>> If checked then member will be forced to updated his/her mood with every status.</label>
</td>
</tr>

<tr valign="top">
<th scope="row">Mood on Profile Head :</th>
<td>
<label><input name="bp_mymood_header_meta_show" type="checkbox" value="yes" <?php if(get_option("bp_mymood_header_meta_show") == "yes"): ?> checked="checked" <?php endif; ?>> If checked then latest mood (if any) will be shown on member profile header near name.</label>
</td>
</tr>
 
<tr valign="top">
<th scope="row">Manage Moods : 
<p> <input type="button" name="Update" class="button-primary" value="Add New Mood" id="add_mood" /></p>
<p>  <a href="?page=buddypress-mymood/buddypress-mymood_admin.php&sort_mood=1">Sort Moods</a> </p>
<p>  <a href="?page=buddypress-mymood/buddypress-mymood_admin.php&sort_mood=2">Sort Moods (Reverse Order)</a> </p>
</th>
<td>
<p>oh yah! for sorting you can drag and drop moods.!</p>
<ul id="bp_moods">
<?php
$moods = get_option("bp_mymood_moods");
foreach($moods as $mood) {
	echo '<li class="bp-mymood-mood"> '.$mood.'  <a href="javascript:;" title="delete this mood" class="delete_mood">x</a><input type="hidden" name="bp_mymood_mood[]" class="bp_mymood_mood_input" value="'.$mood.'" /></li> ';
}
?>
</ul>
<script type="text/javascript" src="<?php echo BP_MYMOOD_PATH."/jquery-ui.js"; ?>"></script>
<script type="text/javascript">
<!--
	jQuery(document).ready(function() {
	jQuery("#bp_moods").sortable();
	jQuery("#add_mood").click(function() {
	var moodname = prompt("Please enter the name of mood :");
	if(moodname != "") {
	
	jQuery(".bp_mymood_mood_input").each(function() {
	
	if(jQuery(this).val().toLowerCase() == moodname.toLowerCase()) {
		alert(moodname+" is already exists.!");
		return false;
	}
	
	});
	
	jQuery("#bp_moods").prepend('<li class="bp-mymood-mood"> '+moodname+' <a href="javascript:;" title="delete this mood" class="delete_mood">x</a><input type="hidden" name="bp_mymood_mood[]" class="bp_mymood_mood_input" value="'+moodname+'" /></li>');
	moods_delete_event();
	}
	});
	
	moods_delete_event();
	
	});
	
	function moods_delete_event() {
		jQuery(".delete_mood").each(function() {
		jQuery(this).click(function() {
		jQuery(this).parent().animate({  width: "0",   opacity: 0.0},"slow",function() { jQuery(this).remove();	});		
		});
		});
	}
//-->
</script>
</td>
</tr>

  
  <tr>
    <td height="26">&nbsp;</td>
    <td>
      <input type="submit" name="Update" class="button-primary" value="Update" />
    </td>
  </tr>
</table></form>


</div></div>

<style>
.bp-mymood-mood {
	padding:5px;
	background:#4d7306;
	color:white;
	display:block;
	float:left;
	margin:4px;
		-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
height:20px;
cursor:move
	}
.bp-mymood-mood a {
	padding:5px;
	background:gray;
	color:white;
	text-decoration:none;
		-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
height:20px;
}	
	
</style>



<!-- NEWS -->
<div class="postbox-container" style="width:28%">

 <center>
 <a href="http://webgarb.com/?s=MymoodBuddyPress+MyMood" target="_blank" title="BuddyPress MyMood"><img src="<?php echo BP_MYMOOD_PATH."/logo.png"; ?>" border="0">
 </a> 
 </center>
 <p>
 Follow WebGarb on twitter.
 </p>
 <a href="https://twitter.com/webgarb" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @webgarb</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<p>
Tell about this plugin to your followers.
</p>
<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://webgarb.com/buddypress-mymood/" data-text="BudyyPress MyMood plugin for BuddyPress" data-via="webgarb" data-size="large" data-hashtags="WordPress">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<p>
Latest Update.
</p>
 <!--Twitter-->
<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 10,
  interval: 30000,
  width: 'auto',
  height: 500,
  theme: {
    shell: {
      background: 'transparent',
      color: '#ba0000'
    },
    tweets: {
      background: 'transparent',
      color: '#878787',
      links: '#0073ff'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: false,
    behavior: 'all'
  }
}).render().setUser('webgarb').start();
</script>
<!--End Twitter-->
 
</div>
<div class="clear"></div>

<!-- NEW END -->



<h3>Need Help ? Visit <a href="http://webgarb.com/?s=MymoodBuddyPress+MyMood">BuddyPress MyMood</a> HomePage <a href="http://webgarb.com/?s=BuddyPress+MyMood">http://webgarb.com/?s=BuddyPress+MyMood</a></h3>

<p>Need a  Basic MyMood plugin for WordPress user ? Checkout Basic <a href="http://webgarb.com/?s=MyMood">MyMood</a> plugin visit : <a href="http://webgarb.com/?s=MyMood">http://webgarb.com/?s=MyMood</a></p>

<span class="description"><a href="http://webgarb.com/?s=BuddyPress+MyMood">BuddyPress MyMood</a> &copy; Copyright 2009 - 2012 <a href="http://webgarb.com">Webgarb.com</a>. MyMood Contain Graphic Smiley are property of their respective owner.<br />
</span>

<?php
} //End admin panel
?>