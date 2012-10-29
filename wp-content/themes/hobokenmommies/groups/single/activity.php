<div class="line-long"></div>

<div class="item-list-tabs no-ajax" id="subnav">
	<ul>
	
		<?php do_action( 'bp_group_activity_syndication_options' ) ?>

		<li id="activity-filter-select" class="last">
			<label for="activity-filter-by"><?php _e( 'Show:', 'buddypress' ); ?></label>
			<select>
				<option value="-1"><?php _e( 'No Filter', 'buddypress' ) ?></option>
				<option value="activity_update"><?php _e( 'Show Updates', 'buddypress' ) ?></option>

				<?php if ( bp_is_active( 'forums' ) ) : ?>
					<option value="new_forum_topic"><?php _e( 'Show New Forum Topics', 'buddypress' ) ?></option>
					<option value="new_forum_post"><?php _e( 'Show Forum Replies', 'buddypress' ) ?></option>
				<?php endif; ?>

				<option value="joined_group"><?php _e( 'Show New Group Memberships', 'buddypress' ) ?></option>

				<?php do_action( 'bp_group_activity_filter_options' ) ?>
			</select>
		</li>
	</ul>
</div><!-- .item-list-tabs -->

<?php do_action( 'bp_before_group_activity_content' ) ?>

<div class="activity single-group" role="main">
	<?php locate_template( array( 'activity/activity-loop.php' ), true ) ?>
</div><!-- .activity.single-group -->

<?php do_action( 'bp_after_group_activity_content' ) ?>
