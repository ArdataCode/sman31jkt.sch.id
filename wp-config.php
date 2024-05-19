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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "landingu_sman31jkt" );

/** Database username */
define( 'DB_USER', "landingu_sman31jkt" );

/** Database password */
define( 'DB_PASSWORD', "Ardata2024!" );

/** Database hostname */
define( 'DB_HOST', "localhost" );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         'ilrlmaghwn1fc0logsjg9gevxge5kuj5iudgazttjemtcmvjo4rnptvsioyl0skb' );
define( 'SECURE_AUTH_KEY',  '150w39rogp2g7nfdk8sbmkl8xozwq2jzqyngouhypqzddncnpgmkj24mzq720gnn' );
define( 'LOGGED_IN_KEY',    'ud7w6gfzkxdwx4arwmrnajqh95yzmfoempiyhkiqbmg3oosj7zikznug1ybvw9ip' );
define( 'NONCE_KEY',        'hvqg7kh4gathjgzbwso5umvwyng7l9bzglrf46vlq6lnxcmuxnsoglausvgyxrgj' );
define( 'AUTH_SALT',        'qwj87hkibbwkxufjpbhkkerifyvlgga6qqdxj0eoch48gtet4yuorlffxomywd1t' );
define( 'SECURE_AUTH_SALT', 'hh2f7atibhqt7nqraitietlmcwxkoer48pznw6lqey9hnjv4zelheiuwlznkyfod' );
define( 'LOGGED_IN_SALT',   'asgd66ranyzbdfdyal2h385sgpxupxrquunxlrtxixtl5c6xm9kqgbyak6m7e8st' );
define( 'NONCE_SALT',       'zxumseoru9skhlccqwfdvqyhcbpqpc38uzhrujeuunw1d9vojxw4sypdsqifgby8' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wppc_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



#define( 'WP_SITEURL', 'https://sman31jkt.sch.id' );
#define( 'DUPLICATOR_AUTH_KEY', '!Wkh4ThShZNA3>ZU_:`U 6Fju,!@Ru#!(U^yF{AIo;IA;>v]^(<1n8z|T_,XM->q' );
#define( 'WP_PLUGIN_DIR', '/home/u1567848/public_html/sman31jkt.sch.id/wp-content/plugins' );
#define( 'WPMU_PLUGIN_DIR', '/home/u1567848/public_html/sman31jkt.sch.id/wp-content/mu-plugins' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define ( 'FS_METHOD', 'direct');

