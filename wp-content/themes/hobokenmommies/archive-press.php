<?php get_header(); ?>

<div id="column-one">
<div id="box">

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li>Press</li>
</ul>
</div>
</div>

<div id="archives">
<ul>
<?php while (have_posts()) : the_post(); ?>
<li>
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-press.png" class="attachment-60x60 wp-post-image" alt="Press" width="60" height="60" /></a>
<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
<p class="meta">
<span class="date"><?php the_time('l, F jS, Y') ?></span>
</p>
<br clear="all" />
<br />
</li>
<?php endwhile; ?>
</ul>

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