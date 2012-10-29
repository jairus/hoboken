<?php if ( bp_has_forum_topics( "max=3 && bp_ajax_querystring( 'forums' )" ) ) : ?>

<div class="recent-topics">
<ul>
<?php while ( bp_forum_topics() ) : bp_the_forum_topic(); ?>

<li>
<a href="<?php bp_the_topic_permalink() ?>"><?php bp_the_topic_last_poster_avatar( 'type=thumb&width=40&height=40' ) ?></a>

<a href="<?php bp_the_topic_permalink() ?>" title="<?php bp_the_topic_title() ?> - <?php _e( 'Permalink', 'buddypress' ) ?>"><?php bp_the_topic_title() ?></a> 

<br /><span>topic posted <?php bp_the_topic_time_since_last_post() ?> in

<?php if ( !bp_is_group_forum() ) : ?>
<a href="<?php bp_the_topic_object_permalink() ?>" title="<?php bp_the_topic_object_name() ?>"><?php bp_the_topic_object_name() ?></a>
<?php endif; ?>
				
by <?php bp_the_topic_last_poster_name() ?></span>

</li>
<?php endwhile; ?>

</ul>
</div>

<?php endif;?>
