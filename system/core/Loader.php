<?php

/**
 * Class Loader
 *
 * The idea for this class is that load the different components
 * of the "framework".
 *
 */
class Loader
{

  function __construct()
  {
  }

  /**
   * Load an controller
   *
   * @param  string $controllerName This is the name of the file
   * @param  string $methodName     Some public method of the class calling
   * @param  mixed $param          Some parameter for the methodName
   * @return void
   */
  public function controller($controllerName, $methodName = "", $param = "")
  {
    $view = new view();

    if ( ! isset($controllerName) || $controllerName == "")
    {
      $controllerName = DEFAULT_CONTROLLER;
    }

    //
    // Check if the file exists
    //
    $controller_path = 'app/controllers/'.ucfirst($controllerName).'.php';

    if (file_exists($controller_path) )
    {
      // Set the name of the class, adding the suffix _Controller
      $classname = ucfirst($controllerName.'_Controller');

      //
      // Autocarga el controlador o su clase correspondiente
      //
      spl_autoload_register(function($classname) use ($controllerName) {
        $filename = "app/controllers/".ucfirst($controllerName).'.php';
        require($filename);
      });

      //
      // New instance of controller
      //
      $obj = new $classname();

      //
      // Try to load the method if exists
      //
      if (isset($methodName) && $methodName != "")
      {
        if (method_exists($obj, $methodName))
        {
          call_user_func(array($obj, $methodName), $param);
        }
        else
        {
          echo "<br> The method: '$methodName' that you are trying to call, it does not exist or I can not find it...<br>";
          exit(1);
        }
      }
      else
      {
        //
        // Call the default method, index
        //
        call_user_func(array($obj, "index"), $param);
      }
    }
    else
    {
      echo "<br>The Controller: '$controllerName' that you are trying to call, it does not exist or I can not find it...<br>";
    }
  }

  /**
   * Load the View class and create a new instance of it.
   * @return void
   */
  public function view()
  {
    //
    // Autocarga el controlador o su clase correspondiente
    //
    $classname = "View";
    spl_autoload_register(function($classname) {
      $filename = "View.php";
      require($filename);
    });

    //
    // Crea una instancia de la clase solicitada
    //
    $obj = new $classname();

    return $obj;
  }

  /**
   * Load a lot of clases in given folder or path
   * @param  string $dir Folder or path for search the classes to load
   * @return void
   */
  public function autoload($dir)
  {
    // echo "dir: $dir<br>";
    //
    // Realiza un autocarga de clases
    //
    $files = scandir($dir);

    $objetos = array();

    foreach($files as $file)
    {
      if ($file != "." && $file != "..")
      {
        // echo "El file: $file<br>";
        $classname = basename($file, '.php');
        // echo "className: $classname<br>";

        spl_autoload_register(function($classname) use ($dir, $file) {
          require_once($dir.$file);
          // echo "Cargando: $dir$file<br>";
        });
      }
    }
  }
}
