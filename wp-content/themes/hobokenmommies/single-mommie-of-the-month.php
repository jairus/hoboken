<?php get_header() ?>

<div id="column-one">
<div id="box">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li><a href="<?php echo site_url() ?>/mommie-of-the-month/">Mommie of the Month</a></li>
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

<?php $question1 = get_post_meta($post->ID, 'ecpt_question1', true); ?>
<?php $question2 = get_post_meta($post->ID, 'ecpt_question2', true); ?>
<?php $question3 = get_post_meta($post->ID, 'ecpt_question3', true); ?>
<?php $question4 = get_post_meta($post->ID, 'ecpt_question4', true); ?>
<?php $question5 = get_post_meta($post->ID, 'ecpt_question5', true); ?>
<?php $question6 = get_post_meta($post->ID, 'ecpt_question6', true); ?>

<div class="entry">
<?php the_content(); ?>
<p><strong>What's your favorite part about being a Hoboken Mommie?</strong></p>
<p><em><?php echo $question1; ?></em></p>
<p><strong>What is your favorite Mommie Moment?</strong></p>
<p><em><?php echo $question2; ?></em></p>
<p><strong>Tell us about your funniest moment as a new Mommie?</strong></p>
<p><em><?php echo $question3; ?></em></p>
<p><strong>How was the transition back to work?</strong></p>
<p><em><?php echo $question4; ?></em></p>
<p><strong>Best piece of advice for new Mommies?</strong></p>
<p><em><?php echo $question5; ?></em></p>
<p><strong>What is your favorite Mommie and baby activity?</strong></p>
<p><em><?php echo $question6; ?></em></p>
</div><!-- .entry -->
		
</div><!-- #post -->

<br />
<div id="message" class="info">
<p>Mommies have a special job and they deserve to be recognized for their hard work.  Each month, Hoboken Mommies will identify a mom that stands out for going above and beyond for all those that surround her.  Our Mommie of the Month will be selected via both our forum and through member submissions.  We are looking for women who often offer advice and lend a friendly ear to our other members.  If you would like to submit a description of an exemplary mom, please email us at <a href="mailto:info@hobokenmommies.com">info@hobokenmommies.com</a> with your submission and contact information.</p>
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
<h3>recent <a href="<?php echo site_url() ?>/mommie-of-the-month/">mommies of the month</a></h3>
<?php $getmommieofthemonth =  new WP_Query( array(
        'post_type' 		=> 'mommie-of-the-month',
        'posts_per_page' 	=> '4'
)); ?>
<ul>
<?php while($getmommieofthemonth->have_posts()) : $getmommieofthemonth->the_post(); ?>
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