<?php

/*
 * ------------------------------------------------------
 * CONFIG FOR THE CONNECTION OF THE DATABASE
 * ------------------------------------------------------
 *
 * Data for set the connection
 */
if (ENVIRONMENT == "development")
{
  //
  // Here put your data
  // for local server database
  //
  return $config = array(
    'hostname' => '',
    'username' => '',
    'password' => '',
    'database' => ''
  );
}
else
{
  //
  // Here put your data config of
  // your remote server database
  //
  return $config = array(
    'hostname' => 'remote_hostname',
    'username' => 'remote_username',
    'password' => 'remote_database_password',
    'database' => 'remote_database'
  );
}
