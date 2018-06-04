<?php

$user = 'root';
$pass = 'admin';

try{
    
    $bdd = new PDO('mysql:host=localhost;port=3304;dbname=espace_membres;charset=utf8', $user, $pass);
}
catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}

$delete = $bdd->query('SELECT id FROM membres');
$fordelete = $delete->fetch();
$iddelete = (!empty($_GET['id']))? intval($_GET['id']) : 0;
$bdd->exec("DELETE FROM membres WHERE id='$iddelete'");
header('Location:rights.php');

?>