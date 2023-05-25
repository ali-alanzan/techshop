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
define( 'DB_NAME', 'techshop' );

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

define( 'FS_METHOD', 'direct' );


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
define( 'AUTH_KEY',         'oiTIs]MBu^cUdQ1IFMGz[}9%f?[g8mlp_r<1Q?OmJ3D.1f|vy!KVpi{k5s1R#fz6' );
define( 'SECURE_AUTH_KEY',  '0 3?J@;f.5xHNh{F(7n;Qg2vPab8825s7}?vK)du`yV{8Mqfp#b(Y7YxQj1U%%MG' );
define( 'LOGGED_IN_KEY',    'x5)<2}[~ D[^3E<.,Qk+Q{r[8#G~7!E}T9i#|rJ7JC^<?`lLkPiyM$WB#_;S5zp:' );
define( 'NONCE_KEY',        'WR*L~d?v{p53dB~[$-)=v~GFU07u9;*=AVCMk5!.E9Mw%HNgY]xUk6;nPP;IGFee' );
define( 'AUTH_SALT',        '[Pnd+@o9?6*T75Q.|&v7~,IV}*.DsrA~OVH5.O^l;lRf0Ef|MI&b2hy## %b0%<~' );
define( 'SECURE_AUTH_SALT', 'Ll8/e0ga!<kj2vR(_od79)z):ma3l(VH&F{)ho}@?#_4s`5j1`*GZU~=,Wx*qvXl' );
define( 'LOGGED_IN_SALT',   'HYCFUY :C697@#Vb*S/uNf(XODS{;)wpB]%E5+Dc*<]ZQpG`o)_97ZCWe`ug VLN' );
define( 'NONCE_SALT',       'bMyn?w>eade:KI=oR=TQnw|1|KhRd{XoHny9QrZ^T9nJ )9U6$ f57CB[,obM-m{' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'tcsh_';

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
