<?php if ( bp_is_group_forum_topic() ) : ?>

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li><a href="<?php echo site_url() ?>/groups/">Groups</a></li>
<li><a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><?php bp_group_name() ?></a></li>
<li><a href="<?php bp_group_permalink() ?>forum/" title="<?php bp_group_name() ?>">Forum</a></li>
<li><?php bp_the_topic_title() ?></li>
</ul>
</div>
</div>

<h2><?php bp_the_topic_title() ?></h2>	
		
<?php if ( bp_group_is_admin() || bp_group_is_mod() || bp_get_the_topic_is_mine() ) : ?>
<div class="topic-moderator">
<?php bp_the_topic_admin_links() ?>
</div>
<?php endif; ?>
<?php do_action( 'bp_group_forum_topic_meta' ); ?>
	
<?php else : ?>

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li><a href="<?php echo site_url() ?>/groups/">Groups</a></li>
<li><a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><?php bp_group_name() ?></a></li>
<li>Forum</li>
</ul>
</div>
</div>

<?php endif; ?>