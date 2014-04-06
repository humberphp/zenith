<?php

global $db;
#starting the users session
//session_start();
require 'Database.php';
require 'userClass.php';
require 'generalClass.php';
 
$userClass = new Users($db);
$generalClass = new General();
 
$errors = array();

?>
