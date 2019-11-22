<?php


include'connexion.php';



$error=[];//ARRAY CONTIENT TOUS LES ERREURS DANS LE FORM 



/****** CONTROLE DE SAISIE**********************/
if(isset($_POST["nom"])&&(isset($_POST["prenom"]))&&(isset($_POST["email"]))&&(isset($_POST["tel"]))&&isset($_POST["profil"])&&(isset($_FILES["fileToUpload"])))
{
		$nom=$_POST["nom"];
		$prenom=$_POST["prenom"];
		$email=$_POST["email"];
		$tel=$_POST["tel"];
		$profil=$_POST["profil"];
		$university=$_POST["university"];
		

		if(strlen($nom)<3 || strlen($nom)>20){
			array_push($error,'Saisir un nom entre 3 et 20 caractère ');
		}


		if(strlen($prenom)<3 || strlen($prenom)>20){
			array_push($error,'Saisir un prenom entre 3 et 20 caractère ');
		}


		if (! filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			array_push($error,'saisir une format email valide');
		}




		if(! is_numeric($tel)||strlen($tel)<6 || strlen($tel)>10){
			array_push($error,'saisir un numéro de Tel format numérique  entre 6 et 10 chiffres svp !');
		}


		/******Traittement de input file *******/

			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


			// Check taille fichier
			if ($_FILES["fileToUpload"]["size"] > 1000000) {
			   array_push($error,"Fichier photo  est trop volumineux.");
			 
			}
			// Format specifiée a allouer
			if($imageFileType != "jpg" && $imageFileType != "png") {
			   array_push($error,"Que les fichiers  JPG & PNG sont  alloués.");
			    
			}




		if($profil=='Etudiante'){
			if ((strlen($university)< 3) ||( strlen($university)> 20)) {
				array_push($error,"le nom d'université  doit avoir  entre 3 et 20 caractères !");
			}
		$activity = "";	
		}


		if($profil=='Professionnel'){
			if (empty($_POST['activity'])) {
				array_push($error,'Vous devez cocher au moins une activité ');
			}
			else{
			$activity = implode("#",$_POST['activity']);
			}
			$university="";
		}







if (empty($error)) {

		$photo=$_FILES["fileToUpload"]["name"];


		$pays=$_POST["pays"];
		if ($pays=='france') {
			$tel='0033'.$tel;
		}
		else{
			$tel='00216'.$tel;
		}


		/***Interdire de s'inscrire avec un email deja existant***/
		 $queryUser =
        '
            SELECT
                email
            FROM
                personne
            WHERE
                email = ?
        ';
        $result = $pdo->prepare($queryUser);
        $result->execute([$email]);
        $user = $result->fetch();
        if ($user) {
 			array_push($error,'Il existe un utilisateur avec cette adresse mail');
     
 			  }
 			  else{
       



/*traitement requete  sql INSERT*/
$query = 

		'
		 INSERT INTO personne
			( nom, prenom, email, pays,tel,profil,university,activity,photo)
		 VALUES (?,?,?,?,?,?,?,?,?)
		';

		$resultSet = $pdo->prepare($query);

			

			$resultSet->execute([
				$nom,
				$prenom,
				$email,
				$pays,
				$tel,
				$profil,
				$university,
				$activity,
				$photo
			]);

			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir . basename($_FILES['fileToUpload']['name']));


			/*redirection au page qui contient le liste des utilisateurs*/
    		header('Location: listAll.php');
			 exit();


}
}


}



else {
	array_push($error,'Merci de remplir  tous les champs et cocher ton profil');
}








 // Sélection et affichage du template PHTML.
    $template = 'addUser';
    include 'layout.phtml';












