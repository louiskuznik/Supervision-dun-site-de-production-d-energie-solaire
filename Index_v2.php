<?php

$user = 'root';
$pass = 'admin';

try{
    
    $bdd = new PDO('mysql:host=localhost;port=3304;dbname=espace_membres;charset=utf8', $user, $pass); 
}
    catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
    }
    
    
    
    if(isset($_POST['forminscription'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $mdp = sha1($_POST['mdp']);
        $mdp2 = sha1($_POST['mdp2']); 
        if(!empty($_POST['nom']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
            $nomlength = strlen($nom);
            if($nomlength <= 20) {
                if($mdp == $mdp2) {
                    $insertmbr = $bdd->prepare('INSERT INTO membres(nom, motdepasse) VALUES(?, ?)');
                    $insertmbr->execute(array($nom, $mdp));
                    $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                } else {
                    $erreur = "Vos mots de passes ne correspondent pas !";
                }
            } else {
                $erreur = "Le nom saisi est trop long !";
            }
        } else {
            $erreur = "Tous les champs doivent être complétés !";
        }
    }


    ?>

    
<html>
<head>
    <meta charset="utf-8">
    <title>Supervision du panneau</title>
    <link rel="stylesheet" media="screen" type="text/css" href=".\Style.css" /> 
</head>

<body>
<div>
  <div class="Bground_grid">
    <div class="Bground_center">
    </div>
  </div>
  <div>
  <div class="button_center">
    <a href="#" data-width="414" data-rel="modal1" class="modal_open button button_dashed-border button_medium button_grey">Connexion</a>
    <a href="#" data-width="414" data-rel="modal2" class="modal_open button button_dashed-border button_medium button_grey">Inscription</a>
  </div>
  <div class="button_admin">
    <a href="#" data-width="414" data-rel="modal3" class="modal_open button_adm button_dashed-border button_size_admin button_grey">Admin</a>
  </div>
  </div>
</div>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	   
	//Lorsque on clique sur un lien de la classe modal_open
	$('a.modal_open').on('click', function() {
		var popID = $(this).data('rel'); //Trouve le modal correspondant
		var popWidth = $(this).data('width'); //Trouve la largeur

		//Fait apparaître le modal et ajoute le bouton de fermeture
		$('#' + popID).fadeIn().css({ 'width': popWidth}).prepend('<a href="#" class="close"><img src="close-green@2x.png" class="btn_close" title="Close Window" alt="Close" /></a>');
		
		//Récupération du margin, qui permettra de centrer la fenêtre
		var popMargTop = ($('#' + popID).height()) / 2;
		var popMargLeft = ($('#' + popID).width()) / 2;
		
		//Apply Margin to Popup
		$('#' + popID).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		//Apparition du fond
		$('body').append('<div id="fade"></div>');
		$('#fade').css({'filter' : 'alpha(opacity=70)'}).fadeIn();
		
		return false;
	});
	
	
	//Close Popups and Fade Layer
	$('body').on('click', 'a.close, #fade', function() { //Au clic sur le body...
		$('#fade , .popup_block').fadeOut(function() {
			$('#fade, a.close').remove();  
	}); //...ils disparaissent ensemble
		
		return false;
	});
	
});
</script>

<!-- modal Connexion -->
<div id="modal1" class="th-modal popup_block">
  <div class="login-modal">
    <div class="login-modal_content">
      <div class="login-modal_title">Connexion
      </div>
      <div class="th-form">
        <div class="th-form_row">
          <div class="th-form_column">
            <div class="th-form_input-title">Nom de compte
            </div>
            <input class="input_underline" placeholder="Entrer votre nom de compte">
          </div>
        </div>    
        <div class="th-form_row">
          <div class="th-form_column">    
            <div class="th-form_input-title">Mot de passe
            </div>
            <input class="input_underline" type="password" placeholder="Entrer le mot de passe"> 
          </div>
        </div>
        <div><a href="" class="button button_large button_bg-gradient action-button">Se connecter</a>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- modal Inscription -->
<div id="modal2" class="th-modal popup_block">
  <div class="login-modal">
    <div class="login-modal_content">
      <div class="login-modal_title">Inscription
      </div>
        <div class="th-form">
        <form method="POST" action="">
        <div class="th-form_row">
          <div class="th-form_column">
            <div class="th-form_input-title">Nom de compte
            </div>
            <input class="input_underline" placeholder="Format p.nom (1ere lettre prenom.nom)" id="nom" name="nom" value="<?php if(isset($nom)) { echo "$nom"; } ?>" />
          </div>
        </div>    
        <div class="th-form_row">
          <div class="th-form_column">    
            <div class="th-form_input-title">Mot de passe
            </div>
            <input class="input_underline" type="password" placeholder="Choisissez un mot de passe"  id="mdp" name="mdp" /> 
          </div>
        </div>
        <div class="th-form_row">
          <div class="th-form_column">    
            <div class="th-form_input-title">Confirmation mot de passe
            </div>
            <input class="input_underline" type="password" placeholder="Confirmez le mot de passe"  id="mdp2" name="mdp2" /> 
          </div>
          <div>
           <?php
          if(isset($erreur)) {
            echo "$erreur";
            
          }
          ?>
          </div>
        </div>
        <div><input type="submit" class="button button_large button_bg-gradient action-button"  name="forminscription" value="S'inscrire" />
        </div>
      </form>  
      </div>
    </div>
  </div>
</div>

<!-- modal Admin -->
<div id="modal3" class="th-modal popup_block">
  <div class="login-modal">
    <div class="login-modal_content">
      <div class="login-modal_title">Admin
      </div>
      <div class="th-form">
        <div class="th-form_row">
          <div class="th-form_column">    
            <div class="th-form_input-title">Mot de passe
            </div>
            <input class="input_underline" type="password" placeholder="Entrer le mot de passe administrateur"> 
          </div>
        </div>
        <div><a href="" class="button button_large button_bg-gradient action-button">Se connecter</a>
        </div>
      </div>
    </div>
  </div>
</div>






</body>
</html>
