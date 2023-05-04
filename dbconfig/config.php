<?php
ob_start();

try {

	//$con = new PDO("mysql:dbname=newsdb;host=localhost:3307", "root", "");
	$con = new PDO("mysql:host=sql208.epizy.com;dbname=epiz_33122182_newsdb", "epiz_33122182", "n6UMe8PoYDutOp");
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch(PDOExeption $e) {
	echo "Connection failed: " . $e->getMessage();
}
?>