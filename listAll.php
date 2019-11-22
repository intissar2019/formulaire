<?php

 include 'connexion.php';

    // Récupération de tous les utilisateurs 
    $query ='SELECT *  FROM personne ';
    $resultSet = $pdo->query($query);
    $users = $resultSet->fetchAll();




 // Sélection et affichage du template PHTML.
    $template = 'listAll';
    include 'layout.phtml';