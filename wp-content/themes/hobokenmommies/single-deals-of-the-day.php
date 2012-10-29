<?php get_header() ?>

<?php if ( is_user_logged_in() ) : ?>

<div id="column-one">
<div id="box">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li><a href="<?php echo site_url() ?>/deals-of-the-day/">Deals of the Day</a></li>
<li><?php the_title(); ?></li>
</ul>
</div>
</div>
				
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
$dealestablishmenttitle = get_post_meta($post->ID, 'ecpt_dealestablishmenttitle', true);
$dealaddress = get_post_meta($post->ID, 'ecpt_dealaddress', true);
$dealcity = get_post_meta($post->ID, 'ecpt_dealcity', true);
$dealstate = get_post_meta($post->ID, 'ecpt_dealstate', true);
$dealzip = get_post_meta($post->ID, 'ecpt_dealzip', true);
$dealtype = get_post_meta($post->ID, 'ecpt_dealtype', true);
$dealexpires = get_post_meta($post->ID, 'ecpt_dealexpires', true);
?>

<?php if ($dealtype == "Featured Deal") { ?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-deal-featured.png" class="attachment-60x60 wp-post-image" alt="childcare" width="60" height="60" /></a>
<?php } else { ?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-deal-ongoing.png" class="attachment-60x60 wp-post-image" alt="childcare" width="60" height="60" /></a>
<?php } ?>
	
<div class="meta">

<h2><?php the_title(); ?></h2>
		
<p>Posted on <?php the_time('l, F jS, Y') ?>><br />
<?php printf( __( 'Posted by %s', 'buddypress' ), bp_core_get_userlink( $post->post_author ) ) ?></p>

</div>

<div class="line-long"></div>
<br />

<div class="event-meta">
<div class="left">
<span>Deal Type</span>
</div>
<div class="right">
<span><?php echo $dealtype; ?> 
<?php if (!$dealexpires) { ?>
<?php } else { ?>
<em>(expires: <?php echo $dealexpires; ?>)</em>
<?php } ?>
</span>
</div>
</div>

<br clear="all">

<div class="event-meta">
<div class="left">
<span>Location</span>
</div>
<div class="right">
<span><?php echo $dealestablishmenttitle; ?></span>
</div>
</div>

<br clear="all">

<div class="event-meta">
<div class="left">
<span>Address</span>
</div>
<div class="right">
<span><?php echo $dealaddress; ?><br /><?php echo $dealcity; ?>, <?php echo $dealstate; ?> <?php echo $dealzip; ?></span>
</div>
</div>

<br />
<br clear="all">

<div class="entry">
<?php the_content(); ?>
</div><!-- .entry -->

<br />
<div id="message" class="info">
<p>Hoboken Mommies strives to bring irresistible deals to our members. We want you to have the opportunity to explore local vendors, restaurants, and establishments with the added bonus of receiving the Hoboken Mommies member discount.  All deals are purchased from and implemented by our vendors. The advertised deals have no relation to the Hoboken Mommies website, therefore, voiding Hoboken Mommies from any and all responsibility in regards to dissatisfaction.</p>
</div>
						
</div><!-- #post -->

<?php endwhile; else: ?>

<p><?php _e( 'Sorry, no posts matched your criteria.', 'buddypress' ) ?></p>

<?php endif; ?>

</div><!-- #box -->
</div><!-- #column-one -->


<div id="column-two">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('welcome') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('adspages') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('recent') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('groups') ) : ?><?php endif; ?>
<div class="recent">
<h3>recent <a href="<?php echo site_url() ?>/deal-of-the-day/">deals of the day</a></h3>
<?php $getrecentdeals =  new WP_Query( array(
        'post_type' 		=> 'deals-of-the-day',
        'posts_per_page' 	=> '4'
)); ?>
<ul>
<?php while($getrecentdeals->have_posts()) : $getrecentdeals->the_post(); ?>
<?php
$dealestablishmenttitle = get_post_meta($post->ID, 'ecpt_dealestablishmenttitle', true);
$dealaddress = get_post_meta($post->ID, 'ecpt_dealaddress', true);
$dealcity = get_post_meta($post->ID, 'ecpt_dealcity', true);
$dealstate = get_post_meta($post->ID, 'ecpt_dealstate', true);
$dealzip = get_post_meta($post->ID, 'ecpt_dealzip', true);
$dealwebsite = get_post_meta($post->ID, 'ecpt_dealwebsite', true);
$dealtype = get_post_meta($post->ID, 'ecpt_dealtype', true);
$dealexpires = get_post_meta($post->ID, 'ecpt_dealexpires', true);
?>
<li><?php if ($dealtype == "Featured Deal") { ?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-deal-featured.png" class="attachment-60x60 wp-post-image" alt="childcare" width="30" height="30" /></a>
<?php } else { ?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-deal-ongoing.png" class="attachment-60x60 wp-post-image" alt="childcare" width="30" height="30" /></a>
<?php } ?><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><span><?php printf( __( 'by %s', 'buddypress' ), bp_core_get_userlink( $post->post_author ) ) ?></span></li>
<?php endwhile; ?>
</ul>
<?php wp_reset_postdata(); ?>
</div>
<div class="line"></div>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('topics') ) : ?><?php endif; ?>		

</div><!-- #column-two -->

<?php else : ?>

<div id="message">
<h2>Deals of the Day</h2>
<p>You need to <a href="http://www.hobokenmommies.com/">log in</a> or <a class="create-account" href="http://www.hobokenmommies.com/register/" title="Create an account">create an account</a> to view this section.</p>
</div>
		
<?php endif; ?>

<?php get_footer() ?>