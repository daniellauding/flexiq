<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'flexiq_local' );

/** Database username */
define( 'DB_USER', 'flexiq' );

/** Database password */
define( 'DB_PASSWORD', 'flexiq123' );

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
define('AUTH_KEY',         ',$i2 C${c6HXb+U:C8z`U3$@,Nmbw5WPZ#O%K`|?f|?14SA1srnMGzmKf_:?EhR@');
define('SECURE_AUTH_KEY',  'hNm~Y&s7Xh Zqsi{k@]cZ!3V]jj5WdOj/pOOIXaMhiB|Lk7w&)/K!^uC++Pf7<A|');
define('LOGGED_IN_KEY',    '/,1>*D$zx0@{R(W~_Lx&|FkvEwXI,*K0Q&8@*I-S5#,}>5dqg*c2I.oz{|<B!$N ');
define('NONCE_KEY',        'G/QS?oMzXD_0!sisg&0@QD[-9|Iq>N<xT-Z,2Q0*~q(^x kQYp[4;crj|*r-r3g-');
define('AUTH_SALT',        'OpVno]p&QokW,}KBv1gE}+9#q_f[Pe4@&{9|66i0njUKYJQ=.[nB:sTfN|X;hn-#');
define('SECURE_AUTH_SALT', 'Hf*5cP -5_;8-YFqHFvd8Jv-T/c$OLEw3<bZ/UPY37<m-1pSpX|D*JRO[h3$*/_.');
define('LOGGED_IN_SALT',   'P]7|*$)DGavA-4)_Q[x@&36T/El6BzSfZ2-Bm2w2ga,bv.KCJtDf0]Fa]B!A#@2u');
define('NONCE_SALT',       'FWy<ClCknX_k/=LWv-X+5fV2dNIf2G1cN:Qr(P??^b1Bnv/9rfh:pd,u@Vu. Se6');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/* Disable WP-Cron to prevent deadlock with PHP built-in server */
define("DISABLE_WP_CRON", true);
define("CONCATENATE_SCRIPTS", false);


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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

/* Add any custom values between this line and the "stop editing" line. */

// Increase memory for Block Editor
define( 'WP_MEMORY_LIMIT', '256M' );

// Cookie settings for Tailscale
define( 'COOKIE_DOMAIN', '' );
define( 'ADMIN_COOKIE_PATH', '/' );
define( 'COOKIEPATH', '/' );
define( 'SITECOOKIEPATH', '/' );



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

// Enable access via Tailscale
if (isset($_SERVER['HTTP_HOST'])) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    define('WP_HOME', $protocol . '://' . $_SERVER['HTTP_HOST']);
    define('WP_SITEURL', $protocol . '://' . $_SERVER['HTTP_HOST']);
}
