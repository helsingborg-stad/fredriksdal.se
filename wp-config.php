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
define('DB_NAME', 'dunkerskulturhus_se');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '<O4:UspL6N]Yd4!TZ`:iLA.@qSftvWP:Fs{W}o-Kdh=S:LDW,lP6`~iPbplYUqd0');
define('SECURE_AUTH_KEY',  'HcZg~ o14nF?3q289-7+`#RxUNxUU(Y:!`_Uitucvs,];xHiNBgNZF8`nAD~t&Zf');
define('LOGGED_IN_KEY',    'S:ZqDn|.&T{s$H+~t$%E-W-9t{8sLxKCFH**`8s*=fF!7G_spJf|;Y FG3#Y>Zg;');
define('NONCE_KEY',        'q7 87lGTJj0Y+yGEG:|w=SpbTx-^5-3Eg52^D#`}xAOw1Xa+a`_w<Yz$<oC`gQ%;');
define('AUTH_SALT',        '6X=$2(uc%[bI$1#Jj9|;Ndy h?/p;Eb{bu&94^Nw+hW>t1(~e1Wc;+YXS~8K(5k!');
define('SECURE_AUTH_SALT', 'Dx>|fZ2=G)%Rry3=-(hv0PSGKba2$Ux]8SV~Ie6?0lRMa/LtAlG-:eOr}Tm?Q3Km');
define('LOGGED_IN_SALT',   '|}X`ivDA)`y5v}w#:bjc.t%{cv%c@#wOQ s9rsTnzI9a;MaE0]T(=1OjAJuy9eP,');
define('NONCE_SALT',       'P/N&X ]x~KI!/87bipOUygKTL+tz,5>_|@Lws>cp`k}aLiX|x]iC I&Jy8|T>xlQ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dunkers_';

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
define('WP_CONTENT_DIR', __DIR__.'/wp-content');
define('WP_CONTENT_URL', 'http://'.$_SERVER['HTTP_HOST'].'/wp-content');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
