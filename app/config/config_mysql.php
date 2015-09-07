<?php

return [
    'dsn'     => "mysql:host=localhost;dbname=tutorial;",
    'username'        => "root",
    'password'        => "root",
    'driver_options'  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    'table_prefix'    => null,
    'verbose' 		  => false,
    //'debug_connect' => 'true',
];
