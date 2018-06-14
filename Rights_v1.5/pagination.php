<?php
$user = 'root';
$pass = 'admin';

try{
    
    $bdd = new PDO('mysql:host=localhost;port=3304;dbname=espace_membres;charset=utf8', $user, $pass);
}
catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}


/* Fonction renvoyant l'adresse de la page actuelle */

$adresse = $_SERVER['PHP_SELF'];
$i = 0;
foreach($_GET as $cle => $valeur){
    $adresse .= ($i == 0 ? '?' : '&').$cle.($valeur ? '='.$valeur : '');
    $i++;
}

/* Pagination */

$ParPage = 5;
$adresse = str_replace('/php/rights/', '', $adresse);
$suite = 'admin.php?q';

$TotalesReq = $bdd->query('SELECT id FROM membres');
$Totales = $TotalesReq->rowCount();
$pagesTotales = ceil($Totales/$ParPage);
if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
   $_GET['page'] = intval($_GET['page']);
   $pageCourante = $_GET['page'];
   
} else {
   $pageCourante = 1;
}

$first = 1;
$last = $pagesTotales;
$precedent = $pageCourante-1;
$suivant = $pageCourante+1;
$depart = ($pageCourante-1)*$ParPage;

   if($adresse >= $suite) {
       echo '<div class="nb_p">
               <a href="'.$adresse.'&page='.$first.'">First<<</a>
               </div> ';
   } else {
    
       echo '<div class="nb_p">
               <a href="?page='.$first.'">First<<</a>
               </div>';
   }

   if($adresse >= $suite) {
       echo '<div class="nb_p">
               <a href="'.$adresse.'&page='.$precedent.'">Prev<</a>
               </div> ';
   } else {
       
       echo '<div class="nb_p">
               <a href="?page='.$precedent.'">Prev<</a>
               </div>';
   }
   

   for($i=1;$i<=$pagesTotales;$i++) {
     if($i == $pageCourante) {
         echo '<div class="nb_p_i">';
               echo $i.' ';
         echo '</div>';
       } 
     }
      
   if($adresse >= $suite) {
       echo '<div class="nb_p">
               <a href="'.$adresse.'&page='.$suivant.'">>Next</a>
               </div> ';
   } else {
         
       echo '<div class="nb_p">
               <a href="?page='.$suivant.'">>Next</a>
               </div>';
   }

   
   if($adresse >= $suite) {
       echo '<div class="nb_p">
               <a href="'.$adresse.'&page='.$last.'">>>Last</a>
               </div> ';
   } else {
       
       echo '<div class="nb_p">
               <a href="?page='.$last.'">>>Last</a>
               </div>';
   }
?>
