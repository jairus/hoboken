<?php do_action( 'bp_before_group_header' ) ?>

<!-- Hide group header from forums -->
<?php if ( bp_is_group_forum() && bp_group_is_visible() ) : ?>
<?php else : ?>

<div class="breadCrumbHolder module">
<div id="breadCrumb3" class="breadCrumb module">
<ul>
<li><a href="<?php echo site_url() ?>">Home</a></li>
<li><a href="<?php echo site_url() ?>/groups/">Groups</a></li>
<li><?php bp_group_name() ?></li>
</ul>
</div>
</div>

<?php do_action( 'template_notices' ) ?>

<a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><?php bp_group_avatar() ?></a>

<h2 class="group-title"><?php bp_group_name() ?> <?php do_action( 'bp_group_header_actions' ); ?></h2>

<span class="activity"><?php printf( __( 'active %s ago', 'buddypress' ), bp_get_group_last_active() ) ?></span>

<?php if ( bp_group_is_visible() ) : ?>
<?php do_action( 'bp_group_header_meta' ) ?>
<?php endif; ?>

<p><?php bp_group_description() ?></p>
		
<?php endif; ?>