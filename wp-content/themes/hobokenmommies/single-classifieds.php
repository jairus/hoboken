<?php get_header() ?>

<?php if ( is_user_logged_in() ) : ?>

<div id="column-one">
<div id="box">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li><a href="<?php echo site_url() ?>/classifieds/">Classifieds</a></li>
<li><?php the_title(); ?></li>
</ul>
</div>
</div>
				
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
$classifiedscontact = get_post_meta($post->ID, 'ecpt_classifiedscontact', true);
$classifiedscategory = get_post_meta($post->ID, 'ecpt_classifiedscategory', true);
$classifiedstegorynospace = str_replace (" ", "-", $classifiedscategory);
$classifiedsexpires = get_post_meta($post->ID, 'ecpt_classifiedsexpires', true);
?>


<img src="<?php echo get_template_directory_uri(); ?>/images/icon-<?php echo $classifiedstegorynospace; ?>.png" class="attachment-60x60 wp-post-image" alt="Classifieds" width="60" height="60" />
	
<div class="meta">

<h2><?php the_title(); ?></h2>
		
<p>Posted on <?php the_time('l, F jS, Y') ?><br />
<?php printf( __( 'Being sold by %s', 'buddypress' ), bp_core_get_userlink( $post->post_author ) ) ?></p>

</div>

<br clear="all" />
<br />

<div class="event-meta">
<div class="left">
<span>Sold by</span>
</div>
<div class="right">
<span><?php printf( __( '%s', 'buddypress' ), bp_core_get_userlink( $post->post_author ) ) ?></span>
</div>
</div>

<br clear="all">

<div class="event-meta">
<div class="left">
<span>Category</span>
</div>
<div class="right">
<span><?php echo $classifiedscategory; ?></span>
</div>
</div>

<br clear="all">

<div class="event-meta">
<div class="left">
<span>Contact</span>
</div>
<div class="right">
<span><?php echo $classifiedscontact; ?></span>
</div>
</div>

<br clear="all">

<div class="event-meta">
<div class="left">
<span>Expires</span>
</div>
<div class="right">
<span><?php echo $classifiedsexpires; ?></span>
</div>
</div>

<br clear="all">
<br />

<div class="entry">
<?php the_content(); ?>
</div><!-- .entry -->

<br />
<div id="message" class="info">
<p>Our Hoboken Mommies Sell Your Stuff section has been designed as a place where members can buy, sell, or giveaway a variety of items. Such items include: Clothing, Gear, Home Goods and Furnishings, and Toys and Play. All advertisements have been submitted independently by members. Hoboken Mommies does not accept any responsibility for unsatisfactory purchases or experiences.</p>
</div>
						
</div><!-- #post -->

<div class="line-long"></div>

<p><a href="http://www.hobokenmommies.com/contribute/new-classified/" class="apply">Click Here</a> to submit a new Classified.</p>

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
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('topics') ) : ?><?php endif; ?>		

</div><!-- #column-two -->

<?php else : ?>

<div id="message">
<h2>Classifieds</h2>
<p>You need to <a href="http://www.hobokenmommies.com/">log in</a> or <a class="create-account" href="http://www.hobokenmommies.com/register/" title="Create an account">create an account</a> to view this section.</p>
</div>
		
<?php endif; ?>

<?php get_footer() ?>