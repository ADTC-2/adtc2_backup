<?php

 $dsn = "mysql:dbname=adtc2m99;host=localhost";
 $dbuser="root";
 $dbpass = "";

 //$dsn = "mysql:dbname=adtc2m99_adtc2;host=50.116.87.140";
 //$dbuser="adtc2m99_adtc2";
 //$dbpass = "Alves1974@";

 try {

 	$pdo = new PDO( $dsn,$dbuser,$dbpass);

 	
 } catch (PDOException $e) {

 	echo "Falhou :".$e->getMessage();
 	
 }










?>