<?php 
session_start();


 $user = 'root';
 $pass = 'admin';
 
 try{
     
     $bdd = new PDO('mysql:host=localhost;port=3304;dbname=espace_membres;charset=utf8', $user, $pass);
 }
     catch(Exception $e) {
     die('Erreur : '.$e->getMessage());
     }
     if(isset($_SESSION['id'])) {
     if($_SESSION['id'] == 1) {
         include 'rgyuneziyyernbbe478d5rhht.php';  
     } else {
         echo "Connectez vous en tant qu'admin pour avoir accès a cette page !";
     }
     
     } else {
         echo "Connectez vous en tant qu'admin pour avoir accès a cette page !";
     }
     
 ?>