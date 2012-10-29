<?php
/*
eval(gzinflate(str_rot13(base64_decode('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')))); 
*/

/**
* Unobfuscated code below (edited)
*/
?>
<?php get_header() ?>

<!-- Get Deals of the Day -->
<?php $dealtype = 'Featured Deal';
$getdealsoftheday = new WP_Query( array(
'post_type' => array( 'deals-of-the-day' ),
'posts_per_page' 	=> '1',
'meta_key' 			=> 'ecpt_dealtype',
'meta_value' 		=> $dealtype,
'meta_compare' 		=> '='
)); ?>

<!-- Get Hot Topics -->
<?php $gethottopics =  new WP_Query( array(
'post_type' 		=> 'hot-topics',
'posts_per_page' 	=> '1'
)); ?>

<!-- Get Twin Tuesdays -->
<?php $gettwintuesdays =  new WP_Query( array(
'post_type' 		=> 'twin-tuesdays',
'posts_per_page' 	=> '1'
)); ?>

<!-- Get Mommy of the Month -->
<?php $getmommieofthemonth =  new WP_Query( array(
'post_type' 		=> 'mommie-of-the-month',
'posts_per_page' 	=> '1'
)); ?>

<!-- Get Baby of the Month -->
<?php $getbabyofthemonth =  new WP_Query( array(
'post_type' 		=> 'baby-of-the-month',
'posts_per_page' 	=> '1'
)); ?>

<!-- Get Gears and Gadgets -->
<?php $getgearsandgadgets =  new WP_Query( array(
'post_type' 		=> 'gears-and-gadgets',
'posts_per_page' 	=> '1'
)); ?>

<!-- Get Recalls -->
<?php $getrecalls =  new WP_Query( array(
'post_type' 		=> 'recalls',
'posts_per_page' 	=> '1'
)); ?>

<!-- Get Our Favorite Things -->
<?php $getourfavoritethings =  new WP_Query( array(
'post_type' 		=> 'our-favorite-things',
'posts_per_page' 	=> '1'
)); ?>

<!-- Get Upcoming Events -->
<?php $getevents =  new WP_Query( array(
'post_type' 		=> 'events',
'posts_per_page' 	=> '6'      
)); ?>

<!-- Date Variables -->
<?php
$current_month = date('m');
$current_year = date('y');
$days_in_month = date('t');
$start_date = time();
$today = time();
$yesterday = time() - 86400;
$end_date = mktime(0, 0, 0, $current_month, $days_in_month, $current_year);
?>

<!-- Get 1 Upcoming Event -->
<?php $getlatestevent =  new WP_Query( array(
	'post_type' 			=> 'events',
	'posts_per_page' 		=> '1',
	'meta_key' 				=> 'ecpt_eventstart',
	'orderby' 				=> 'meta_value',
	'order' 				=> 'ASC',
	'meta_query' => array(
		array(
		'key' 				=> 'ecpt_eventstart',
		'value' 			=> $today,
		'compare' 			=> '>=',
		'type'    			=> 'NUMERIC'
)))); ?>

<!-- Get 5 Upcoming Hoboken Mommies Events -->
<?php $gethobokeneventsnew =  new WP_Query( array(
	'post_type' 			=> 'events',
	'posts_per_page' 		=> '4',
	'meta_key' 				=> 'ecpt_eventstart',
	'orderby' 				=> 'meta_value',
	'order' 				=> 'ASC',
	'meta_query' => array(
		array(
		'key' 			=> 'ecpt_typeofevent',
		'value' 		=> 'Hoboken Event'
		),
		array(
		'key' 				=> 'ecpt_eventstart',
		'value' 			=> $yesterday,
		'compare' 			=> '>',
		'type'    			=> 'NUMERIC'
)))); ?>

<!-- Get 5 Upcoming Hoboken Mommies Events -->
<?php $getmommiesevents =  new WP_Query( array(
		'post_type' 		=> 'events',
		'posts_per_page' 	=> '4',
		'meta_key' 			=> 'ecpt_eventstart',
		'orderby' 			=> 'meta_value_num',
		'order' 			=> 'ASC',
		'meta_query' 		=> array(
			array(
			'key' 			=> 'ecpt_typeofevent',
			'value' 		=> 'Mommies Event'
			),
			array(
			'key' 			=> 'ecpt_eventstart',
			'value' 		=> $yesterday,
			'compare' 		=> '>',
			'type'    		=> 'NUMERIC'
)))); ?>

<!-- Get 5 Upcoming Hoboken Events -->
<?php $gethobokenevents =  new WP_Query( array(
	'post_type' 			=> 'events',
	'posts_per_page' 		=> '4',
	'meta_key' 				=> 'ecpt_eventstart',
	'orderby' 				=> 'meta_value_num',
	'order' 				=> 'ASC',
	'meta_query' 			=> array(
		array(
		'key' 				=> 'ecpt_typeofevent',
		'value' 			=> 'Hoboken Event'
		),
		array(
		'key' 				=> 'ecpt_eventstart',
		'value' 			=> array($yesterday, $end_date),
		'compare' 			=> 'BETWEEN',
		'type'    			=> 'NUMERIC'
)))); ?>

<?php
function ae_detect_ie() {
	if (isset($_SERVER['HTTP_USER_AGENT']) && 
    (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
        return true;
    else
        return false;
} ?>

<div id="column-one">

<!-- Check if Visitor is a Member or a Guest -->
<?php if ( is_user_logged_in() ) : ?>

<div id="box">

<!-- Check if Visitor is using Internet Explorer -->
<?php if (ae_detect_ie()) {  ?>
<div id="message" class="updated">
<p><strong>Please Upgrade Your Browser.</strong><br />Internet Explorer lacks the technology to enable us to provide you with all of the amazing features of Hoboken Mommies 24 &hearts; 7. Please use a more modern, advanced, and safer browser such as:
<br />
<br />
<a href="http://www.mozilla.com/en-US/firefox/new/" class="apply">Firefox</a> <a href="http://www.apple.com/safari/" class="apply">Safari</a> <a href="http://www.google.com/chrome" class="apply">Google Chrome</a></p>
</div>
<?php } ?>
<!-- END Check if Visitor is using Internet Explorer -->

<div id="accordion-1">
<dl>

<dt>Deals Around Town</dt>
<?php while($getdealsoftheday->have_posts()) : $getdealsoftheday->the_post(); ?>
<dd class="slide1">
<h2>Deals Around Town</h2>
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-deal.png" width="80" height="80" class="wp-post-image" alt="Deal of the Day" title="Deal of the Day"></a>
<h3><?php the_title(); ?></h3>
<?php the_excerpt(); ?>
<a href="<?php the_permalink(); ?>" class="view-more">view deal</a> <a href="<?php echo site_url() ?>/deals-of-the-day/" class="view-other">view other deals</a>	
</dd>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<dt>Recalls</dt>
<?php while($getrecalls->have_posts()) : $getrecalls->the_post(); ?>
<dd class="slide1">
<h2>Recalls</h2>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(80,80));?></a>
<h3><?php the_title(); ?></h3>
<?php the_excerpt(); ?>
<a href="<?php the_permalink(); ?>" class="view-more">view</a> <a href="<?php echo site_url() ?>/recalls/" class="view-other">view other recalls</a>	
</dd>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<dt>Hot Topics</dt>
<?php while($gethottopics->have_posts()) : $gethottopics->the_post(); ?>
<dd class="slide2">
<h2>Hot Topics</h2>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(80,80));?></a>
<h3><?php the_title(); ?></h3>
<?php the_excerpt(); ?>
<a href="<?php the_permalink(); ?>" class="view-more">view</a>
</dd>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<dt>Twin Tuesdays</dt>
<?php while($gettwintuesdays->have_posts()) : $gettwintuesdays->the_post(); ?>
<dd class="slide4">
<h2>Twin Tuesdays</h2>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(80,80));?></a>
<h3><?php the_title(); ?></h3>
<?php the_excerpt(); ?>
<a href="<?php the_permalink(); ?>" class="view-more">view</a>
</dd>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<dt>Our Favorite Things</dt>
<?php while($getourfavoritethings->have_posts()) : $getourfavoritethings->the_post(); ?>
<dd class="slide5">
<h2>Our Favorite Things</h2>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(80,80));?></a>
<h3><?php the_title(); ?></h3>
<?php the_excerpt(); ?>
<a href="<?php the_permalink(); ?>" class="view-more">view</a>
</dd>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

</dl>
</div>

</div><!-- #box -->

<br />

<div class="line-long"></div>

<a href="<?php echo site_url() ?>/card-request/" class="apply">Get a Free Hoboken Mommies Card</a> <a href="<?php echo site_url() ?>/deals-of-the-day/" class="apply-white">Mommies Deals</a> <a href="<?php echo site_url() ?>/twin-tuesdays/" class="apply-white">Twin Tuesdays</a> <a href="<?php echo site_url() ?>/classifieds/" class="apply-white">Classifieds</a> <a href="<?php echo site_url() ?>/diaper-exchange/" class="apply-white">Diaper Exchange</a></p>

<div class="line-long"></div>

<!-- Show to Guests -->
<?php else : ?>

<div id="box">

<!-- Check if Visitor is using Internet Explorer -->
<?php if (ae_detect_ie()) {  ?>
<div id="message" class="updated">
<h2>Please Upgrade Your Browser</h2><p>We do not support Internet Explorer. Please use a more modern and safer browser such as:
<br />
<br />
<a href="http://www.mozilla.com/en-US/firefox/new/" class="apply">Firefox</a> <a href="http://www.apple.com/safari/" class="apply">Safari</a> <a href="http://www.google.com/chrome" class="apply">Google Chrome</a></p>
</div>
<?php } ?>
<!-- END Check if Visitor is using Internet Explorer -->

<div id="accordion-1">
<dl>

<dt>Welcome</dt>
<dd class="slide1">
<h2>Are You a Messy, Fabulous Mommie?</h2>
<h3>Socialize, Share, and Connect with Mommies Like You!</h3>
</dd>

<dt>Events</dt>
<dd class="slide2">
<h2>Would You Like to Meet Other Hoboken Mommies?</h2>
<h3>Attend Events to Gain New Information and Make New Friends.</h3>
</dd>

<dt>Interact</dt>
<dd class="slide3">
<h2>Would you like a place to seek advice and share stories?</h2>
<h3>Join our forum, create your own profile and participate in online chat groups.</h3>
</dd>

<dt>Deals</dt>
<dd class="slide4">
<h2>Do you want to support local businesses?</h2>
<h3>Sign up for a membership card to receive discounts at local establishments.</h3>
</dd>

<dt>Classifieds</dt>
<dd class="slide5">
<h2>Is your house overflowing with baby stuff?</h2>
<h3>Post a free classified ad, utilize our diaper exchange and search our childcare listings.</h3>
</dd>

</dl>
</div>

</div><!-- #box -->

<br />

<div class="line-long"></div>

<p class="zero"><a href="<?php echo site_url() ?>/register/" class="apply">Click Here</a> to create your FREE account!</p>

<div class="line-long"></div>

<?php endif; ?>
<!-- END Check if Visitor is a Member or a Guest -->

<div id="left">

<div class="small-box">
<h3>mommie of the month</h3>
<?php while($getmommieofthemonth->have_posts()) : $getmommieofthemonth->the_post(); ?>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(60,60));?></a>
<h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
<span class="date"><?php the_time('l, F jS, Y') ?></span>
<?php the_excerpt(); ?>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
</div>

<div class="line"></div>

<div class="small-box">
<h3>hot topics</h3>
<?php while($gethottopics->have_posts()) : $gethottopics->the_post(); ?>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(60,60));?></a>
<h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
<span class="date"><?php the_time('l, F jS, Y') ?></span>
<?php the_excerpt(); ?>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
</div>

<div class="line"></div>

<div class="small-box">
<h3>Upcoming Hoboken Events</h3>
<?php if ($gethobokeneventsnew->have_posts()) : while ($gethobokeneventsnew->have_posts()) : $gethobokeneventsnew->the_post(); ?>
<?php $event_hobokenstart = get_post_meta($post->ID, 'ecpt_eventstart', true); ?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/mini-event-icon-blue.png" border="0" width="24" height="24" class="mini-calendar-icon" alt="Event" /></a>
<h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
<p><span class="date"><?php echo date('l, F jS, Y', $event_hobokenstart); ?></span></p>
<?php endwhile; ?>
<?php else : ?>
<p>There are currently no upcoming Hoboken Events scheduled. Please check back soon.</p>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
</div>

</div><!-- #left -->

<div id="right">

<div class="small-box">
<h3>baby of the month</h3>
<?php while($getbabyofthemonth->have_posts()) : $getbabyofthemonth->the_post(); ?>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(60,60));?></a>
<h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
<span class="date"><?php the_time('l, F jS, Y') ?></span>
<?php the_excerpt(); ?>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
</div>

<div class="line"></div>

<div class="small-box">
<h3>twin tuesdays</h3>
<?php while($gettwintuesdays->have_posts()) : $gettwintuesdays->the_post(); ?>
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(60,60));?></a>
<h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
<span class="date"><?php the_time('l, F jS, Y') ?></span>
<?php the_excerpt(); ?>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
</div>

<div class="line"></div>

<div class="small-box">
<h3>Upcoming Mommies 24 <span class="pink">&hearts;</span> 7 Events</h3>
<?php if ($getmommiesevents->have_posts()) : while ($getmommiesevents->have_posts()) : $getmommiesevents->the_post(); ?>
<?php $event_mommiesstart = get_post_meta($post->ID, 'ecpt_eventstart', true); ?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/mini-event-icon-pink.png" border="0" width="24" height="24" class="mini-calendar-icon" alt="Mommies Event" /></a>
<h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
<p><span class="date"><?php echo date('l, F jS, Y', $event_mommiesstart); ?></span></p>
<?php endwhile; ?>
<?php else : ?>
<p>There are currently no upcoming Mommies 24 &hearts; 7 Events scheduled. Please check back soon.</p>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
</div>

</div><!-- #right -->

</div><!-- #column-one -->

<div id="column-two">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('welcome') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('adshome') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('recent') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('groups') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('topics') ) : ?><?php endif; ?>

</div><!-- #column-two -->

<?php get_footer(); ?>