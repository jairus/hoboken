<?php
function uplogo_get_default_options() {
	$options = array(
		'logo' => ''
	);
	return $options;
}

function uplogo_options_init() {
     $uplogo_options = get_option( 'theme_uplogo_options' );
	 
	 // Are our options saved in the DB?
     if ( false === $uplogo_options ) {
		  // If not, we'll save our default options
          $uplogo_options = uplogo_get_default_options();
		  add_option( 'theme_uplogo_options', $uplogo_options );
     }
	 
     // in this case no need to update the db
}
// Initialize Theme options
add_action( 'after_setup_theme', 'uplogo_options_init' );

function uplogo_options_setup() {
	global $pagenow;
	if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
		// Now we'll replace the 'Insert into Post Button inside Thickbox' 
		add_filter( 'gettext', 'replace_thickbox_text' , 1, 2 );
	}
}
add_action( 'admin_init', 'uplogo_options_setup' );

function replace_thickbox_text($translated_text, $text ) {	
	if ( 'Insert into Post' == $text ) {
		
		$referer = strpos( wp_get_referer(), 'uplogo-settings' );
		if ( $referer != '' ) {
			return __('I want this to be my logo!', 'uplogo' );
		}
	}

	return $translated_text;
}

// Add "uplogo Options" link to the "Appearance" menu
function uplogo_menu_options() {
	//add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
     add_theme_page('Logo Upload Options', 'Upload Your Website Logo', 'edit_theme_options', 'uplogo-settings', 'uplogo_admin_options_page');
}
// Load the Admin Options page
add_action('admin_menu', 'uplogo_menu_options');

function uplogo_admin_options_page() {
	?>
		<!-- 'wrap','submit','icon32','button-primary' and 'button-secondary' are classes 
		for a good WP Admin Panel viewing and are predefined by WP CSS -->
		
		
		
		<div class="wrap">
			
			<div id="icon-themes" class="icon32"><br /></div>
		
			<h2><?php _e( 'Upload Logo Options', 'uplogo' ); ?></h2>
			
			<!-- If we have any error by submiting the form, they will appear here -->
			<?php settings_errors( 'uplogo-settings-errors' ); ?>
			
			<form id="form-uplogo-options" action="options.php" method="post" enctype="multipart/form-data">
			
				<?php
					settings_fields('theme_uplogo_options');
					do_settings_sections('uplogo');
				?>
			
				<p class="submit">
					<input name="theme_uplogo_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'uplogo'); ?>" />
					<input name="theme_uplogo_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'uplogo'); ?>" />		
				</p>
			
			</form>
			
		</div>
	<?php
}

function uplogo_options_validate( $input ) {
	$default_options = uplogo_get_default_options();
	$valid_input = $default_options;
	
	$uplogo_options = get_option('theme_uplogo_options');
	
	$submit = ! empty($input['submit']) ? true : false;
	$reset = ! empty($input['reset']) ? true : false;
	$delete_logo = ! empty($input['delete_logo']) ? true : false;
	
	if ( $submit ) {
		if ( $uplogo_options['logo'] != $input['logo']  && $uplogo_options['logo'] != '' )
			delete_image( $uplogo_options['logo'] );
		
		$valid_input['logo'] = $input['logo'];
	}
	elseif ( $reset ) {
		delete_image( $uplogo_options['logo'] );
		$valid_input['logo'] = $default_options['logo'];
	}
	elseif ( $delete_logo ) {
		delete_image( $uplogo_options['logo'] );
		$valid_input['logo'] = '';
	}
	
	return $valid_input;
}

function delete_image( $image_url ) {
	global $wpdb;
	
	// We need to get the image's meta ID..
	$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";  
	$results = $wpdb -> get_results($query);

	// And delete them (if more than one attachment is in the Library
	foreach ( $results as $row ) {
		wp_delete_attachment( $row -> ID );
	}	
}

/********************* JAVASCRIPT ******************************/
function uplogo_options_enqueue_scripts() {
	wp_register_script( 'uplogo-upload', get_template_directory_uri() .'/logouploader/js/logo-upload.js', array('jquery','media-upload','thickbox') );	

	if ( 'appearance_page_uplogo-settings' == get_current_screen() -> id ) {
		wp_enqueue_script('jquery');
		
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('uplogo-upload');
		
	}
	
}
add_action('admin_enqueue_scripts', 'uplogo_options_enqueue_scripts');


function uplogo_options_settings_init() {
	register_setting( 'theme_uplogo_options', 'theme_uplogo_options', 'uplogo_options_validate' );
	
	// Add a form section for the Logo
	add_settings_section('uplogo_settings_header', __( 'Logo Options', 'uplogo' ), 'uplogo_settings_header_text', 'uplogo');
	
	// Add Logo uploader
	add_settings_field('uplogo_setting_logo',  __( 'Logo', 'uplogo' ), 'uplogo_setting_logo', 'uplogo', 'uplogo_settings_header');
	
	// Add Current Image Preview 
	add_settings_field('uplogo_setting_logo_preview',  __( 'Logo Preview', 'uplogo' ), 'uplogo_setting_logo_preview', 'uplogo', 'uplogo_settings_header');
}
add_action( 'admin_init', 'uplogo_options_settings_init' );

function uplogo_setting_logo_preview() {
	$uplogo_options = get_option( 'theme_uplogo_options' );  ?>
	<div id="upload_logo_preview" style="min-height: 100px;">
		<img style="max-width:100%;" src="<?php echo esc_url( $uplogo_options['logo'] ); ?>" />
	</div>
	<?php
}

function uplogo_settings_header_text() {
	?>
		<p><?php _e( 'You can change the hoboken logo here.', 'uplogo' ); ?></p>
	<?php
}

function uplogo_setting_logo() {
	$uplogo_options = get_option( 'theme_uplogo_options' );
	?>
		<input type="hidden" id="logo_url" name="theme_uplogo_options[logo]" value="<?php echo esc_url( $uplogo_options['logo'] ); ?>" />
		<input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', 'uplogo' ); ?>" />
		<?php if ( '' != $uplogo_options['logo'] ): ?>
		<input id="delete_logo_button" name="theme_uplogo_options[delete_logo]" type="submit" class="button" value="<?php _e( 'Delete Logo', 'uplogo' ); ?>" />
		<?php endif; ?>
		<span class="description"><?php _e('Upload an image for the banner.', 'uplogo' ); ?></span>
	<?php
}



?>