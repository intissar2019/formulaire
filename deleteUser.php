<?php
include 'connexion.php';
$id=$_GET['id'];

$queryDeleteUser = $pdo->prepare("
	DELETE 
	FROM personne 
	WHERE id=?"
);
$queryDeleteUser->execute([$id]);

header ("location:listAll.php");	
















