<?php

$config = array(
	'host'		=> 'dbkrunalphp.db.12276207.hostedresource.com',
	'username'	=> 'dbkrunalphp',
	'password'	=> 'Myleftfoot123@',
	'dbname' 	=> 'dbkrunalphp'
);
#connecting to the database by supplying required parameters
$db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
 
#Setting the error mode of our db object, which is very important for debugging.
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
# We are storing the information in this config array that will be required to connect to the database.
//$config = array(
//	'host'		=> 'my02.winhost.com',
//	'username'	=> 'matrimony',
//	'password'	=> 'zenith@humber',
//	'dbname' 	=> 'mysql_65818_matrimony'
//);
//#connecting to the database by supplying required parameters
//$db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
// 
//#Setting the error mode of our db object, which is very important for debugging.
//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
