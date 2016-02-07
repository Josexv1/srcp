<?php

@ini_set('display_errors', true);
@ini_set('html_errors', true);
if (!defined('E_DEPRECATED')) {
    @error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
    @ini_set('error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE);
} else {
    @error_reporting(E_ALL ^ E_WARNING ^ E_DEPRECATED ^ E_NOTICE);
    @ini_set('error_reporting', E_ALL ^ E_WARNING ^ E_DEPRECATED ^ E_NOTICE);
}
define('SRCP', true);
define('ROOT_DIR', dirname(__FILE__));
define('CORE_DIR', ROOT_DIR.'/core');

require_once ROOT_DIR.'/core/core.php';
