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
                    $created = "Votre compte a bien ete cree ! <a href=\"connexion.php\">Me connecter</a>";
                } else {
                    $erreur = "Vos mots de passes ne correspondent pas !";
                }
            } else {
                $erreur = "Le nom saisi est trop long !";
            }
        } else {
            $erreur = "Tous les champs doivent etre completes !";
        }
    }


    ?>
    
    <html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Supervision du panneau</title>
    <link rel="stylesheet" media="screen" type="text/css" href=".\Style.css" /> 
</head>

<body>

 <div class="Bground_grid">
  <div class="Bground_center">
  </div>
 </div>
  
 <div class="wrapper">
 <div class="Border">
  <div class="page">
  
    <div class="demo" id="demo-one">
     <nav class="subnav tabs">
      <ul>
       <li class="active"><a href="#panel-1">S'inscrire</a></li>
       <li><a href="#panel-2">Se connecter</a></li>
      </ul>
     </nav>
    <div class="panels">
   <div class="panel clearfix" id="panel-1">
            
      <div class="login-modal_title">Inscription
      </div>
        <div class="th-form">
        <form autocomplete="off" method="POST" action="">
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
        </div>
       
           <?php
          if(isset($erreur)) {
            echo "<div class='error_form'>";
            echo "$erreur";
            echo "</div>";
            
          }
          ?>
           <?php
          if(isset($created)) {
            echo "<div class='created_form'>" ;
            echo "$created";
            echo "</div>";
            
          }
          ?>
      
        <div>
        <button class="button button_large button_bg-gradient action-button"  name="forminscription"> S'inscrire </button>
        </div>
      </form>  
      </div>
            
   </div>
   <div class="panel clearfix" id="panel-2">
            
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
 </div>
</div>
</div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
<!-- jQuery -->
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

<!-- JavaScript -->
<script src="bd.ui.js"></script>  
  
</body>
     </html>