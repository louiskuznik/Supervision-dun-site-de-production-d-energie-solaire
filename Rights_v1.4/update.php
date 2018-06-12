<?php

$user = 'root';
$pass = 'admin';

try{
    
    $bdd = new PDO('mysql:host=localhost;port=3304;dbname=espace_membres;charset=utf8', $user, $pass);
}
catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}

if(isset($_POST['update'])) {
    while($forup = $up->fetch()) {
    
    $idup = $forup['id'];
    for ($i=1; $i<=$idup; $i++) {
        $grp_u = $_POST['update_grp'];
        return $grp_u;
    }
    $update_req = $bdd->prepare("UPDATE membres SET groupe='$grp_u' WHERE id='$idup'");
    $update_req->execute();
    echo $grp_u;
    }

}

?>