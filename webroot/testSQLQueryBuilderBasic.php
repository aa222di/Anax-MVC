<?php
// Get environment & autoloader.
require __DIR__.'/config.php';




$db = new \Mos\Database\CDatabaseBasic();
$options = require "config_mysql.php";
$db->setOptions($options);
$db->connect();

$db->setVerbose();      // Set verbose mode to on

$db->select()
    ->from('test')
    ->orderBy("id ASC")
;
$db->execute();
 
