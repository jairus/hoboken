<?php get_header() ?>

<?php if ( is_user_logged_in() ) : ?>

<div id="column-one">
<div id="box">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li><a href="<?php echo site_url() ?>/events/">Events</a></li>
<li><?php the_title(); ?></li>
</ul>
</div>
</div>
				
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-event.png" border="0" width="60" height="60" class="attachment-60x60 wp-post-image" alt="Event" /></a>
	
<div class="meta">

<h2><?php the_title(); ?></h2>
<p>Posted on <?php the_date('F j, Y') ?> at <?php the_time() ?><br />
<?php printf( __( 'Created by %s', 'buddypress' ), bp_core_get_userlink( $post->post_author ) ) ?></p>

</div>

<?php

$paypal_options = get_option('ng_paypal_settings');
$business_email = false;
if($paypal_options) {
  $business_email = $paypal_options['business_email'];
}
$date_month = get_post_meta($post->ID, 'ecpt_eventdatemonth', true);
$date_day = get_post_meta($post->ID, 'ecpt_eventdateday', true);
$date_year = get_post_meta($post->ID, 'ecpt_eventdateyear', true);
$full_date = $date_year."-".$date_month."-".$date_day;
$event_date = date("l, F jS, Y", strtotime($full_date));
$event_hour = get_post_meta($post->ID, 'ecpt_eventhour', true);
$event_minute = get_post_meta($post->ID, 'ecpt_eventminute', true);
$event_hourminute = $event_hour .":". $event_minute;
$event_time = date('g:ia', strtotime($event_hourminute));
$event_location = get_post_meta($post->ID, 'ecpt_eventlocation', true);
$event_address = get_post_meta($post->ID, 'ecpt_eventaddress', true);
$event_city = get_post_meta($post->ID, 'ecpt_eventcity', true);
$event_state = get_post_meta($post->ID, 'ecpt_eventstate', true);
$event_zip = get_post_meta($post->ID, 'ecpt_eventzip', true);
$event_price = get_post_meta($post->ID, 'ecpt_eventprice', true);
$event_invoice = get_post_meta($post->ID, 'ecpt_eventinvoice', true);
$event_type = get_post_meta($post->ID, 'ecpt_typeofevent', true);
$event_start = get_post_meta($post->ID, 'ecpt_eventstart', true);
$event_item_name = get_post_meta($post->ID, 'ecpt_itemname', true);
$event_payments_enabled = get_post_meta($post->ID, 'ecpt_paymentsenabled', true);
?>

<div class="line-long"></div>
<br />

<div class="event-meta">
<div class="left">
<span>Type</span>
</div>
<div class="right">
<span><?php echo $event_type; ?></span>
</div>
</div>

<br clear="all" />

<div class="event-meta">
<div class="left">
<span>Date</span>
</div>
<div class="right">
<span><strong><?php echo date('l, F jS, Y', $event_start); ?></strong></span>
</div>
</div>

<br clear="all" />

<div class="event-meta">
<div class="left">
<span>Time</span>
</div>
<div class="right">
<span><?php echo $event_time; ?></span>
</div>
</div>

<br clear="all" />

<div class="event-meta">
<div class="left">
<span>Location</span>
</div>
<div class="right">
<span><?php echo $event_location; ?></span>
</div>
</div>

<br clear="all" />

<div class="event-meta">
<div class="left">
<span>Address</span>
</div>
<div class="right">
<span><?php echo $event_address; ?></span><br /><span><?php echo $event_city; ?>, <?php echo $event_state; ?> <?php echo $event_zip; ?></span>
</div>
</div>

<br clear="all" />

<?php if (!$event_price) { } else {
?>

<br />
<div class="event-meta">
<div class="left">
<span>Event Price</span>
</div>
<div class="right">
<span><strong>$<?php echo $event_price; ?></strong></span>
</div>
</div>

<br clear="all" />

<?php } ?>
<?php if ($event_payments_enabled && $business_email && $event_item_name && $event_price):
/*
?>
<!--<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="<?php echo $business_email; ?>">
  <input type="hidden" name="currency_code" value="USD">
  <input type="hidden" name="item_name" value="<?php echo $event_item_name; ?>">
  <input type="hidden" name="amount" value="<?php echo $event_price; ?>">
  <input type="hidden" name="shipping" value="0.00">
  <input type="hidden" name="handling" value="0.00">
  <input type="hidden" name="no_shipping" value="1">
  <input type="hidden" name="no_note" value="1">
  <input type="image" src="<?php echo get_bloginfo('template_directory');?>/images/paypal-button.png" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>-->
<?php
*/

/**
* START PAYPAL REQUEST
*/

$paypal_data = array(
    "METHOD" => "BMCreateButton",
    "VERSION" => "65.2",
    "USER" => "info_api1.mommies247.com",
    "PWD" => "DQA35LM4UQSH8PPX",
    "SIGNATURE" => "AQG8qvDIqUIBDu8R-L8vXIGf8fG8Ap7Nv8VOoZnVJ5DO3bcBN5u9WbqY",
    "BUTTONCODE" => "ENCRYPTED",
    "BUTTONTYPE" => "BUYNOW",
    "BUTTONSUBTYPE" => "SERVICES",
    "BUTTONCOUNTRY" => "US",
    "BUTTONIMAGE" => "reg",
    "BUYNOWTEXT" => "BUYNOW",
    "L_BUTTONVAR1" => "item_number=$event_invoice",
    "L_BUTTONVAR2" => "item_name=$event_item_name",
    "L_BUTTONVAR3" => "amount=$event_price",
    "L_BUTTONVAR4" => "currency_code=USD",
    "L_BUTTONVAR5" => "no_shipping=1",
    "L_BUTTONVAR6" => "no_note=1",
    "L_BUTTONVAR7" => "handling=0.00",
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_URL, 'https://api-3t.paypal.com/nvp?'.http_build_query($paypal_data));
$response = curl_exec($curl);
curl_close($curl);

$decoded = urldecode($response);
$decoded = str_replace('WEBSITECODE=', '', $decoded);
$decoded = str_replace('https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif', get_bloginfo('template_directory').'/images/paypal-button.png', $decoded);
$decoded = array_shift(explode('&EMAILLINK=', $decoded));

echo $decoded;

/**
* END PAYPAL REQUEST
*/

 endif; ?>

<br />

<div class="entry">
<?php the_content(); ?>
</div><!-- .entry -->
						
</div><!-- #post -->

<br />
<?php if ($event_type == "Hoboken Event") { ?>
<div id="message" class="info">
<p>Hoboken Mommies strives to provide its members with a listing of a variety of events taking place in Hoboken. Our Hoboken events descriptions and links have been aggregated from outside sources. These events have not been organized by Hoboken Mommies, and therefore, Hoboken Mommies takes no responsibility for any occurrences related to such outside events.</p>
</div>  
<?php } ?>

<?php if ($event_type == "Mommies Event") { ?>
<div id="message" class="info">
<p>Hoboken Mommies looks forward to seeing you at our events. Events have been planned with great care and detail. We understand that situations arise beyond your control that may keep you from attending an event for which you have RSVP'd. Hoboken Mommies will refund 100% of your money if your reservation is cancelled within 48 hours of the event.  If you fail to appear at the scheduled event or do not cancel within 48 hours prior, Hoboken Mommies will be unable to grant your refund.</p><p>In the event of inclement weather, Hoboken Mommies will contact all members via email with cancellation and rescheduling information. If you are unable to attend the rescheduled date, you will receive 100% reimbursement.</p>
</div> 
<?php } ?>

<?php endwhile; else: ?>

<p><?php _e( 'Sorry, no posts matched your criteria.', 'buddypress' ) ?></p>

<?php endif; ?>

</div><!-- #box -->
</div><!-- #column-one -->


<div id="column-two">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('welcome') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('adsevents') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('recent') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('groups') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('topics') ) : ?><?php endif; ?>		

</div><!-- #column-two -->

<?php else : ?>

<div id="message">
<h2>Events</h2>
<p>You need to <a href="http://www.hobokenmommies.com/">log in</a> or <a class="create-account" href="http://www.hobokenmommies.com/register/" title="Create an account">create an account</a> to view this section.</p>
</div>
		
<?php endif; ?>

<?php get_footer() ?>