<?php

namespace System\Core;

/**
 * Controller class
 *
 */
class Controller
{
    public function __construct()
    {
        /*
         * ------------------------------------------------------
         * This is some strange...
         * ------------------------------------------------------
         */

        // Assign the instance of system
        $this->load = $GLOBALS['system'];

        //
        // Create a new property on the 'fly'
        //
        $this->view = $this->load->view();

        //
        // This WORKS! I pretend to do the next into controller
        //
        //      $this->view->render()
        //
        $this->view->view = $this->view;
    }
}
