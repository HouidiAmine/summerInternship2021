<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />
    <?php session_start();
$user="root";
$pass="";
$userr=$_SESSION['user'];
$Json = file_get_contents("structure.json");
// Converts to an array 
$structure = json_decode($Json, true);
//var_dump($structure); // prints array
$m=1; //le user different de racine

if($userr==$structure["racine"])
{$supervisor="accepted";
 $m=0;
 
}
if(isset($_POST['accepted']) )
   {
       $accept= $_POST['accepted'];
       $num=substr($accept, 0, -1);
    $valeur=substr($accept, -1);
    $dbh = new PDO('mysql:host=localhost;dbname=mon_site', $user, $pass);
if($valeur=="1"){
   
    if($m==1)
    foreach ($structure["supervisors"] as $elt)
    { 
       if( in_array($userr,$structure["$elt"])){$supervisor=$elt; break;}
      
    }

    try {   
     $dbh->query("UPDATE demandeconge SET derniereaccepter ='$supervisor' WHERE numero='$num'") ;
       echo "<h1 class='container' style='color:green'> <div class='container'>merci d'avoir accepter la demande </div></h1>";
        $dbh = null;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
else{ 
    try {   
        $ch='refuse par '.$userr;
        $dbh->query("UPDATE demandeconge SET derniereaccepter ='$ch' WHERE numero='$num'") ;
        echo "<h1 class='container' style='color:green'> <div class='container'>vous avez refusé cette  demande </div></h1>";
      
       $dbh = null;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

}
     
   }

?>
    <style>
        div.container {
    min-height: 10em;
    display: table-cell;
    vertical-align: middle }
</style>
<?php



$date=date("Y-m-d");
$time= date("h:i:sa");
?>

<link rel="stylesheet" href="src/css/msg.css" />
</head>
<body>
<div class="menu">
<a href="index2.php"><div class="back"><i class="fa fa-chevron-left"></i> <img src="src/image/search.png" draggable="false"/></div></a>
    <div class="name">Demandes de Congé</div>
    <div class="last"><?php echo  date("h:i:sa"); ?></div>
</div>
<div align="center">

<ol class="chat" >
<?php
$user="root";
$pass="";
$t=0;

try {   
    $dbh = new PDO('mysql:host=localhost;dbname=mon_site', $user, $pass);
    $sous=Array();
    $t=0;//VOUS AVEZ DES SOUS AND VOUS N'AVEZ pas de   DEMANDES 
    if(!empty($structure["$userr"])) 
           {
             
                   $requete="SELECT * from demandeconge,authentification where   demandeconge.numeroEnchainement=authentification.numeroEnchainement  and  derniereaccepter='$userr' and derniereaccepter not like 'refus%' ";
                
                   $array=$dbh->query($requete);
                   if(count ($array)==0) {
                                   
                                    break;
                                         }
                                         
                   foreach($array as $row) { 
                       $t=1;
                        echo '<li class="other">';
                        echo '<div class="msg">
                        <p><b>',$row['user'],' a deposé une demande de congé à partir  de  </b>',$row['datedebut'],'  à  ',$row['datefin'],' 
                       <form method="post" action="voirdemande.php"> <button type="submit" name="accepted"  value=',$row['numero'] ,'1><i class="avatar"><img src="src/image/CHECK.png"></i></button>
                       <button type="submit" name="accepted" value=',$row['numero'] ,'0 ><i class="avatar"><img src="src/image/checked.png" ></i></button>
                        </p>  <time>',$row['time'],'<br>',$row['date'],'</time>
                        </div>
                        </li>';   

    }}
   if( $t==0) echo "<h1 class='container' style='color:green'> <div class='container'>vous n'avez pas des demandes de congé à approuver pour le moment</div></h1>";
    
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>
</ol>
</div>
</body>
</html>