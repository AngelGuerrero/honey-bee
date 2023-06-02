<?php

/**
 * Class Loader
 *
 * The idea for this class is that load the different components
 * of the "library".
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
    $controller_path = 'app/controllers/' . ucfirst($controllerName) . '.php';

    if (file_exists($controller_path)) {
      $className = ucfirst($controllerName . '_Controller');

      //
      // Autoload the controller or the class
      //
      spl_autoload_register(function ($className) use ($controllerName) {
        $filename = "app/controllers/" . ucfirst($controllerName) . '.php';
        require($filename);
      });

      //
      // New instance of controller
      //
      $obj = new $className();

      //
      // Try to load the method if exists
      //
      if (isset($methodName) && $methodName != "") {
        if (method_exists($obj, $methodName)) {
          call_user_func(array($obj, $methodName), $param);
        } else {
          echo "<br> The method: '$methodName' of '$controllerName' that you are trying to call, it does not exist or I can not find it...<br>";
          exit(1);
        }
      }
    } else {
      echo "<br>The Controller: '$controllerName' that you are trying to call, it does not exist or I can not find it...<br>";
    }
  }

  /**
   * Load the View class and create a new instance of it.
   * @return void
   */
  public function view(): View
  {
    //
    // Autoload the View class
    //
    $className = "View";
    spl_autoload_register(function ($className) {
      $filename = "View.php";
      require($filename);
    });

    $obj = new $className();

    return $obj;
  }

  /**
   * Load a lot of clases in given folder or path
   * @param  string $dir Folder or path for search the classes to load
   * @return void
   */
  public function autoload($dir)
  {
    $files = scandir($dir);

    foreach ($files as $file) {
      if ($file != "." && $file != "..") {
        spl_autoload_register(function ($className) use ($dir, $file) {
          require_once($dir . $file);
        });
      }
    }
  }
}