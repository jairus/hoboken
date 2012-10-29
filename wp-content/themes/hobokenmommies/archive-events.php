<?php get_header(); ?>

<div id="column-one">
<div id="box">

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li>Events</li>
</ul>
</div>
</div>

<iframe src="http://hoboken.mommies247.com/calendar/index.php" width="660" height="740" scrolling="no" frameborder="0" style="background-color: #fff"></iframe>

</div><!-- #box -->
</div><!-- #column-one -->

<div id="column-two">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('welcome') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('adsevents') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('recent') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('groups') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('topics') ) : ?><?php endif; ?>			

</div><!-- #column-two -->

<?php get_footer() ?>