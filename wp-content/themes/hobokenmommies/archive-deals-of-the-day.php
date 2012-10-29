<?php get_header(); ?>

<div id="column-one">
<div id="box">

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li>Deals of the Day</li>
</ul>
</div>
</div>

<div id="archives">
<?php while (have_posts()) : the_post(); ?>

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
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-deal-featured.png" class="attachment-60x60 wp-post-image" alt="Deal" width="60" height="60" /></a>
<?php } else { ?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-deal-ongoing.png" class="attachment-60x60 wp-post-image" alt="Deal" width="60" height="60" /></a>
<?php } ?>

<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
<p class="meta">
<span class="item">Location:</span><?php echo $dealestablishmenttitle; ?>
<br />
<span class="item">Deal Type:</span><?php echo $dealtype; ?>

<?php if (!$dealexpires) { ?>
<?php } else { ?>
<em>(expires: <?php echo $dealexpires; ?>)</em>
<?php } ?>
</p>

<div class="dashed"></div>

<?php endwhile; ?>

<div class="line-long"></div>
<?php wp_pagenavi(); ?>

</div><!-- #archives -->

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