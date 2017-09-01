<?php

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
}
