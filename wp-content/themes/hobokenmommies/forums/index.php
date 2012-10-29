<?php

/**
 * BuddyPress - Forums Directory
 *
 * @package BuddyPress
 * @subpackage BuddyBoss
 */

?>

<?php get_header( 'buddypress' ); ?>

<?php if ( is_user_logged_in() ) : ?>
	
<div id="column-one">

<div id="box">

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li>Forums</li>
</ul>
</div>
</div>

<br />

<?php if ( is_user_logged_in() ) : ?>
<div class="start-new-topic"><a class="button show-hide-new" href="#new-topic" id="new-topic-button"><?php _e( 'New Topic', 'buddypress' ); ?></a></div>
<?php endif; ?>

<div id="forums-dir-search" class="dir-search">
<?php bp_directory_forums_search_form() ?>
</div>

<br />
<br />
		
<form action="" method="post" id="forums-search-form" class="dir-form">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="entry-directory">
						<?php the_content(); ?>
					</div>
				<?php endwhile; endif; ?>
							
			</form>
			
			<?php do_action( 'bp_before_topics' ); ?>

			<form action="" method="post" id="forums-directory-form" class="dir-form">

				<div class="item-list-tabs" role="navigation">
					<ul>
						<li class="selected" id="forums-all"><a href="<?php echo trailingslashit( bp_get_root_domain() . '/' . bp_get_forums_root_slug() ); ?>"><?php printf( __( 'All Topics <span>(%s)</span>', 'buddypress' ), bp_get_forum_topic_count() ); ?></a></li>

						<?php if ( is_user_logged_in() && bp_get_forum_topic_count_for_user( bp_loggedin_user_id() ) ) : ?>

							<li id="forums-personal"><a href="<?php echo trailingslashit( bp_loggedin_user_domain() . bp_get_forums_slug() . '/topics' ); ?>"><?php printf( __( 'My Topics <span>(%s)</span>', 'buddypress' ), bp_get_forum_topic_count_for_user( bp_loggedin_user_id() ) ); ?></a></li>

						<?php endif; ?>

						<?php do_action( 'bp_forums_directory_group_types' ); ?>
						
						<?php do_action( 'bp_forums_directory_group_sub_types' ); ?>
						
						

					</ul>
				</div>

				<div id="forums-dir-list" class="forums dir-list" role="main">

					<?php locate_template( array( 'forums/forums-loop.php' ), true ); ?>

				</div>

				<?php do_action( 'bp_directory_forums_content' ); ?>

				<?php wp_nonce_field( 'directory_forums', '_wpnonce-forums-filter' ); ?>

			</form>

			<?php do_action( 'bp_after_directory_forums' ); ?>
			
<br />
<br />

<br />
<br />

			<?php do_action( 'bp_before_new_topic_form' ); ?>

			<div id="new-topic-post">

				<?php if ( is_user_logged_in() ) : ?>

					<?php if ( bp_is_active( 'groups' ) && bp_has_groups( 'user_id=' . bp_loggedin_user_id() . '&type=alphabetical&max=100&per_page=100' ) ) : ?>

						<form action="" method="post" id="forum-topic-form" class="standard-form">

							<?php do_action( 'groups_forum_new_topic_before' ) ?>

							<a name="post-new"></a>
							<h4><?php _e( 'Create New Topic:', 'buddypress' ); ?></h4>

							<?php do_action( 'template_notices' ); ?>

							<label><?php _e( 'Title:', 'buddypress' ); ?> <span class="asterisk">*</span></label>
							<input type="text" name="topic_title" id="topic_title" value="" />

							<label><?php _e( 'Content:', 'buddypress' ); ?> <span class="asterisk">*</span></label>
							<textarea name="topic_text" id="topic_text"></textarea>

							<label>Select a <a href="<?php echo site_url() ?>/groups/">Group</a> to Post Your Topic in <span class="asterisk">*</span></label>
							<select id="topic_group_id" name="topic_group_id">

								<option value=""><?php /* translators: no option picked in select box */ _e( '----------', 'buddypress' ); ?></option>

								<?php while ( bp_groups() ) : bp_the_group(); ?>

									<?php if ( bp_group_is_forum_enabled() && ( is_super_admin() || 'public' == bp_get_group_status() || bp_group_is_member() ) ) : ?>

										<option value="<?php bp_group_id(); ?>"><?php bp_group_name(); ?></option>

									<?php endif; ?>

								<?php endwhile; ?>

							</select><!-- #topic_group_id -->
							
<!--
<label>Tags (comma separated)</label>
<input type="text" name="topic_tags" id="topic_tags" value="" />
-->

							<?php do_action( 'groups_forum_new_topic_after' ); ?>

							<div class="submit">
								<input type="submit" name="submit_topic" id="submit" value="<?php _e( 'Post Topic', 'buddypress' ); ?>" />
								<input type="button" name="submit_topic_cancel" id="submit_topic_cancel" value="<?php _e( 'Cancel', 'buddypress' ); ?>" />
							</div>

							<?php wp_nonce_field( 'bp_forums_new_topic' ); ?>

						</form><!-- #forum-topic-form -->

					<?php elseif ( bp_is_active( 'groups' ) ) : ?>

						<div id="message" class="info">

							<p><?php printf( __( "You are not a member of any <a href=\"http://www.hobokenmommies.com/groups/\">groups</a> so you don't have any <a href=\"http://www.hobokenmommies.com/groups/\">group forums</a> you can post in. To start posting, first find a <a href=\"http://www.hobokenmommies.com/groups/\">group</a> that matches the topic subject you'd like to start. Once you have joined a <a href=\"http://www.hobokenmommies.com/groups/\">group</a> you can post your topic in that <a href=\"http://www.hobokenmommies.com/groups/\">group</a>'s forum.", 'buddypress' ), site_url( bp_get_groups_root_slug() . '/create/' ) ) ?></p>

						</div>

					<?php endif; ?>

				<?php endif; ?>
			</div><!-- #new-topic-post -->
	
</div><!-- #box -->

</div><!-- #column-one -->



<div id="column-two">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('welcome') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('adsforums') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('recent') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('groups') ) : ?><?php endif; ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('topics') ) : ?><?php endif; ?>			

</div><!-- #column-two -->

<?php else : ?>

<div id="message">
<h2>Forums</h2>
<p>You need to <a href="http://www.hobokenmommies.com/">log in</a> or <a class="create-account" href="http://www.hobokenmommies.com/register/" title="Create an account">create an account</a> to view this section.</p>
</div>
		
<?php endif; ?>

<?php get_footer(); ?>