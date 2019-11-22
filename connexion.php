<?php
/*connexion au db*/

$servername="localhost";
$username="root";
$password="";
$db="intissar";
try {
	$pdo= new PDO("mysql:host=$servername;dbname=$db", $username,$password);
	//echo("connected succesfully");
}
catch (PDOException $e){
	echo("connection failed" . $e->getMessage());
}


















