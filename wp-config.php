<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'portfolio' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '$$4R+-c&7}=%!pl5qcp`*B&7qjp,D-(BF^0v%5Y?A;z5FA+-lsbit2cvp;`.DzQm' );
define( 'SECURE_AUTH_KEY',  '~WMW|Q@Qk:7^+~o0/q8+MJqVm!T*wXHwHMPwc,i}TxI<`=5pDY8g3U,kVL)2VF6j' );
define( 'LOGGED_IN_KEY',    'M3L_-^m_`_;c}<O@(cM]a!Z9:z+3xLz)jgUUoc;9E42h%ivhdC[e^4`}&#w0zoLp' );
define( 'NONCE_KEY',        'iC;)%lh=3sA@DBB*zR=k1yX}S3v~Z5O{TeDd:<iI8B/^lXzPT?CLiqnBPMxP4M#c' );
define( 'AUTH_SALT',        '/5U31CgKAy1;,y|]k,LR{E{13aknnXqDg*L(fMMtyj04;Ht`zfXe5u_A4:~h>8ou' );
define( 'SECURE_AUTH_SALT', '3~I)=fi*xR@3YT(|=h,VFt&!R@|NiR2aIE~>AgJZ@#((-jS@<}S4$wXEEe&QVm0H' );
define( 'LOGGED_IN_SALT',   '}q/rHQmW9[e5X~D~z]*?A3jN54z2`Va|uJD`3KCe1o(g1wz)`a.=h^lf#W}oNq!Z' );
define( 'NONCE_SALT',       'h}(eE04k@[zO$5S8U;fM6TVdgZ#@$HZ.=k8nk]>;1DC)$F|ZNoU]6<$TB(eAE0G3' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
