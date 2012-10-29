<?php get_header() ?>

<div id="column-one">

<div id="box">
		
			<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>

			<?php do_action( 'bp_before_group_plugin_template' ) ?>


				<?php locate_template( array( 'groups/single/group-header.php' ), true ) ?>



<?php if ( bp_is_group_forum() && bp_group_is_visible() ) : ?>
<?php else : ?>

<div class="group-buttons">
<ul>								
<?php bp_get_options_nav() ?>
<?php if ( has_nav_menu( 'group-menu' ) ) : ?>
<?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'nav', 'theme_location' => 'group-menu', 'items_wrap' => '%3$' ) ); ?>
<?php endif; ?>
<?php do_action( 'bp_group_options_nav' ) ?>
</ul>
</div>
<?php endif; ?>

<br clear="all" />
<div class="line-long"></div>



				<?php do_action( 'bp_before_group_body' ) ?>

				<?php do_action( 'bp_template_content' ) ?>

				<?php do_action( 'bp_after_group_body' ) ?>


			<?php endwhile; endif; ?>

			<?php do_action( 'bp_after_group_plugin_template' ) ?>

</div><!-- #box -->

</div><!-- #column-one -->



<div id="column-two">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('welcome') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('adsforums') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('recent') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('groups') ) : ?><?php endif; ?>			

</div><!-- #column-two -->


<?php get_footer(); ?>