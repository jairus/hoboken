<?php
/*
Plugin Name: Hoboken Mommies Paypal Settings
Plugin URI: http://neuronglobal.com
Description: Options for PayPal
Version: 1.0
Author: Neuron Global
Author URI: http://neuronglobal.com
*/

class NG_PaypalSettings {
  public function __construct() {
    $this->initialize();
  }

  public function initialize() {
    $this->options = get_option('ng_paypal_settings');
    $this->register_settings_and_fields();
  }
  
  public static function add_menu_page() {
    add_options_page('PayPal Settings', 'Paypal Settings', 'administrator', __FILE__, array('NG_PaypalSettings', 'display_options_page'));
  }
  
  public function display_options_page() {
    //require 'options_page.php';
    ?>
    <div class="wrap">
      <?php screen_icon(); ?>
      <h2>My PayPal Settings</h2>
      <form method="post" action="options.php">
        <?php settings_fields('ng_paypal_settings'); ?>
        <?php do_settings_sections(__FILE__); ?>
        <p class="submit">
          <input id="submit" class="button-primary" type="submit" value="Save Changes" name="submit">
        </p>
      </form>
    </div>
    <?php
  }
  
  public function register_settings_and_fields() {
    register_setting('ng_paypal_settings', 'ng_paypal_settings', array($this, 'validate_settings')); 
    add_settings_section('ng_main_section', 'Main Settings', array($this, 'main_section'), __FILE__);
    add_settings_field('business_email', 'Business Email: ', array($this, 'business_email_setting'), __FILE__, 'ng_main_section');
  }
  
  public function main_section() { }
  
  public function validate_settings($plugin_options) {
    // if validation is needed, put it here
    $plugin_options['business_email'] = sanitize_email($plugin_options['business_email']);
    return $plugin_options;
  }
  
  /**
  * Inputs
  */
  
  // Business Email
  public function business_email_setting() {
    echo '<input name="ng_paypal_settings[business_email]" type="text" value="'.$this->options['business_email'].'"/>';
  }
}

add_action('admin_menu', function() {
  NG_PaypalSettings::add_menu_page();
});

add_action('admin_init', function() {
  new NG_PaypalSettings();
});