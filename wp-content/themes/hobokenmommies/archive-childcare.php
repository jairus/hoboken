<?php get_header(); ?>

<div id="column-one">
<div id="box">

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li>Childcare</li>
</ul>
</div>
</div>

<div id="archives">

<h2>childcare</h2>

<br />

<div class="classified-picker">
<ul>
<li><a href="#" id="allcat" class="current">All Services</a></li>
<li><a href="#" id="Offering" class="filter">Offering Service</a></li>
<li><a href="#" id="Requesting" class="filter">Requesting Service</a></li>
</ul>
<br />
<br />
</div>

<div class="line-long-home"></div>

<?php $getallchildcare =  new WP_Query( array(
'post_type' 		=> 'childcare',
'posts_per_page' 	=> '10000'
)); ?>

<?php while($getallchildcare->have_posts()) : $getallchildcare->the_post(); ?>

<?php
$childcaretitle = get_the_title();
if (strlen($childcaretitle) > 23) {
$newchildcaretitle = substr($childcaretitle,0,24) . "...";
} else {
$newchildcaretitle = substr($childcaretitle,0,24); }
$childcarecategory = get_post_meta($post->ID, 'ecpt_childcarecategory', true);
$childcarecategorynospace = str_replace (" ", "-", $childcarecategory);
?>

<div class="classified-item <?php echo $childcarecategorynospace ?>">
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-childcare.png" alt="Childcare" width="60" height="60" /></a>
<h3><a href="<?php the_permalink() ?>"><?php echo $newchildcaretitle; ?></a></h3>
<p class="classified-meta">
<span>By:</span> <?php printf( __( '%s', 'buddypress' ), bp_core_get_userlink( $post->post_author ) ) ?><br />
<span>Posted on:</span> <?php the_time('l, F jS, Y') ?><br />
<span>Type:</span> <?php echo $childcarecategory; ?> Service</p>
<br clear="all" />
</div>

<?php endwhile; ?>

</div><!-- #archives -->

<div class="line-long"></div>

<p><a href="http://hoboken.mommies247.com/contribute/new-childcare/" class="apply">Click Here</a> to submit a Childcare service request or offering.</p>

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