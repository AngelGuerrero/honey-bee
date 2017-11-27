<?php

namespace System\Core;

/*
 * ------------------------------------------------------
 * SYSTEM CLASS
 * ------------------------------------------------------
 *
 *
 */
class System
{
    /**
     * Save the MySQL connection
     *
     * @var object
     */
    public $connection;

    /**
     * It is the access to the System Class methods
     *
     * @var mixed
     */
    public $load;


    /**
     * Save the instance of Database Class for use the methods
     * Connect and Close Connection
     *
     * @var object
     */
    public $db;


    // -----------------------------------------------------------------

    public function __construct()
    {
        $this->init();
    }

    // -----------------------------------------------------------------

    private function init()
    {
        $this->view = new View();
        $this->view->view = $this->view;

        // new Bootstrap();
    }

    /**
    * Load a controller
    *
    * @param  string $controllerName Nombre del controlador a cargar
    * @param  string $methodName     Nombre del método a llamar del controlador
    * @param  string $param          Parámetro dado para el método
    * @return void
    */
    public function controller($controllerName, $methodName = "", $param = "")
    {

        //
        // Check the existence of requested controller
        //
        if (file_exists('public/app/controllers/'.ucfirst($controllerName).'.php')) {

            // Set the controller class name, adds '_Controller'
            $classname = ucfirst($controllerName) . '_Controller';

            //
            // Auto load the controller
            //
            spl_autoload_register(function ($classname) use ($controllerName) {
                $filename = "public/app/controllers/".ucfirst($controllerName).".php";
                require_once($filename);
            });

            //
            // Create a new instance for the requested class
            // calling the correspondent namespace
            //
            $namespace = 'System\\App\\'.$classname;
            $obj = new $namespace();

            //
            // Try to call the requested methods if exists
            //
            if (isset($methodName) && $methodName != "") {
                if (method_exists($obj, $methodName)) {
                    call_user_func(array($obj, $methodName), $param);
                } else {
                    $this->view->title = "Page not found :(";
                    $this->view->page = "404";
                    $this->view->place = "views/errors/";
                    $this->view->message = "The method '$methodName' doesn't exists, verify your URL.";
                    $this->view->render('errors/base');
                }
            } else {
                //
                // If there is not a method, call the main function index
                //
                call_user_func(array($obj, "index"), $param);
            }
        } else {
            $this->view->title = "Page not found:( ";
            $this->view->page = "404";
            $this->view->place = "views/errors/";
            $this->view->message = "Error 404, the controller ".$controllerName." not found.";
            $this->view->render("errors/base");
        }
    }

    /**
     * Create a new connection to the database
     *
     * Create a new instance of the Database class
     *
     * @return void
     */
    public function database()
    {
        $this->db = new Database();
        $this->connection = $this->db->connect();
    }


    /**
     * Load a specific model
     *
     * Loads the models
     *
     * @return void
     */
    public function model($classname, $alias = "")
    {
        $pathFile = 'public/app/models/'.$classname.'.php';

        /*
         * ------------------------------------------------------
         * If the file doesn't exist, there is nothing to do... :(
         * ------------------------------------------------------
         */

        if (! file_exists($pathFile)) {
            echo "El archivo $classname.php modelo no existe";
            exit(1);
        }

        require(dirname(__FILE__).'../../../public/app/models/'.$classname.'.php');

        // Just save the class name with its namespace
        $namespace = 'System\\App\\'.$classname;

        if (isset($alias) && $alias != "") {
          $this->$alias     = new $namespace();
        } else {
          $this->$classname = new $namespace();
        }

    }


    /**
     * View function
     * @return object Returns a view instance
     */
    public function view()
    {
        return new View();
    }
}
