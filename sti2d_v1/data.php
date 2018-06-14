<?Php

$dbhost = 'localhost';
$dbname = 'espace_membres';
$dbuser = 'root';
$dbpass = 'admin';
$port = '3304';


try{
    
    $dbcon = new PDO("mysql:host={$dbhost};dbname={$dbname};port={$port}",$dbuser,$dbpass);
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $ex){
    
    die($ex->getMessage());
}


$stmt=$dbcon->prepare("SELECT * FROM energie_minutes_2heures");
$stmt->execute();
$json = [];
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $json[]= [(string)$Date, (float)$Valeurs];
}
echo json_encode($json);

?>