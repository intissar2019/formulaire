
	function isEmail(email) {
  		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  		return regex.test(email);
	}






/** Evenements sur les inputs pays et profil**/
$( '#pays').change(function() {
  if($('select option:selected').text()=='FRANCE'){
	$('#préfixe').html("0033");
}
if($('select option:selected').text()=='TUNISIE'){
	$('#préfixe').html("00216");
}

});

$("input[type=radio][name=profil]").change(function() {
  if($(this).val() == 'Etudiante') {
     $('#espaceEtudiant').removeClass( "hidden" );
     $('#espaceProf').addClass( "hidden" );
  }
  else  {
    // Traitement si  professionnel est coché
   $('#espaceProf').removeClass( "hidden" ); 
    $('#espaceEtudiant').addClass( "hidden" );

  }
});


/*Commenter ce section pour visualiser le controle  au niveau PHP*/

$('#register').click( function(e){


		nom=$('#nom').val();
		prenom=$('#prenom').val();
		email=$('#email').val();
		tel=$('#tel').val();
		profil=$('input[name=profil]:checked').val();
		université=$('#université').val();
		



/*champs compris entre 3 et 2O caractere*/

	if(nom.length <  3 || nom.length > 20 ){
		e.preventDefault();
		$('#nom').addClass('is-invalid');
		$('#invalidnom').html('Saisir un nom entre 3 et 20 caractère');
	}
	else{
		$('#nom').addClass('is-valid');
		$('#validnom').html('succès');
	}



	if(prenom.length < 3 || prenom.length> 20 ){
		e.preventDefault();
		$('#prenom').addClass('is-invalid');
		$('#invalidprenom').html('Saisir un nom entre 3 et 20 caractère');
		
	}
	else{
		$('#prenom').addClass('is-valid');
		$('#validprenom').html('succès');
	}



	if(profil=='Etudiante') {
	if(profil.length < 3 || profil.length > 20 ){
		e.preventDefault();
		$('#université').addClass('is-invalid');
		$('#invaliduniversité').html('Merci de saisir un champs  entre 3 et 20 chiffres  !');
		
	}
	else{
	 	$('#université').addClass('is-valid');
	 	$('#validuniversité').html('succès');

	}
}



  /*Type mail*/
	if(isEmail(email) == false ){
		e.preventDefault();
		$('#invalidemail').html('Saisir un email valide !');
		$('#email').addClass('is-invalid');
	}
	else{
		$('#email').addClass('is-valid');
		$('#validmail').html('succès');
	}



/*champ numérique et compris entre 6 et 10 chiffre*/

var compteur=0;
	for(i=0;i<tel.length;i++){
		if ($.inArray( tel[i], ['0','1','2','3','4','5','6','7','8','9'] )> -1 ){
			compteur++;
		}
	}
	

if(tel.length < 6 || tel.length> 10|| (tel.length>compteur))
{
	e.preventDefault();
	$('#tel').addClass('is-invalid');
	$('#invalidetel').html('Saisir champ numérique  et entre 6 et 10 chiffres  !');
}
else{
	$('#tel').addClass('is-valid');
	$('#validetel').html('succès');
}




/***Au moins une activité cochée*****/
		if ($(":checkbox:checked").length == 0) {
			    e.preventDefault();
               	$('#invalidactivity').html('Au moins une activité doit Etre cochée');

		}
		else{
			$('#validactivity').html('succès');
		}


/***Validation du file*****/



var file = document.getElementById('fileToUpload').files[0];


		var fileName = file.name;
		var content;
		var size = file.size;
		var ext = fileName.match(/\.([^\.]+)$/)[1];
    		ext = ext.toLowerCase();
    		if( ((ext!="png")&&(ext!="jpg")) || ((size/(1024*1024)) > 1)||(!file) ){
    			e.preventDefault();
    			$('#invalidefile').html('Télécharger une fichier JPG & PNG  et de taille  inférieur à  1MO .');
    		}
    		else{
    			$('#validfile').html('succès.');
    		}

	
    
          


	});

/*** fin test validation**/





/** RAZ**/
 $( "#reset" ).click(function(e) {
    $('form').trigger('reset');
    $('#espaceProf').addClass( "hidden" ); 
    $('#espaceEtudiant').addClass( "hidden" );
    $('.text-danger').html('');
    $('.valid-feedback').html('');
    
    $('input').removeClass('is-valid');
    $('input').removeClass('is-invalid');

      });


