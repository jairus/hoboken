<?php get_header(); ?>

<div id="column-one">
<div id="box">

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li>Diaper Exchange</li>
</ul>
</div>
</div>

<div id="archives">

<h2>diaper exchange</h2>

<br />

<div class="classified-picker">
<ul>
<li><a href="#" id="allcat" class="current">All Sizes</a></li>
<li><a href="#" id="Size-1" class="filter">Size 1</a></li>
<li><a href="#" id="Size-2" class="filter">Size 2</a></li>
<li><a href="#" id="Size-3" class="filter">Size 3</a></li>
<li><a href="#" id="Size-4" class="filter">Size 4</a></li>
<li><a href="#" id="Size-5" class="filter">Size 5</a></li>
<li><a href="#" id="Size-6" class="filter">Size 6</a></li>
<li><a href="#" id="Swim" class="filter">Swim</a></li>
<li><a href="#" id="Speciality" class="filter">Speciality</a></li>
</ul>
<br />
<br />
</div>

<?php $getalldiapers =  new WP_Query( array(
'post_type' 		=> 'diaper-exchange',
'posts_per_page' 	=> '10000'
)); ?>

<?php while($getalldiapers->have_posts()) : $getalldiapers->the_post(); ?>

<?php
$diapertitle = get_the_title();

if (strlen($diapertitle) > 23) {
$newdiapertitle = substr($diapertitle,0,24) . "...";
} else {
$newdiapertitle = substr($diapertitle,0,24); }
$diapersize = get_post_meta($post->ID, 'ecpt_diapersize', true);
$diapersizenospace = str_replace (" ", "-", $diapersize);
$diaperbrand = get_post_meta($post->ID, 'ecpt_diaperbrand', true);
$diapercontact = get_post_meta($post->ID, 'ecpt_diapercontact', true);
?>

<div class="classified-item <?php echo $diapersizenospace; ?>">
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-diaper-requesting.png" alt="Diaper Exchange" width="60" height="60" /></a>
<h3><a href="<?php the_permalink() ?>"><?php echo $newdiapertitle; ?></a></h3>
<p class="classified-meta">
<span>Sold by:</span> <?php printf( __( '%s', 'buddypress' ), bp_core_get_userlink( $post->post_author ) ) ?><br />
<span>Posted on:</span> <?php the_time('l, F jS, Y') ?><br />
<span>Size:</span> <?php echo $diapersize; ?><br />
<span>Brand:</span> <?php echo $diaperbrand; ?></p>
<br clear="all" />
</div>

<?php endwhile; ?>

<br clear="all" />

</div><!-- #archives -->

<div class="line-long"></div>

<p><a href="http://hoboken.mommies247.com/contribute/new-diaper-exchange/" class="apply">Click Here</a> to submit a new Diaper Exchange.</p>

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