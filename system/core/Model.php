<?php
namespace System\Core;

/**
 * Model class
 */
class Model extends Database
{
    public function __construct()
    {
        parent::__construct();

        $this->system = $GLOBALS['system'];

        // I pretend to do the next
        //
        //      $this->db->insert();
        //
        $this->db = $this->system->db;
        $this->db->db = $this->db;
    }
}
