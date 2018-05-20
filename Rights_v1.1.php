    <html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width"/>
    <title>Supervision du panneau</title>
    <link rel="stylesheet" media="screen" type="text/css" href=".\Style.css" /> 
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
   <form>
     <div id="search_user" class="search-user">
       <input class="">
       <a id="search_button" class="btn search-button">Search</a>
     </div>
     <div>
       <div>
         <select id="search_grp">
           <option value="0">[Pas de sélection]</option>
           <option value="1">sti2d</option>
           <option value="2">electrotech</option>
           <option value="3">/</option>
         </select>
       </div>
       <div>
         <select name="date" id="search_month">
           <option value="2018.05">Mai 2018</option>
           <option value="2018.04">Avr 2018</option>
           <option value="2018.03">Mar 2018</option>
           <option value="2018.02">Fev 2018</option>
           <option value="2018.01">Jan 2018</option>
           <option value="2017.12">Dec 2017</option>
           <option value="2017.11">Nov 2017</option>
         </select>
       </div>
     </div>
   </form>
 </div>
 <div class="content-table menu-table">
   <div class="table-header">
     <div class="first"> Nom d'utilisateur </div>
     <div class="second"> Créé le </div>
     <div class="third"> On/off ?</div>
     <div class="fourth"> Groupe </div>
   </div>
   
   
<?php 
$requete = $bdd->query("SELECT id, nom, DATE_FORMAT(DateDinscript, '%d/%m/%Y') as format_euro, onoff FROM membres ORDER BY DateDinscript DESC");
  while($resultat = $requete->fetch()) {
    echo '<div>
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
                    <label for="'; echo $resultat ['id']; echo '"></label>
                  </div>
                </div>
                <div class="fourth lato">
                  <div class="active">
                    <select id="grp_user">
                      <option value="0">/</option>
                      <option value="1">sti2d</option>
                      <option value="2">electrotech</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>';}
?>
 <div class="save-rights">
   <div>
     <button class="btn save-button"  name=""> Enregistrer </button>
   </div>
 </div>
</div>  
</div>  
</div>   
</body>
     </html>