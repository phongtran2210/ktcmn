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
define('DB_NAME', 'ktcmn');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'H]A-QZFOI8;.xdbKF/D`a8.GVsx:J%`1C!4=z<I#)<w+N`c3U~kbF.x!x*KL Bjw');
define('SECURE_AUTH_KEY',  ',E@5*PD}IoIc)E(}|4F6aPR Q}+9(V^==;[l@nDApm]!TRGkMRGuAM7LOr?;VNzz');
define('LOGGED_IN_KEY',    'S!+:6w]WZE.ne/}gTUNm:,92cFc[M(c;[v>I+]rCwIQiY /f(1hF ?>^IMu!ssX1');
define('NONCE_KEY',        'C#A7F$U>#nUu`K-QTO.m&yK0]Cr@Ek/8X DAsNmrgS#$gkrAJ!c^=8 ]1JgA@H^?');
define('AUTH_SALT',        'X:y4=Y*CZZ1!)CE>^/OiY2P_exie?bQ!O7N}v*Oz2OT3Z+5HC`!GCLN)dl/#`xbH');
define('SECURE_AUTH_SALT', 'k@~.2BM,>6b4>jZMa^kmbLX68e!eI*2to>6_`53~-PG<SK`hJz7kOD.MI7xpSW7w');
define('LOGGED_IN_SALT',   '/T61pTH,z3FFmV,+}3e JYo4akof+X{~okx_:3GvhPG+rJ9/Kw*#_KR vx$P!ns|');
define('NONCE_SALT',       'gT@sA%2&Ij3r@{Va83xRU(/1]3}8c_f3GViPGw{D+J0u/S=l-j[6p2+9yOkSmJ^*');

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
