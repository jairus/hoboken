<?php get_header(); ?>

<div id="column-one">
<div id="box">

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li>Classifieds</li>
</ul>
</div>
</div>

<div id="archives">

<h2>Classifieds</h2>

<br />

<div class="classified-picker">
<ul>
<li><a href="#" id="allcat" class="current">All</a></li>
<li><a href="#" id="Clothing" class="filter">Clothing</a></li>
<li><a href="#" id="Free-Items" class="filter">Free Items</a></li>
<li><a href="#" id="Gear" class="filter">Gear</a></li>
<li><a href="#" id="Home-Goods-and-Furnishings" class="filter">Home Goods and Furnishings</a></li>
<li><a href="#" id="Miscellaneous" class="filter">Miscellaneous</a></li>
<li><a href="#" id="Real-Estate" class="filter">Real Estate</a></li>
<li><a href="#" id="Toys-and-Play" class="filter">Toys and Play</a></li>
</ul>
<br />
<br />
</div>

<?php $getclassifieds =  new WP_Query( array(
'post_type' 		=> 'classifieds',
'posts_per_page' 	=> '10000'
)); ?>

<?php while($getclassifieds->have_posts()) : $getclassifieds->the_post(); ?>

<?php
$classifiedstitle = get_the_title();

if (strlen($diapertitle) > 23) {
$newclassifiedstitle = substr($$classifiedstitle,0,24) . "...";
} else {
$newclassifiedstitle = substr($classifiedstitle,0,24); }
$classifiedscategory = get_post_meta($post->ID, 'ecpt_classifiedscategory', true);
$classifiedscategorynospace = str_replace (" ", "-", $classifiedscategory);
$classifiedscontact = get_post_meta($post->ID, 'ecpt_classifiedscontact', true);
?>

<div class="classified-item <?php echo $classifiedscategorynospace; ?>">
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-<?php echo $classifiedscategorynospace; ?>.png" alt="Classifieds" width="60" height="60" /></a>
<h3><a href="<?php the_permalink() ?>"><?php echo $newclassifiedstitle; ?></a></h3>
<p class="classified-meta">
<span>Sold by:</span> <?php printf( __( '%s', 'buddypress' ), bp_core_get_userlink( $post->post_author ) ) ?><br />
<span>Posted on:</span> <?php the_time('l, F jS, Y') ?><br />
<span>Category:</span> <?php echo $classifiedscategory; ?><br />
<br clear="all" />
</div>

<?php endwhile; ?>

<br clear="all" />

</div><!-- #archives -->

<div class="line-long"></div>

<p><a href="http://hoboken.mommies247.com/contribute/new-classified/" class="apply">Click Here</a> to submit a new Classified.</p>

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