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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/var/www/html/shop/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'vgems');

/** MySQL database username */
define('DB_USER', 'vgems');

/** MySQL database password */
define('DB_PASSWORD', '6ge-9JC-wX6-PkP');

/** MySQL hostname */
define('DB_HOST', 'vgdbinstance.cx07bqnjocwv.us-west-1.rds.amazonaws.com:3306');

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
define('AUTH_KEY',         'UR!RoPJ+>|{wR`a%<G4aj=T2YCk~9WH7i;eHe-.|`=Y:=idT*)FZW&typk5X4nxG');
define('SECURE_AUTH_KEY',  '*/+h`t-3_D-y`UBPlm:3Ec,W,h--+}#[XL%%~KmZ-p*3JW7Phm:b$)V(hnrfQ^XR');
define('LOGGED_IN_KEY',    '}O+u$2de^#!|={ptiv0;lj;,$r- ue[7jDIhG`qSE91v.HHn!?C(j62}6YWgAq.6');
define('NONCE_KEY',        'O&jd0~WMW:fBM!B4[KY7vX>plskkZ]|<T+,P`j-UV#tM-VD||1k3A -m6C4c0!-%');
define('AUTH_SALT',        'n2`Rw:`.h;|Nb3k;p$j7m:75X> #3i@@7a#0s2_B%hiQhs!|VzS~G6mR%X>t-|cN');
define('SECURE_AUTH_SALT', 'A,9+FaqBiB2.7ovIrc* aS/;YG)&JBTyn-YvsLl.lca>dNK0{D|x+lri(X.F1f6$');
define('LOGGED_IN_SALT',   '`ZHKMXiqrh}&*k_9x>wkiG7t9>E|p6;n+=4DNI+PZ&p<4}[t.,#`|]kd.(a%Ch<l');
define('NONCE_SALT',       '>4Os.eeY1UOv]$-h2Up/C/3cS5j+|$0<zxv+jt;58:CS}W-2$:Y!V+1bkc>C7q$i');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'np_';

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
define('FS_METHOD', 'ftpsockets');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
if(is_admin()) {
	add_filter('filesystem_method', create_function('$a', 'return "direct";' ));
	define( 'FS_CHMOD_DIR', 0751 );
}
?>
