<?php defined('SYSPATH') OR die('No direct script access.');

define('AWS_V3_MOD_PATH', dirname(__FILE__));

define('AWS_V3_AUTOLOAD', AWS_V3_MOD_PATH . DIRECTORY_SEPARATOR . 'vendor'
    . DIRECTORY_SEPARATOR . 'aws'
    . DIRECTORY_SEPARATOR . 'vendor'
    . DIRECTORY_SEPARATOR . 'autoload.php');

/**
 * Use dynamo db when dynamo is specified.
 */
if (!empty($_SERVER['AWS_DYNAMO_SESSION']) && php_sapi_name() != 'cli')
{
    $aws = parse_ini_file($_SERVER['AWS_DYNAMO_SESSION'], true);
    $handler = AWS_Dynamo::register_session_handler($aws);
}
