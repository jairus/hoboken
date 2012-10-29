=== BuddyPress Profile Privacy ===
Contributors: modemlooper
Tags: buddypress, members, profile, privacy
Requires at least: WordPress 3.2.1 and BuddyPress 1.5
Tested up to: WordPress 3.2.1 and BuddyPress 1.5
Stable tag: 1.4.2

Allows users to hide profile sections from non-friends and "permissions" to be set for xprofile fields.

== Description ==

Allows users to hide profile sections from non-friends and "permissions" to be set for xprofile fields. REQUIRES CODE EDIT.

== Installation ==

1. Upload plugin folder `/buddypress-profile-privacy/` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Copy the home.php into buddypress/bp-themes/bp-default/members/single. Overwrite the file or edit your own home.php file. The code edit required is in the home.php example in this plugin folder.
4. Go to your profile/settings/privacy and check personal settings.
5. Admin can set profile field permission settings under the BuddyPress menu in the Wordpress admin.


== Screenshots ==

1. Profile Settings screen
2. Admin Settings screen

== Changelog ==
=1.4.2=
Fixed language file not loading and added Danish translation file.

= 1.4 =
Added language file and fixed multisite admin options not showing. TO USE LANGUAGE FILE YOU MUST RE-EDIT HOME.PHP!!!

= 1.3 =
Added ability to set permissions for x-profile fields.

= 1.2 =
Fix for not showing notice when profile section was blocked.

= 1.1 =
Added ability to hide various member page sections. PLEASE READ INSTALL INSTRUCTIONS AS CODE EDIT REQUIREMENTS HAVE CHANGED!!!


== Upgrade Notice ==
Added ability to set permissions for x-profile fields. New settings in the WordPress admin under BuddyPress menu.


