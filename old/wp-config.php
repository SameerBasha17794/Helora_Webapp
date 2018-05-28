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
define('FORCE_SSL_ADMIN', true);

if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false)  
    $_SERVER['HTTPS']='on';
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'healora');
/** MySQL database username */
define('DB_USER', 'root');
/** MySQL database password */
define('DB_PASSWORD', 'pass');
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
define('AUTH_KEY',         '^2Q4nyS|yPj.bJ?DYGDB}FO88:{~t.7hBPhQsKa$>u08GsobG(!6IEJL`e/kvdsu');
define('SECURE_AUTH_KEY',  'L*B8T{Q>df~5@#a0|mhK7}{zmbwU:|$vP>/Q1=0 -M|->o|@Vc3wXk@T|OI^pwK$');
define('LOGGED_IN_KEY',    'I*|_|CG| AX%,O^uQ,uOkhI]uxN:1_#J(WiQ/=@<d.2qiLy0|FN&`7pDAT6(jaD+');
define('NONCE_KEY',        '^-V+@`yiSFs=3+Wje},rh.- 5PqK#}j@+k|. .]$$Fg7lIuLzf C-%.RK6.vZ:Y-');
define('AUTH_SALT',        '}kA9rLu]$<>_q4|Q{J]q6)wj+lHXM8+5;4MuzxPqIGG<v3~XH nZlj,I1qfPpu:Q');
define('SECURE_AUTH_SALT', 'xx+e}0l1bek&12}&< ?Hd q^(FdB{pf>fbT/gK.+%L/>2Y+,HGjY]!oi+H_%t7DH');
define('LOGGED_IN_SALT',   'T{a:(n|DdB3x-hnf<j]J>|av*ZaOiwiI2y7{v5BBt;~a6xShu0Tw+qjfnm~e<(_I');
define('NONCE_SALT',       'oTSlJNq0~4C5h<9nerp>[EX&GNWL*G!I+H.*-IsEzU]|`g&O9|CX^;$)$IJ[+N`@');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'hea_';
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
