<?php
/*
Plugin Name: Remove WPMU Notification Plugin Nag
Plugin URI: http://wp.me/p1Aj2B-6g
Description: WPMU started trying to force people that use plugins by their developers to install a Notification plugin by making a persistent notification bug the admins. This removes that annoying piece.
Version: 1.0
Author: Trae Blain
Author URI: http://traeblain.com
License: GPL2
*/

if ( function_exists( 'wdp_un_check' ) ) {
  remove_action( 'admin_notices', 'wdp_un_check', 5 );
  remove_action( 'network_admin_notices', 'wdp_un_check', 5 );
}
?>