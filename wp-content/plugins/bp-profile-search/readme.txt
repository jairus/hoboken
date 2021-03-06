=== BP Profile Search ===
Contributors: dontdream
Tags: buddypress, member, members, user, users, profile, profiles, search, filter
Requires at least: WP 3.0 - BP 1.5
Tested up to: WP 3.3.1 - BP 1.5.5
Stable tag: 3.0

Adds a configurable search form to your BuddyPress site, so visitors can find site members searching their extended profiles.

== Description ==

BP Profile Search adds a configurable search form to your BuddyPress site, so visitors can find site members searching their extended profiles. The search form can be inserted in a post or page, using the shortcode *[bp_profile_search_form]*, or in a sidebar or widget area, using the widget *BP Profile Search*, or in your template files, e.g. in your Members Directory page, using the code *&lt;?php do_action ('bp_profile_search_form'); ?&gt;*

Features:

BP Profile Search shows your visitors a form to filter your Members directory. In the plugin admin page you have the following options:

* specify the text for the form header or welcome message (HTML enabled);

* enable the toggle form feature;

* select the profile fields to include in the search form (currently the *datebox* profile fields are not supported);

* if your extended profiles include a birth date field, enable the Age Range search, so your visitors can specify the minimum and maximum age for their search;

* select the search mode for text fields, between *partial match*, where a search for *John* matches field values of *John*, *Johnson*, *Long John Silver*, and so on, and *exact match*, where a search for *John* matches the field value *John* only.

In both modes the wildcard characters *% (percent sign)*, matching zero or more characters, and *_ (underscore)*, matching exactly one character, are available to your visitors to better specify their search.

* select the members list to filter, if your Members Directory page contains more than one.

== Installation ==

After the standard manual or automatic plugin installation procedure, you'll be able to access the plugin admin page *BuddyPress -> Profile Search*.

Before you can use the plugin, you have to add the profile search form to your BuddyPress site. The search form can be inserted in a post or page, using the shortcode *[bp_profile_search_form]*, or in a sidebar or widget area, using the widget *BP Profile Search*, or in your template files, e.g. in your Members Directory page, using the code *&lt;?php do_action ('bp_profile_search_form'); ?&gt;*

If you wish to add the search form to your Members Directory page, and you are using the BuddyPress default theme, open *index.php* in the *buddypress/bp-themes/bp-default/members* folder, locate this line:

`</div><!-- #members-dir-search -->`

and, right after that, insert the BP Profile Search form:

`<?php do_action ('bp_profile_search_form'); ?>`

If you are *not* using the BuddyPress default theme, the procedure might be different.

== Troubleshooting ==

* If your search always returns the full members list, try changing the *Filtered Members List* value in the *Advanced Options* tab.

== Changelog ==

= 3.0 =
* Added the BP Profile Search widget
* Added the [bp_profile_search_form] shortcode
= 2.8 =
* Fixed the Age Range Search feature
* Fixed the search form for required fields
* Removed field descriptions from the search form
* Requires BuddyPress 1.5 or higher
= 2.7 =
* Updated for BuddyPress 1.5 multisite
* Requires BuddyPress 1.2.8 or higher
= 2.6 =
* Updated for BuddyPress 1.5
= 2.5 =
* Updated for BuddyPress 1.2.8 multisite installations
= 2.4 =
* Changed the file names to allow activation in some installations
* Added the *Filtered Members List* option in the *Advanced Options* tab
= 2.3 =
* Added the choice between partial match and exact match for text searches
* Added a workaround so renaming the plugin folder is no longer required
= 2.2 =
* Added the Age Range Search feature
= 2.1 =
* Added the option to show/hide the search form
* Fixed a bug where no results were found in some installations
= 2.0 =
* Added support for *multiselectbox* and *checkbox* profile fields
* Added support for % and _ wildcard characters in text searches
= 1.0 =
* First version released to the WordPress Plugin Directory
