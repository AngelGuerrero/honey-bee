<?php

namespace System\App;

use System\Core\Controller as Controller;

class Home_Controller extends Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->view->title = "¡First app!";
    $this->view->view = $this->view;
    $this->view->render('welcome');
  }

  // public function test()
  // {
  //   $this->view->title = "Este es un test";
  //   $this->view->raw('Esta es mi vista de prueba');
  //   $this->view->render();
  // }
}
