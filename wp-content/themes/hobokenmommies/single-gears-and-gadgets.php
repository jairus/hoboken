<?php get_header() ?>

<div id="column-one">
<div id="box">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li><a href="<?php echo site_url() ?>/gears-and-gadgets/">Gears and Gadgets</a></li>
<li><?php the_title(); ?></li>
</ul>
</div>
</div>
				
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(60,60));?></a>
	
<div class="meta">

<h2><?php the_title(); ?></h2>
		
<p>Posted on <?php the_time('l, F jS, Y') ?><br />
<?php printf( __( 'Written by %s', 'buddypress' ), bp_core_get_userlink( $post->post_author ) ) ?></p>

</div>

<div class="line-long"></div>

<div class="entry">
<?php the_content(); ?>
</div><!-- .entry -->
						
</div><!-- #post -->

<br />
<div id="message" class="info">
<p>Each day a new gear or gadget appears on the market to make our lives easier or to make our babies happier.  HobokenMommies.com is fortunate enough to have Selena from Bambi Baby updating us with the latest and greatest in baby products.  While Selena is supplying us with her recommendations, we encourage our mommies to explore the wide variety of other products geared toward enriching the lives of our little ones.</p>
</div>

<div class="line-long"></div>
<br />
					
<?php comments_template(); ?>

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
<h3>recent <a href="<?php echo site_url() ?>/gears-and-gadgets/">gears &amp; gadgets</a></h3>
<?php $getrecentgadgets =  new WP_Query( array(
        'post_type' 		=> 'gears-and-gadgets',
        'posts_per_page' 	=> '4'
)); ?>
<ul>
<?php while($getrecentgadgets->have_posts()) : $getrecentgadgets->the_post(); ?>
<li><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(30,30));?></a><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> 
<span><?php printf( __( 'by %s', 'buddypress' ), bp_core_get_userlink( $post->post_author ) ) ?></span></li>
<?php endwhile; ?>
</ul>
<?php wp_reset_postdata(); ?>
</div>
<div class="line"></div>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('topics') ) : ?><?php endif; ?>		

</div><!-- #column-two -->

<?php get_footer() ?>