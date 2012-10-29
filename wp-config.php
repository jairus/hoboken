<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hoboken_test');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'PG7K5)8wbFVMbgG@payIB1Jkd5(=$gQru As[$:ft`duh^KE-ZTnl~V++FlT;Px/');
define('SECURE_AUTH_KEY',  '_P9%9rrgf!EsO,jY0.hK~}q/@eUJ4o?~o:Y.{9sVv<Le.AO81tLae}I0?tKbRgQ#');
define('LOGGED_IN_KEY',    's<xpg?Av]K&c2NIHD-,FcSNkVhRish)X,P5QN[GqPrf}fj?m/RMD+7c%8JT*|N_#');
define('NONCE_KEY',        '=FrN>E%W/#a/OmvmSv7Jgp=[=Y|k$f=*yh!&$?#K&oUY4Hy=vI 8K*G^mCz[!c;t');
define('AUTH_SALT',        '9i@<u1---X8%B1W(<9E]jv`(r,cUKFSE_%=~y8@i#>vv-K4TOyB018m27o:#bq,D');
define('SECURE_AUTH_SALT', 'Y1$`pfhqykp$7e$]x5y?VuVQ`{RAN?W}:eww#9$?+W+wr*1(JH[=2SiINp!jMAdr');
define('LOGGED_IN_SALT',   '^BgJz=u6DZT,[d1Qh4RAi#G:e~L}ND1ASFM2Hiy<W|Zqx!!*_,Qle~ZwrHgIs0ud');
define('NONCE_SALT',       '}C+(|g.?V|$tK[09WuVAcCKXpn`@)FFgcTe^jPZ{/e|rf(BLsuR Fl J6 uLG=6,');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */

define('BP_DISABLE_ADMIN_BAR', true );
define('CONCATENATE_SCRIPTS', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
