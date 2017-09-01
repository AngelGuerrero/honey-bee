<?php

include 'system/core/System.php';

//
// Load a default controller where there are not
// a request for controller
//
define('DEFAULT_CONTROLLER', 'home');


//
// Init the party...!
//
$system = new System();
$system->init();
