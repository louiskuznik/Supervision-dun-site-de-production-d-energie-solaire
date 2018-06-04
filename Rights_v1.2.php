    <html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Supervision du panneau</title>
    <link rel="stylesheet" media="screen" type="text/css" href=".\Style_v3.2.css" /> 
</head>

<body> 

 <div class="Bground_grid">
  <div class="Bground_center">
  </div>
 </div>
 
<?php 

$user = 'root';
$pass = 'admin';

$bdd = new PDO('mysql:host=localhost;port=3304;dbname=espace_membres;charset=utf8', $user, $pass);
   
?>
 
 
  <div class="border border_r">
<div class="back_r">

 <div class="page_title">Gestion des droits
 </div>
 <div class="search_menu">
   <form method="GET">
   
     <?php
      $search = $bdd->query('SELECT id, nom, DATE_FORMAT(datedinscript, "%d/%m/%Y") as format_euro, onoff, groupe FROM membres ORDER BY datedinscript DESC');
      if(isset($_GET['q'])) {
         $q = htmlspecialchars($_GET['q']);
         $grp = htmlspecialchars($_GET['grp']);
         $date = htmlspecialchars($_GET['date']);
         $search = $bdd->query('SELECT id, nom, DATE_FORMAT(datedinscript, "%d/%m/%Y") as format_euro, onoff, groupe FROM membres WHERE nom LIKE "%'.$q.'%" AND groupe LIKE "%'.$grp.'%" AND datedinscript LIKE "%'.$date.'%" ORDER BY datedinscript DESC');
       }
     ?>
     
     <div class="search-user">
       <input placeholder="Rechercher un nom" type="search" name="q" />
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
       
       <div>
         <select name="date" id="search_month">
           <option value="">[Pas de sélection]</option>
           <option value="2018-06">Juin 2018</option>
           <option value="2018-05">Mai 2018</option>
           <option value="2018-04">Avril 2018</option>
           <option value="2018-03">Mars 2018</option>
           <option value="2018-02">Fevrier 2018</option>
           <option value="2018-01">Janvier 2018</option>
           <option value="2017-12">Decembre 2017</option>
           <option value="2017-11">Novembre 2017</option>
         </select>
       </div>
       
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
 <div class="content-table menu-table">
   <div class="table-header">
     <div class="first"> Nom d'utilisateur </div>
     <div class="second"> Créé le </div>
     <div class="third"> On/off ?</div>
     <div class="fourth"> Groupe </div>
   </div>

<?php 
  while($resultat = $search->fetch()) {
  echo '<form method="post">
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
                    <input id="';
                  echo $resultat ['id']; echo '"';
                    if($resultat["onoff"] == 1){
                      echo " checked "; } echo 'type="checkbox">
                    <label for="';echo  $resultat ['id']; echo '"></label>
                  </div>
                </div>
                <div class="fourth lato">
                  <div class="active">
                    <select id="grp_user">
                      <option ';
                          if($resultat["groupe"] == '/'){
                              echo " selected='selected' ";
                          }
                echo '>/</option>
                      <option ';
                          if($resultat["groupe"] == 'sti2d'){
                              echo " selected='selected' ";
                          }
                echo '>sti2d</option>
                      <option ';
                          if($resultat["groupe"] == 'electrotech'){
                              echo " selected='selected' ";
                          }
                echo '>electrotech</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>';}
?>
<?php
if(isset($_POST["update"]))
{

	 $groupe=$resultat["groupe"];
	 $id=$resultat["id"];
	 $req = $bdd->query("UPDATE membres SET groupe='$groupe' where id='$id'");
}
?>

 <div class="save-rights">
   <div>
     <button class="btn save-button"  type="submit" value="update" name="update"> Enregistrer </button>
   </div>
 </div>
</form>
</div>  
</div>  
</div>   
</body>
     </html>