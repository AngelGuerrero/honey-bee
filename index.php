<?php
/* ------------------------------------------------------
* MAIN CONTROLLER
* ------------------------------------------------------
*
* It names the default controller, and call it when
* there is not a requested controller.
*
* ------------------------------------------------------
*/
define('DEFAULT_CONTROLLER', 'home');


/*
* ------------------------------------------------------
* RESOLVE REQUETS
* ------------------------------------------------------
*
* Take the URI and divide in parts...
*
*/
$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, - 1)).'/';
$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
$routes = explode('/', $uri);


/*
* ------------------------------------------------------
* DEFINE REQUESTS
* ------------------------------------------------------
*
* The first index of array represent the controller name
*/
isset($routes[1])
? $controller = $routes[1]
: $controller = DEFAULT_CONTROLLER;


/*
* ------------------------------------------------------
* There is a method?
* ------------------------------------------------------
*/
isset($routes[2])
? $method = $routes[2]
: $method = "index";

/*
* ------------------------------------------------------
* There is a parameter?
* ------------------------------------------------------
*/
isset($routes[3])
? $param = $routes[3]
: $param = "";


/*
* ------------------------------------------------------
* DEFINE SOME CONSTANTS
* ------------------------------------------------------
*
* When this babe gets the corresponding data, it define
* the constants for working in the app.
*/
// URI
define('URI', $uri);

// Server name
define('SERVER_NAME', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']);

// Base path of the project
define('BASEPATH', SERVER_NAME.$basepath);

// Ruta base del proyecto, frente del index.php/
define('BASE_URL', BASEPATH.'index.php');

// Front of the app path
define('APPPATH', SERVER_NAME.$basepath.'public/app/');

// Font of the static files
define('STATICPATH', APPPATH.'assets/');

// Front of the view folder
define('VIEWPATH', APPPATH.'views/');

// Front of the system folder
define('SYSPATH', SERVER_NAME.$basepath.'system/');


// echo "SERVER_NAME: ".SERVER_NAME."<br>";
// echo "base_url: ".BASE_URL."<br>";
// echo "basepath: ".BASEPATH."<br>";
// echo "apppath: ".APPPATH."<br>";
// echo "viewpath: ".VIEWPATH."<br>";
// echo "SYSPATH: ".SYSPATH."<br>";
// echo "STATICPATH: ".STATICPATH."<br>";


/*
* ------------------------------------------------------
* ENVIRONMENT
* ------------------------------------------------------
*
* Automatically the app tries to know if it is running
* in a remote server or local server.
*
*/
if (SERVER_NAME == "http://localhost")
{
 define('ENVIRONMENT', 'development');
}
else
{
 define('ENVIRONMENT', 'production');
}


/*
* ------------------------------------------------------
* LOAD THE COMMON FUNCTIONS
* ------------------------------------------------------
*/
require_once 'system/core/Common.php';


/*
* ------------------------------------------------------
* LOAD THE MAIN CLASSES
* ------------------------------------------------------
*/
loadClasses('system/core/');

/*
* ------------------------------------------------------
* LOAD THE SYSTEM
* ------------------------------------------------------
*
*
* Here we go... :)
*/
require_once 'system/core/System.php';

$GLOBALS['system'] = new System\Core\System();

$system->controller($controller, $method, $param);
