<?php get_header() ?>

<div id="column-one">
<div id="box">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li><a href="<?php echo site_url() ?>/locations/">Locations</a></li>
<li><?php the_title(); ?></li>
</ul>
</div>
</div>
				
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(90,90));?></a>
	
<div class="meta">

<h2><?php the_title(); ?></h2>

</div>

<br />

<div class="entry">
<?php the_content(); ?>
</div><!-- .entry -->
						
</div><!-- #post -->

<div class="line-long"></div>

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

<?php get_footer() ?>