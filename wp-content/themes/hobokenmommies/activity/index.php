<?php

/**
 * BuddyPress - Activity Directory
 *
 * @package BuddyPress
 * @subpackage BuddyBoss
 */
 
?>

<?php get_header( 'buddypress' ); ?>

<?php
global $bp;
$fav_tab_text = BUDDY_BOSS_WALL_ENABLED ? 'My Likes' : 'My Favorites';
?>

<?php if ( is_user_logged_in() ) : ?>

<div id="column-one">
<div id="box">

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li>Activity</li>
</ul>
</div>
</div>


<?php locate_template( array( 'activity/post-form.php'), true ) ?>

<?php do_action( 'template_notices' ) ?>
			
<br />

			<div class="item-list-tabs activity-type-tabs" role="navigation">
				<ul>
					<?php do_action( 'bp_before_activity_type_tab_all' ) ?>

					<li class="selected" id="activity-all"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' ?>" title="<?php _e( 'The public activity for everyone on this site.', 'buddypress' ) ?>"><?php printf( __( 'All Members <span>(%s)</span>', 'buddypress' ), bp_get_total_site_member_count() ) ?></a></li>

					<?php if ( is_user_logged_in() ) : ?>

						<?php do_action( 'bp_before_activity_type_tab_friends' ) ?>

						<?php if ( bp_is_active( 'friends' ) ) : ?>

							<?php if ( bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>

								<li id="activity-friends"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_friends_slug() . '/' ?>" title="<?php _e( 'The activity of my friends only.', 'buddypress' ) ?>"><?php printf( __( 'My Friends <span>(%s)</span>', 'buddypress' ), bp_get_total_friend_count( bp_loggedin_user_id() ) ) ?></a></li>

							<?php endif; ?>

						<?php endif; ?>

						<?php do_action( 'bp_before_activity_type_tab_groups' ) ?>

						

						<?php do_action( 'bp_before_activity_type_tab_favorites' ) ?>

						<?php if ( bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) ) : ?>

							<li id="activity-favorites"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/favorites/' ?>" title="<?php _e( "The activity I've marked as a favorite.", 'buddypress' ) ?>"><?php printf( __( '%s <span>(%s)</span>', 'buddypress' ), $fav_tab_text, bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) ) ?></a></li>

						<?php endif; ?>

						<?php do_action( 'bp_before_activity_type_tab_mentions' ) ?>

						

					<?php endif; ?>

					<?php do_action( 'bp_activity_type_tabs' ) ?>
					
					<div class="feed">&nbsp;</div>
					
				</ul>
			</div><!-- .item-list-tabs -->
			
			<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
				<ul>

					<?php do_action( 'bp_activity_syndication_options' ) ?>

					<li id="activity-filter-select" class="last">
						<label for="activity-filter-by"><?php _e( 'Show:', 'buddypress' ); ?></label> 
						<select id="activity-filter-by">
							<option value="-1"><?php _e( 'Everything', 'buddypress' ) ?></option>
							<option value="activity_update"><?php _e( 'Updates', 'buddypress' ) ?></option>

							<?php if ( bp_is_active( 'forums' ) ) : ?>

								<option value="new_forum_topic"><?php _e( 'Forum Topics', 'buddypress' ); ?></option>
								<option value="new_forum_post"><?php _e( 'Forum Replies', 'buddypress' ); ?></option>

							<?php endif; ?>

							<?php do_action( 'bp_activity_filter_options' ); ?>

						</select>
					</li>
				</ul>
			</div><!-- .item-list-tabs -->


			<?php do_action( 'bp_before_directory_activity_list' ) ?>

			<div class="activity" role="main">

				<?php locate_template( array( 'activity/activity-loop.php' ), true ) ?>

			</div><!-- .activity -->

			<?php do_action( 'bp_directory_activity_content' ) ?>

			<?php do_action( 'bp_after_directory_activity_content' ) ?>


</div><!-- #box -->
</div><!-- #column-one -->


<div id="column-two">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('welcome') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('adspages') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('recent') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('groups') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('topics') ) : ?><?php endif; ?>				

</div><!-- #column-two -->

<?php else : ?>

<div id="message">
<h2>Activity</h2>
<p>You need to <a href="http://www.hobokenmommies.com/">log in</a> or <a class="create-account" href="http://www.hobokenmommies.com/register/" title="Create an account">create an account</a> to view this section.</p>
</div>
		
<?php endif; ?>

<?php get_footer() ?>