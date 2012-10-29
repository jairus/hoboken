<?php

/**
 * BuddyPress - Activity Stream (Single Item)
 *
 * This template is used by activity-loop.php and AJAX functions to show
 * each activity.
 *
 * @package BuddyPress
 * @subpackage BuddyBoss
 */

global $bp;

?>

<?php do_action( 'bp_before_activity_entry' ); ?>

<li class="<?php bp_activity_css_class(); ?>" id="activity-<?php bp_activity_id(); ?>">
	<div class="activity-avatar">
		<a href="<?php bp_activity_user_link(); ?>">
			<?php bp_activity_avatar( 'type=thumb&width=40&height=40' ); ?>
		</a>
	</div>

	<div class="activity-content">

		<div class="activity-header">
			<?php bp_activity_action(); ?>
		</div>

		<?php if ( 'activity_comment' == bp_get_activity_type() ) : ?>

			<div class="activity-inreplyto">
				<strong><?php _e( 'In reply to: ', 'buddypress' ); ?></strong><?php bp_activity_parent_content(); ?> <a href="<?php bp_activity_thread_permalink(); ?>" class="view" title="<?php _e( 'View Thread / Permalink', 'buddypress' ); ?>"><?php _e( 'View', 'buddypress' ); ?></a>
			</div>

		<?php endif; ?>

		<?php if ( bp_activity_has_content() ) : ?>
			<div class="activity-inner">
				<?php bp_activity_content_body(); ?>
			</div>
		<?php endif; ?>

		<?php do_action( 'bp_activity_entry_content' ); ?>

		<?php if ( is_user_logged_in() ) : ?>

			<div class="activity-meta">

				<?php echo bp_core_time_since( bp_get_activity_date_recorded() ) ?>
				
				<!-- Like (Favorite) -->
			
				<?php if ( bp_activity_can_favorite() && is_user_logged_in() ) : ?>
	
					<?php if ( !bp_get_activity_is_favorite() ) : ?>
	
						&middot; <a href="<?php bp_activity_favorite_link(); ?>" class="fav bp-secondary-action" title="Like"> Like</a>
	
					<?php else : ?>
	
						&middot; <a href="<?php bp_activity_unfavorite_link(); ?>" class="unfav bp-secondary-action" title="Unlike"> Unlike</a>
	
					<?php endif; ?>
	
				<?php endif; ?>
		
				<!-- Comment -->
				
				<?php if ( bp_activity_can_comment() ) : ?>
					&middot; <a href="<?php bp_get_activity_comment_link(); ?>" class="acomment-reply bp-primary-action" id="acomment-comment-<?php bp_activity_id(); ?>"><?php printf( __( 'Comment <span>(%s)</span>', 'buddypress' ), bp_activity_get_comment_count() ); ?></a>
				<?php endif; ?>

				<!-- Delete -->
		
				<?php $owner = (bp_get_activity_user_id() == $bp->loggedin_user->id); ?>
					 
				<?php if ( (is_super_admin() || ($bp->current_action!="just-me" && $bp->is_item_admin) ||  $owner)) : ?>
				
					&middot; <a href="<?php echo wp_nonce_url( $bp->root_domain . '/' . $bp->activity->slug . '/delete/' . bp_get_activity_id() . '?cid=' . $comment_id, 'bp_activity_delete_link' ) ?>" class="delete acomment-delete confirm"><?php _e( 'Delete', 'buddypress' ) ?></a>
				
				<?php endif; ?>
				

				<?php do_action( 'bp_activity_entry_meta' ); ?>

			</div>

		<?php endif; ?>

	</div>

	<?php do_action( 'bp_before_activity_entry_comments' ); ?>

	<?php if ( ( is_user_logged_in() && bp_activity_can_comment() ) || bp_activity_get_comment_count() ) : ?>

		<div class="activity-comments">
			
			<?php bp_activity_comments(); ?>

			<?php if ( is_user_logged_in() ) : ?>

				<form action="<?php bp_activity_comment_form_action(); ?>" method="post" id="ac-form-<?php bp_activity_id(); ?>" class="ac-form"<?php bp_activity_comment_form_nojs_display(); ?>>
					<div class="ac-reply-avatar"><?php bp_loggedin_user_avatar( 'width=' . BP_AVATAR_THUMB_WIDTH . '&height=' . BP_AVATAR_THUMB_HEIGHT ); ?></div>
					<div class="ac-reply-content">
						<div class="ac-textarea">
							<textarea id="ac-input-<?php bp_activity_id(); ?>" class="ac-input" name="ac_input_<?php bp_activity_id(); ?>"></textarea>
						</div>
						<input type="submit" name="ac_form_submit" value="<?php _e( 'Post', 'buddypress' ); ?>" /> &nbsp; <?php _e( 'or press esc to cancel.', 'buddypress' ); ?>
						<input type="hidden" name="comment_form_id" value="<?php bp_activity_id(); ?>" />
					</div>

					<?php do_action( 'bp_activity_entry_comments' ); ?>

					<?php wp_nonce_field( 'new_activity_comment', '_wpnonce_new_activity_comment' ); ?>

				</form>

			<?php endif; ?>

		</div>

	<?php endif; ?>

	<?php do_action( 'bp_after_activity_entry_comments' ); ?>

</li>

<?php do_action( 'bp_after_activity_entry' ); ?>
