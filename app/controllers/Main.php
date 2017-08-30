<?php

class Main_Controller extends Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->view->title = "¡First app!";
    $this->view->obj = $this->view;
    $this->view->render('master');
  }
}
