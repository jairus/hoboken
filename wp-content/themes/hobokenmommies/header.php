<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="google-site-verification" content="evAZUKjJVJJ1xwKucfUE9Ser2F0ytXL6Pc70X2CAH_o" />
<meta name="copyright" content="Mommies 247" /> 
<meta name="viewport" content="width=1120, initial-scale=0.9, user-scalable=yes" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="robots" content="index,follow" />
<meta name="googlebot" content="noarchive" />
<meta name="description" content="Hoboken Mommies 247 is THE social networking site for mothers in Hoboken, NJ. Connect with a community of moms who lead a messy but fabulous life!" />
<meta name="keywords" content="hoboken,moms,networking,social,babies,classifieds,diaper exchange,nannies,mommies 247,community" />

<title><?php wp_title( '-', true, 'right' ); bloginfo( 'name' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/switcher.php?default=pink.css" type="text/css" media="all" />
<link rel="alternate" type="application/rss+xml" title="Hoboken Mommies 247 - The Scoop" href="http://hoboken.mommies247.com/activity/feed/" />
<link rel="alternate" type="application/rss+xml" title="Hoboken Mommies 247 - Events" href="http://hoboken.mommies247.com/feed/?post_type=events" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />	
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/iphone-icon.png" />

<meta property="fb:app_id" content="288608467859875" />
<meta property="fb:admins" content="602917483" />
<?php if (is_single()) { ?>
<meta property="og:url" content="<?php the_permalink() ?>"/>
<meta property="og:locale" content="en_US" />
<meta property="og:title" content="<?php single_post_title(''); ?>" />
<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php if (function_exists('wp_get_attachment_thumb_url')) {echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); } ?>" />
<?php } if (is_home() || is_front_page()) { ?>
<meta property="og:url" content="http://hoboken.mommies247.com"/>
<meta property="og:title" content="Hoboken Mommies 247" />
<meta property="og:site_name" content="Hoboken Mommies 247" />
<meta property="og:description" content="Hoboken Mommies 247 is THE social networking site for mothers in Hoboken, NJ. Connect with a community of moms who lead a messy but FABULOUS life!!" />
<meta property="og:type" content="website" />
<meta property="og:image" content="http://hoboken.mommies247.com/facebook/hoboken-mommies-facebook-thumb.jpg" />
<?php } ?>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php
wp_deregister_script('jquery');
wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"), false, '1.7.2');
wp_enqueue_script('jquery');
?>

<?php wp_head(); ?>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/_inc/global.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/accordian.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.vector-map.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/usa-en.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.jBreadCrumb.1.1.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/load.js"></script>

<script type="text/javascript">
var timer;
jQuery(function($) {
timer = setTimeout(Cloud, 0);
});
function Cloud() {
$("#bubble-flash").css({opacity: 0}).
animate({opacity: 1}, 1000, "swing", function() {
timer = setTimeout(Cloud, 0);
});
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	// if text input field value is not empty show the "X" button
	$("#field_1").keyup(function() {
		$("#x").fadeIn();
		if ($.trim($("#field_1").val()) == "") {
			$("#x").fadeOut();
		}
	});
	// on click of "X", delete input field value and hide "X"
	$("#x").click(function() {
		$("#field_1").val("");
		$(this).hide();
	});
});
</script>

</head>

<body>

<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1" type="text/javascript"></script>

<?php
$count_hottopics = wp_count_posts('hot-topics');
$count_gearsandgadgets = wp_count_posts('gears-and-gadgets');
$count_mommieofthemonth = wp_count_posts('mommie-of-the-month');
$count_babyofthemonth = wp_count_posts('baby-of-the-month');
$count_ourfavoritethings = wp_count_posts('our-favorite-things');
$count_twintuesdays = wp_count_posts('twin-tuesdays');
$count_recalls = wp_count_posts('recalls');
$count_classifieds = wp_count_posts('classifieds');
$count_childcare = wp_count_posts('childcare');
$count_diaperexchange = wp_count_posts('diaper-exchange');
$friendcount = bp_get_total_friend_count( bp_loggedin_user_id() );
$friendrequestcount = bp_friend_get_total_requests_count();
$messagecount = messages_get_unread_count();
$notificationcount = $friendrequestcount + $messagecount;
?>
		
<div id="wrapper">

<div id="header">

<h1>Hoboken Mommies 24 &hearts; 7 - Community for Hoboken Moms</h1>

<div id="parallax" class="clear">

<div class="parallax-layer-1">
<img src="<?php echo get_template_directory_uri(); ?>/images/city-three.png" alt="" style="width:478px; height:132px;"/>
</div>

<div class="parallax-layer-2">
<img src="<?php echo get_template_directory_uri(); ?>/images/city-two.png" alt="" style="width:478px; height:132px;"/>
</div>

<div class="parallax-layer-3">
<img src="<?php echo get_template_directory_uri(); ?>/images/city-one.png" alt="" style="width:478px; height:132px;"/>
</div>

</div>

<div class="logo"><a href="<?php echo site_url() ?>">

<?php /* added and modified by NMG Resources and Neuron Global 8*/ ?>
<?php $uplogo_options = get_option('theme_uplogo_options'); ?>  
            <?php if ( $uplogo_options['logo'] != '' ): ?>    
                    <img src="<?php echo $uplogo_options['logo']; ?>" />   
            <?php  else: ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/hoboken-mommies247-old.png" border="0" width="341" height="140" alt="Hoboken Mommies 247" />
			<?php endif; ?>  

</a></div>

<div class="menu">
<ul>

<li><a href="<?php echo site_url() ?>" <?php if ( is_home() || is_page('welcome') ) { echo 'class="current"'; } ?>>Home</a></li>

<li><a href="<?php echo site_url() ?>/about-us/" <?php if ( is_page('about-us') || is_page('dayna-sacks') || is_page('sarah-himmelbaum')  ) { echo 'class="current"'; } ?>>About</a>
<ul>
<li class="line"><a href="<?php echo site_url() ?>/about-us/">Hoboken Mommies 24 &hearts; 7</a></li>
<li class="line"><a href="<?php echo site_url() ?>/about-us/sarah-himmelbaum/">Sarah Himmelbaum</a></li>
</ul>
</li>

<li><a href="<?php echo site_url() ?>/activity/" <?php if ( is_page('activity') ) { echo 'class="current"'; } ?>>Scoop</a></li>

<li><a href="<?php echo site_url() ?>/events/" <?php if ( get_post_type() == 'events' ) { echo 'class="current"'; } ?>>Events</a></li>

<li><a href="<?php echo site_url() ?>/deals-of-the-day/" <?php if ( get_post_type() == 'deals-of-the-day'  ) { echo 'class="current"'; } ?>>Deals</a></li>

<li><a href="<?php echo site_url() ?>/members/" <?php if ( is_page('members') ) { echo 'class="current"'; } ?>>Members</a></li>

<li><a href="<?php echo site_url() ?>/forums/" <?php if ( is_page('forums') || is_page('groups')  ) { echo 'class="current"'; } ?>>Forums</a>
<ul>
<li class="line"><a href="<?php echo site_url() ?>/groups/">Groups<span>12</span></a></li>
<li><a href="<?php echo site_url() ?>/forums/">All Topics<span><?php bp_forum_topic_count ($user_id = 0) ?></span></a></li>
</ul>
</li> 

<li><a href="#" <?php if ( get_post_type() == 'hot-topics' || get_post_type() == 'gears-and-gadgets' || get_post_type() == 'mommie-of-the-month' || get_post_type() == 'baby-of-the-month' || get_post_type() == 'our-favorite-things' || get_post_type() == 'twin-tuesdays' || get_post_type() == 'recalls' ) { echo 'class="current"'; } ?>>Articles</a>
<ul>
<li class="line"><a href="<?php echo site_url() ?>/hot-topics/">Hot Topics<span><?php echo $count_hottopics->publish; ?></span></a></li>
<li class="line"><a href="<?php echo site_url() ?>/gears-and-gadgets/">Gears &amp; Gadgets<span><?php echo $count_gearsandgadgets->publish; ?></span></a></li>
<li class="line"><a href="<?php echo site_url() ?>/mommie-of-the-month/">Mommie of the Month<span><?php echo $count_mommieofthemonth->publish; ?></span></a></li>
<li class="line"><a href="<?php echo site_url() ?>/baby-of-the-month/">Baby of the Month<span><?php echo $count_babyofthemonth->publish; ?></span></a></li>
<li class="line"><a href="<?php echo site_url() ?>/our-favorite-things/">Our Favorite Things<span><?php echo $count_ourfavoritethings->publish; ?></span></a></li>
<li class="line"><a href="<?php echo site_url() ?>/twin-tuesdays/">Twin Tuesdays<span><?php echo $count_twintuesdays->publish; ?></span></a></li>
<li><a href="<?php echo site_url() ?>/recalls/">Recalls<span><?php echo $count_recalls->publish; ?></span></a></li>
</ul>
</li>

<li><a href="#" <?php if ( is_page('directories') || $post->post_parent == "331" ) { echo 'class="current"'; } ?>>Directories</a>
<ul>
<!-- <li class="line"><a href="<?php echo site_url() ?>/directories/beauty/">Beauty</a></li> -->
<!-- <li class="line"><a href="<?php echo site_url() ?>/directories/camps/">Camps</a></li> -->
<li class="line"><a href="<?php echo site_url() ?>/directories/caregivers/">Caregivers</a></li>
<li class="line"><a href="<?php echo site_url() ?>/directories/education/">Education</a></li>
<li class="line"><a href="<?php echo site_url() ?>/directories/entertainment/">Entertainment</a></li>
<li class="line"><a href="<?php echo site_url() ?>/directories/extracurriculars-for-kids/">Extracurriculars for Kids</a></li>
<li class="line"><a href="<?php echo site_url() ?>/directories/for-your-home/">For Your Home</a></li>
<li class="line"><a href="<?php echo site_url() ?>/directories/health-and-fitness/">Health and Fitness</a></li>
<li class="line"><a href="<?php echo site_url() ?>/directories/medical/">Medical</a></li>
<li class="line"><a href="<?php echo site_url() ?>/directories/mommie-biz/">Mommie Biz</a></li>
<li class="line"><a href="<?php echo site_url() ?>/directories/photographers/">Photographers</a></li>
<li class="line"><a href="<?php echo site_url() ?>/directories/restaurants-and-bars/">Restaurants and Bars</a></li>
<li class="line"><a href="<?php echo site_url() ?>/directories/real-estate/">Real Estate</a></li>
<li><a href="<?php echo site_url() ?>/directories/retail/">Retail</a></li>
</ul>
</li>

<li><a href="#" <?php if ( is_page('thanks') || is_page('contribute') || is_page('new-childcare') || is_page('new-classified') || is_page('new-diaper-exchange') || get_post_type() == 'classifieds' || get_post_type() == 'childcare' || get_post_type() == 'diaper-exchange' ) { echo 'class="current"'; } ?>>Classifieds</a>
<ul>
<li class="line"><a href="<?php echo site_url() ?>/classifieds/">Sell Your Stuff<span><?php echo $count_classifieds->publish; ?></span></a></li>
<li class="line"><a href="<?php echo site_url() ?>/childcare/">Childcare<span><?php echo $count_childcare->publish; ?></span></a></li>
<li><a href="<?php echo site_url() ?>/diaper-exchange/">Diaper Exchange<span><?php echo $count_diaperexchange->publish; ?></span></a></li>
</ul>
</li>

<li><a href="<?php echo site_url() ?>/locations/" <?php if ( is_page('locations') ) { echo 'class="current"'; } ?>>Locations</a></li>

<li class="styles"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/dot.png" class="icon" border="0" width="30" height="22" alt="style" /></a>
<ul>
<li class="line"><a href="<?php echo get_template_directory_uri(); ?>/css/switcher.php?style=pink.css"><img src="<?php echo get_template_directory_uri(); ?>/images/styles-pink.png" border="0" width="20" height="20" alt="style" /></a></li>
<li class="line"><a href="<?php echo get_template_directory_uri(); ?>/css/switcher.php?style=blue.css"><img src="<?php echo get_template_directory_uri(); ?>/images/styles-blue.png" border="0" width="20" height="20" alt="style" /></a></li>
<li><a href="<?php echo get_template_directory_uri(); ?>/css/switcher.php?style=gray.css"><img src="<?php echo get_template_directory_uri(); ?>/images/styles-gray.png" border="0" width="20" height="20" alt="style" /></a></li>
</ul>
</li>

<?php
if ( is_user_logged_in() ) : ?>
<li class="account"><a href="#">My Account

<?php if ($notificationcount >= 1) { ?>
<div id="bubble-flash"><?php echo $notificationcount ?></div>
<?php } else { ?>
<span class="bubble"><?php echo $notificationcount ?></span> 
<?php } ?>

</a>
<ul>
<li class="line"><a href="<?php echo bp_loggedin_user_domain() ?>">Profile</a></li>
<li class="line"><a href="<?php echo bp_loggedin_user_domain() ?>friends/">Friends</a></li>
<li class="line"><a href="<?php echo bp_loggedin_user_domain() ?>friends/requests/">Requests<span><?php echo $friendrequestcount; ?></span></a></li>
<li class="line"><a href="<?php echo bp_loggedin_user_domain() ?>messages/">Messages<span><?php echo $messagecount ?></span></a></li>
<li class="line"><a href="<?php echo bp_loggedin_user_domain() ?>settings/privacy/">Privacy</a></li>
<li><a href="<?php echo bp_loggedin_user_domain() ?>settings/">Settings</a></li>
</ul>
</li>
<?php else : ?>
<li class="register" <?php if ( bp_is_register_page() || bp_is_activation_page() || is_page("register") ) { echo 'class="current"'; } ?>><a href="<?php echo site_url() ?>/register/">Create an Account</a></li>
<?php endif; ?>

</ul>

</div><!-- #menu -->

</div><!-- #header -->

<!-- display notice to members without an image -->
<?php if ( is_user_logged_in() ) : ?>
<?php global $bp; ?>
<?php if( !bp_get_user_has_avatar()) : ?>
<?php endif; ?>
<?php if( !user_has_avatar() ) : ?>
<div id="message" class="warning">
<p>Hi <?php echo bp_get_user_firstname() ?>! We've noticed that you have not yet uploaded your profile image. You can do so from your computer by <a href="<?php echo bp_loggedin_user_domain() ?>profile/change-avatar/">clicking here</a>. We would love for your mommie friends to be able to identify you or your little one.</p>
<br />
</div>
<?php endif; ?>
<?php endif; ?>
<!-- display notice to members without an image -->