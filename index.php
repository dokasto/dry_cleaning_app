<?php
session_start();
// **PREVENTING SESSION HIJACKING**
// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);


// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_only_cookies', 1);

// Uses a secure connection (HTTPS) if possible
ini_set('session.cookie_secure', 1);

/* Global Variables */
$UID = '';

// Configuration file
require 'app/inc/config.php';

// Slim Framework
require 'vendor/Slim/Slim.php';

// useful functions
require 'app/inc/functions.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

/* some important template configurations */
define('ADMIN_HEADER','app/views/admin/tpl/header.inc.php');
define('ADMIN_FOOTER','app/views/admin/tpl/footer.inc.php');
define('ADMIN_VIEWS','app/views/admin');

define('CLIENT_HEADER','app/views/client/tpl/header.php');
define('CLIENT_FOOTER','app/views/client/tpl/footer.php');
define('CLIENT_VIEWS','app/views/client');

define('PUBLIC_HEADER','app/views/visitor/tpl/header.php');
define('PUBLIC_FOOTER','app/views/visitor/tpl/footer.php');
define('PUBLIC_VIEWS','app/views/visitor');

/* include routes */
require 'app/routes/admin-service.php';
require 'app/routes/admin.php';
require 'app/routes/client-service.php';
require 'app/routes/client.php';
require 'app/routes/public.php';

$app->run();

