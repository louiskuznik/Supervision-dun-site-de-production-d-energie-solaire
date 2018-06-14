<?php 

 $user = 'root';
 $pass = 'admin';
 
 try{
     
     $bdd = new PDO('mysql:host=localhost;port=3304;dbname=espace_membres;charset=utf8', $user, $pass);
     
     }
     catch(Exception $e) {
     die('Erreur : '.$e->getMessage());
     } 
     
 ?>
 
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Supervision du panneau</title>
    <link rel="stylesheet" media="screen" type="text/css" href=".\..\Style.css" /> 
  </head>

  <body> 

    <div class="Bground_grid">
      <div class="Bground_center">
      </div>
    </div>
 
 
    <div class="border border_r">
     <div class="back_r">

      <div class="page_title">Gestion des droits
      </div>
      
      <div class="deco">
      <a href="deconnexion.php" class="btn save-button"> Se déconnecter </a>
      </div>
     
<div class="pagination" >
  <?php 
    include 'pagination.php';
  ?>
</div>  
      
      <div class="search_menu">
       <form method="GET">

        <?php
         $search = $bdd->query('SELECT id, nom, DATE_FORMAT(datedinscript, "%d/%m/%Y") as format_euro, onoff, groupe FROM membres WHERE id !="1" ORDER BY datedinscript DESC LIMIT '.$depart.','.$ParPage);
         $delete = $bdd->query('SELECT id, nom, DATE_FORMAT(datedinscript, "%d/%m/%Y") as format_euro, onoff, groupe FROM membres WHERE id !="1" ORDER BY datedinscript DESC LIMIT '.$depart.','.$ParPage);
         $up = $bdd->query('SELECT id, nom, DATE_FORMAT(datedinscript, "%d/%m/%Y") as format_euro, onoff, groupe FROM membres WHERE id !="1" ORDER BY datedinscript DESC LIMIT '.$depart.','.$ParPage);
           if(isset($_GET['q'])) {
             $q = htmlspecialchars($_GET['q']);
             $grp = htmlspecialchars($_GET['grp']);
             $date = htmlspecialchars($_GET['date']);
             $search = $bdd->query('SELECT id, nom, DATE_FORMAT(datedinscript, "%d/%m/%Y") as format_euro, onoff, groupe FROM membres WHERE nom LIKE "%'.$q.'%" AND groupe LIKE "%'.$grp.'%" AND datedinscript LIKE "%'.$date.'%"  AND id !="1" ORDER BY datedinscript DESC LIMIT '.$depart.','.$ParPage);
             $delete = $bdd->query('SELECT id, nom, DATE_FORMAT(datedinscript, "%d/%m/%Y") as format_euro, onoff, groupe FROM membres WHERE nom LIKE "%'.$q.'%" AND groupe LIKE "%'.$grp.'%" AND datedinscript LIKE "%'.$date.'%"  AND id !="1" ORDER BY datedinscript DESC LIMIT '.$depart.','.$ParPage);
             $up = $bdd->query('SELECT id, nom, DATE_FORMAT(datedinscript, "%d/%m/%Y") as format_euro, onoff, groupe FROM membres WHERE nom LIKE "%'.$q.'%" AND groupe LIKE "%'.$grp.'%" AND datedinscript LIKE "%'.$date.'%"  AND id !="1" ORDER BY datedinscript DESC LIMIT '.$depart.','.$ParPage);
           }
         ?>
     
        <div class="search-user">
         <input placeholder="Rechercher un nom" name="q" />
        </div>
     
        <div>
     
       <div>
         <select name="grp" id="search_grp">
           <option value="">[Pas de sélection]</option>
           <option value="sti2d">sti2d</option>
           <option value="electrotech">electrotech</option>
           <option value="/">/</option>
         </select>
       </div>
       
       <?php 
         include 'search_month.php'; /* auto incrementation du mois */
       ?>
       
       <div >
         <input class="btn search-button" type="submit" value="Rechercher" />
       </div>
       
      </div>
     </form>
    </div>
    
    <?php
      if(!empty($_GET['q'])) {
        echo '<div class="echo_search"> Résultat de la recherche pour : "';
        echo $q;
        echo '"</div>';
     }
    ?>

    <div class="back_d">
     <div class="header_d">
    
     </div>
 
<!-- jQuery -->  
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

<!-- JavaScript -->
<script src="modal.js"></script>

<?php 

    while($fordelete = $delete->fetch()) {
      echo'<div class="delete_s">';
        echo'<a data-width="414" data-rel="modal'; echo $fordelete['id']; echo'" class="link_delete modal_open" href="#"><img src="Delete.png" alt="supprimer"/></a></td>
           </div>';
        
        
        // modal Confirmation
echo'<div id="modal'; echo $fordelete['id']; echo'" class="th-modal popup_block">
       <div class="login-modal">
         <div class="login-modal_content">
           <div class="login-modal_title">Supprimer '; echo $fordelete['nom'];
    echo' ?</div>
           <div class="th-form">
             <div><a href="delete.php?id='; echo $fordelete['id']; echo'" class="button button_large button_bg-gradient action-button">Confirmer</a>
             </div>
           </div>
         </div>
       </div>
     </div>';
   }
   
?>
  
</div>

<div class="content-table menu-table">
  <div class="table-header">
    <div class="first"> Nom d'utilisateur </div>
    <div class="second"> Créé le </div>
    <div class="third"> On/off ?</div>
    <div class="fourth"> Groupe </div>
  </div>



<?php 
  while($resultat = $search->fetch()) {
        $ids = $resultat['id'];
  echo '<form method="POST" action="">
        <input type="hidden" name="id'.$ids.'" value="'.$ids.'" />
          <div>
            <div class="user-content">
              <div class="name-user first">';
                echo $resultat ['nom'];
        echo '</div>
                <div class="second lato">';
                  echo $resultat ['format_euro'];
          echo '</div>
                <div class="third lato">
                  <div class="checkbox-power">
                    <input type="hidden" name="update_oo'.$ids.'" value="0" >
                    <input name="update_oo'.$ids.'" value="1" id="'.$ids.'"';
                    if($resultat["onoff"] == 1){
                      echo " checked "; } echo 'type="checkbox">
                    <label for="'.$ids.'"></label>
                  </div>
                </div>
                <div class="fourth lato">
                  <div class="active">
                    <select name="update_grp'.$ids.'" class="grp_user">
                      <option value="/" ';
                          if($resultat["groupe"] == '/'){
                              echo " selected='selected' ";
                          }
                echo '>/</option>
                      <option value="sti2d" ';
                          if($resultat["groupe"] == 'sti2d'){
                              echo " selected='selected' ";
                          }
                echo '>sti2d</option>
                      <option value="electrotech" ';
                          if($resultat["groupe"] == 'electrotech'){
                              echo " selected='selected' ";
                          }
                echo '>electrotech</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>';
                
   if(isset($_POST['update'])) {
                    
   $id_up = $_POST['id'.$ids.''];
   $grp_u = $_POST['update_grp'.$ids.''];
   $oo_u =  $_POST['update_oo'.$ids.''];
                    
   $update_req = $bdd->prepare("UPDATE membres SET groupe='$grp_u', onoff='$oo_u' WHERE id='$id_up'");
   $update_req->execute();
   echo "<meta http-equiv='refresh' content='0'>";
                    
                    
   }
  }




 echo'<div class="save-rights">
        <div>
          <button href="'.$_SERVER["REQUEST_URI"].'" class="btn save-button" type="submit" name="update"> Enregistrer </button>
        </div>
      </div>';
 

 echo'</form>';
 
 ?>    
     
    </div>
   </div>  
  </div>   
 </body>
</html>