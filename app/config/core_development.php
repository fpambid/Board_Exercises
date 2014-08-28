<?php
define('ENV_PRODUCTION', false);
define('APP_HOST', 'hello.example.com');
define('APP_BASE_PATH', '/');
define('APP_URL', 'http://hello.example.com/');

define('MIN_NAME', 12);
define('MAX_NAME', 25);

define('MIN_PASS', 6);
define('MAX_PASS', 20);


error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
ini_set('error_log', LOGS_DIR.'php.log');
ini_set('session.auto_start', 0);

//mysql
define('DB_DSN', 'mysql:host=localhost;dbname=board');
define('DB_USERNAME', 'board_root');
define('DB_PASSWORD', 'board_root');
define('DB_ATTR_TIMEOUT', 3);