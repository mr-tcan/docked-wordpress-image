<?php
/**
 * The base configuration for WordPress
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

 /**
   * Don't edit this file directly, instead, use environment variables to
   * define your settings. If you need add some settings, create a
   * wp-config-override.php file and add your settings and defines in there.
   * This file contains production settings.
 */


/**
  * MySQL settings:
  * DB_NAME: the name of the database for WordPress
  * DB_USER: MySQL database username
  * DB_PASSWORD: MySQL database password
  * DB_HOST: MySQL hostname with a specific port number WP_DB_PORT
  * DB_CHARSET: Database Charset to use in creating database tables
  * DB_COLLATE: The Database Collate type. Don't change this if in doubt
  */
 define( 'DB_NAME', getenv( 'WP_DB_NAME' ) );
 define( 'DB_USER', getenv( 'WP_DB_USER' ) );
 define( 'DB_PASSWORD', getenv( 'WP_DB_PASSWORD' ) );
 define( 'DB_HOST', getenv( 'WP_DB_HOST' ) . ':' . getenv( 'WP_DB_PORT' ) );
 define( 'DB_CHARSET', 'utf8' );
 define( 'DB_COLLATE', '' );

 /**#@+
  * Authentication Unique Keys and Salts.
  *
  * Change these to different unique phrases!
  * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
  * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
  *
  * @since 2.6.0
  */
define( 'AUTH_KEY',         getenv( 'WP_AUTH_KEY' ) );
define( 'SECURE_AUTH_KEY',  getenv( 'WP_SECURE_AUTH_KEY' ) );
define( 'LOGGED_IN_KEY',    getenv( 'WP_LOGGED_IN_KEY' ) );
define( 'NONCE_KEY',        getenv( 'WP_NONCE_KEY' ) );
define( 'AUTH_SALT',        getenv( 'WP_AUTH_SALT' ) );
define( 'SECURE_AUTH_SALT', getenv( 'WP_SECURE_AUTH_SALT' ) );
define( 'LOGGED_IN_SALT',   getenv( 'WP_LOGGED_IN_SALT' ) );
define( 'NONCE_SALT',       getenv( 'WP_NONCE_SALT' ) );
 /**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv( 'WP_TABLE_PREFIX' );

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define( 'WPLANG', '' );


// Define Site and Home URL with or without SSL
if ( isset( $_SERVER['HTTP_HOST'] ) ) {
  // HTTP is still the default scheme for now.
  $scheme = 'http';
  // If we have detected that the end use is HTTPS, make sure we pass that
  // through here, so <img> tags and the like don't generate mixed-mode
  // content warnings.
  if ( $_SERVER['HTTPS'] == 'on' || $_SERVER['REQUEST_SCHEME'] == 'https' ) {
    $scheme = 'https';
    // Force SSL on admin
    define('FORCE_SSL_ADMIN', true);
  }

  define('WP_HOME', $scheme . '://' . $_SERVER['HTTP_HOST']);
  define('WP_SITEURL', $scheme . '://' . $_SERVER['HTTP_HOST']);
}

// Define path & url for Content
if ( ! empty( getenv( 'WP_CONTENT_CUSTOM' ) ) ) {
  define( 'WP_CONTENT_CUSTOM', getenv( 'WP_CONTENT_CUSTOM' ) );
}

if ( defined( 'WP_CONTENT_CUSTOM' ) ) {
  define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . WP_CONTENT_CUSTOM );
  define( 'WP_CONTENT_URL', WP_HOME . '/' . basename( WP_CONTENT_CUSTOM ) );
}

/** A couple extra tweaks for HTTPS **/
// You need to alert Wordpress if you're behind a proxy server and using HTTPS
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

/**
  * Define your custom settings in this file
  */
if ( file_exists( dirname( __FILE__ ) . '/wp-config-override.php' ) ) {
  include( dirname( __FILE__ ) . '/wp-config-override.php' );
}

/**
 * WordPress constants for better performance and security and usability
 */

// Define max memory usage for WordPress
if ( !defined( 'WP_MEMORY_LIMIT' ) ) {
  define( 'WP_MEMORY_LIMIT', getenv( 'WP_MEMORY_LIMIT' ) ?: '128M' );
}

// Increase memory limite when in the admin area
if ( !defined( 'WP_MAX_MEMORY_LIMIT' ) ) {
  define( 'WP_MAX_MEMORY_LIMIT', getenv( 'WP_MAX_MEMORY_LIMIT' ) ?: '256M' );
}

// Auto save time interval in seconds
if ( !defined( 'AUTOSAVE_INTERVAL' ) ) {
  define( 'AUTOSAVE_INTERVAL', getenv( 'WP_AUTOSAVE_INTERVAL' ) ?: 120 );
}

// Set number of post revisions to prevent cluttering on database
if ( !defined( 'WP_POST_REVISIONS') ) {
  define( 'WP_POST_REVISIONS', getenv( 'WP_POST_REVISIONS' ) ?: 3 );
}

// Automatic trash cleaning
if ( !defined( 'EMPTY_TRASH_DAYS' ) ) {
  define( 'EMPTY_TRASH_DAYS', getenv( 'WP_EMPTY_TRASH_DAYS' ) ?: 7 ); // 7 days
}

// Disable all core updates
if ( !defined( 'WP_AUTO_UPDATE_CORE') ) {
  define( 'WP_AUTO_UPDATE_CORE', getenv( 'WP_AUTO_UPDATE_CORE') ?: false );
}

// Disable plugin and theme edition
if ( !defined( 'DISALLOW_FILE_EDIT' ) ) {
  define( 'DISALLOW_FILE_EDIT', getenv( 'DISALLOW_FILE_EDIT') ?: true );
}

/**
* For developers: WordPress debugging mode.
*/
if ( !defined( 'WP_DEBUG' ) ) {
  define( 'WP_DEBUG', getenv( 'WP_DEBUG') ?: false );
}

/* That's all, stop editing! Happy Pressing. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') ) {
  define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
