<?php get_header(); ?>

<div id="column-one">
<div id="box">

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li>Page not Found</li>
</ul>
</div>
</div>

		<?php do_action( 'bp_before_404' ) ?>

		<div class="page 404">

			<div id="message" class="info">

<p>The page you were looking for was not found. If you're having technical problems, feel free to get in touch with us at: <a href="mailto:info@hobokenmommies.com">info@hobokenmommies.com</a></p>

			</div>

			<?php do_action( 'bp_404' ) ?>

		</div>

		<?php do_action( 'bp_after_404' ) ?>
		
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