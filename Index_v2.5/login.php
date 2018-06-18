<?php
session_start();

if(isset($_POST['formconnexion'])) {
    $nomconnect = htmlspecialchars($_POST['nomconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    if(!empty($nomconnect) AND !empty($mdpconnect)) {
        $requser = $bdd->prepare("SELECT * FROM membres WHERE nom = ? AND motdepasse = ?");
        $requser->execute(array($nomconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1) {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['onoff'] = $userinfo['onoff'];
              if($userinfo['id'] == 1) {
                header("Location: ../rights/admin.php");
              }
              if($userinfo['groupe'] == 'sti2d'){
                header("Location: ../sti2d/Index.php");
              }
              if($userinfo['groupe'] == 'electrotech'){
                  header("Location: ../electrotech/Index.php");
              }
              
        } else {
            $erreurlog = "Mauvaise combinaison nom /mot de passe";
        }
    } else {
        $erreurlog = "Tous les champs doivent être complétés !";
    }
}

?>