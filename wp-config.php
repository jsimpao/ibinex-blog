<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tokenovice');

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
define('AUTH_KEY',         '1{ <Ol[-Vg)][E2?,!;-VTyU{W,-#v>s1]R b$bAbOUh>Axr,)YiIE1%Mg;={F]z');
define('SECURE_AUTH_KEY',  '1}/7l6)7:-X[b/VrKY/.&N;_x*752W-j3tY-Sz8$E{`l@ 2vqy^Z-`LN)Y46PX:$');
define('LOGGED_IN_KEY',    '7Abu%!A_hbc+Awlmun<BIz B)%.#+7>|$+d+$}e/Hlily.,`**j;^lR*W5@Q?H5I');
define('NONCE_KEY',        '=T*zqN-kAH-=<23s|{|(02v_9P-c>8~OC?90V,9;Kq6-r:/^,kRs:*PRlI9w|2A]');
define('AUTH_SALT',        '!kTwZ}|05V2[OjN:g,qU?,-ei+*H[/+++RPwDQS|1Rf^o;_V@dg9g4YkfF/jI]f4');
define('SECURE_AUTH_SALT', '}(Y,ra^f4&MXC@n-91&MO6s{B|ljj&XPRxn0/g#^Eq7Wveof X>H9SA051|pF68,');
define('LOGGED_IN_SALT',   'GAHTcs?&yubz/^a]W?>C>2n38GL$y+8voeq $W2k!w([Cd,l^=+R1$|EO12)$|m9');
define('NONCE_SALT',       'sioeS/#D*}V5r!-;K>[`7L;A(j.6(M620eEab;&KYdf|#}q>T%c.LxqPQ$jXCig#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
