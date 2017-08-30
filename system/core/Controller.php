<?php
/**
 * Class controller
 *
 * 
 */
class Controller
{
  protected $view;

  function __construct()
  {
    $this->view = new View();

    $this->load = new Loader();
  }

}
