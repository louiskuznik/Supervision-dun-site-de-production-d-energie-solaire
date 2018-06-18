<?php

if(isset($_POST['forminscription'])) {
    $reponse = $bdd->query('SELECT nom FROM membres WHERE nom = "' . $_POST['nom'] . '" ');
    $register = $reponse->fetch();
    $nom = htmlspecialchars($_POST['nom']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    if(!empty($_POST['nom']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
        $nomlength = strlen($nom);
        if($nomlength <= 20) {
            if($mdp == $mdp2) {
                if (strtolower($_POST['nom']) != strtolower($register['nom'])) {
                    if(6 <= $mdp) {
                        if(6 <= $nomlength) {
                          $insertmbr = $bdd->prepare('INSERT INTO membres(nom, motdepasse) VALUES(?, ?)');
                          $insertmbr->execute(array($nom, $mdp));
                          $created = "Votre compte a bien ete créé !";
                        } else {
                            $erreur = "Entrer votre nom ! (format p.nom)";
                        }
                    } else {
                        $erreur = "Le mot de passe doit au minimum contenir 6 caractères.";
                    }
                } else {
                    $erreur = "Ce nom d'utilisateur est déjà utilisé.";
                }
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