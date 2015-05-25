<?php

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

//$app_url = $_SERVER['REQUEST_URI'] ;
//echo $app_url;


/**
 * Set the application mode
 * Types: Development / Production
 */
define('APP_MODE','Production') ;

/* Temporary storage Directory */
define('TEMP_DIR','data/tmp/') ;

/* max file size for profiles 5MB */
define('IMG_MAX_SIZE',5000000) ;


/**
 * Configuration for: Project URL
 * Put your URL here, for local development "127.0.0.1" or "localhost" (plus sub-folder) is fine
 */
define('URL', 'http://localhost:4000/dry_cleaning_app');


define('SITENAME', 'Culmen Dry Cleaners');
define('SITE_ADDRESS', 'Shop 1, Block 3,  Bishop Oluwole Steet, Victoria Island, Lagos');
define('SITE_ADDRESS_2', 'No 41, Abel Abayomi Steet, Harmony Estate, Ajah, Lagos');

define('FROM_EMAIL', 'no-reply@culmendrycleaners.com');
define('ADMIN_EMAIL', 'info@culmendrycleaners.com');

/* social media */
define('SOCIAL_FACEBOOK','');
define('SOCIAL_TWITTER','');
define('SOCIAL_GOOGLE','');

/* site contact details */
define('CONTACT_PHONE', '08181953938 | 08088400566 | 01-2904111');
define('CONTACT_EMAIL', 'info@culmendrycleaners.com');

/**
 * Configuration for: database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'dmasnigc_culmen');
define('DB_USER', 'dmasnigc_culmen');
define('DB_PASS', ']T$RX?aAp^H2');


