<?php
define('WP_AUTO_UPDATE_CORE', false);// This setting was defined by WordPress Toolkit to prevent WordPress auto-updates. Do not change it to avoid conflicts with the WordPress Toolkit auto-updates feature.
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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_m78oa' );

/** MySQL database username */
define( 'DB_USER', 'wp_9s6c8' );

/** MySQL database password */
define('DB_PASSWORD', '6v7LB_hK3g');

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '!XTJ-mr[i/H|/ArO@1Ot32&19Z72%P&~qmf*d21cCy%+~J973_bk8]p!vqp4/lt3');
define('SECURE_AUTH_KEY', '3aS8Ju9mqq#N24fcTif_45+uGA!r_3C95_/VL8qkn;%T]Cw64(0F5n9#rFiS4LK%');
define('LOGGED_IN_KEY', '+OE98;c:1S2w7!A4]-8XwAhi#P2_BS05HF1J5IU[)yxY%|Y|5!5u/:*p8e(N+)4V');
define('NONCE_KEY', ')a%ZiVW6Pp*1K4iKqVN3t3_!9%ROyT!/-zm#e&/k8DpTB)yG~3esxzam8%|r4h/s');
define('AUTH_SALT', '6a84Z6Vvhus|r8/!6dnV4c_8DKGiW7j[[r]/39q;Wj0T2ii4D*177dts1g33EFU4');
define('SECURE_AUTH_SALT', '3:SQd033|z/6V8FCt_7%e[3Hfq4(J!kh+7Ds:hM7g7b;B(3B!N#il0rq~323/Z*3');
define('LOGGED_IN_SALT', '3#u-G9pe2dF0PLGLR()R3h_(&G4lU;5|_pS*e9#bR9)g-+!:X!/uHFoy|[O~liV#');
define('NONCE_SALT', 'v0[-Fmpa#)--Uc[5|xxI6A1X3!%Ok0W+vF%s)1w9R842E9ZQ]0Y9511j0+8(&oNU');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '2D4k2_';


define('WP_ALLOW_MULTISITE', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
