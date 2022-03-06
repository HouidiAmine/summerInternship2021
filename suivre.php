<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />


    <?php



$date=date("Y-m-d");
$time= date("h:i:sa");
?>

<link rel="stylesheet" href="src/css/msg.css" />
</head>
<body>
<div class="menu">
<a href="index2.php"><div class="back"><i class="fa fa-chevron-left"></i> <img src="src/image/follow.png" draggable="false"/></div></a>
    <div class="name">Suivre Vos Demandes de Congé</div>
    <div class="last"><?php echo  date("h:i:sa"); ?></div>
</div>
<div align="center">

<ol class="chat" >


<?php
session_start();
$user="root";
$pass="";
$userr=$_SESSION['user'];
$Json = file_get_contents("structure.json");
// Converts to an array 
$structure = json_decode($Json, true);
//var_dump($structure); // prints array
try {   
    $dbh = new PDO('mysql:host=localhost;dbname=mon_site', $user, $pass);
   

$Json = file_get_contents("structure.json");
// Converts to an array 
$structure = json_decode($Json, true);
$m=1; //le user different de racine
if($userr==$structure["racine"])
{$supervisor="accepted";
 $m=0;
 
}

                   $requete="SELECT count(*) as nbre from demandeconge,authentification where   demandeconge.numeroEnchainement=authentification.numeroEnchainement  and   user='$userr';";
                   $array=$dbh->query($requete);
                   foreach($array as $row) 
                   {
                       if($row['nbre']==0){
                             echo "<h1 class='container' style='color:green'> <div class='container'>vous n'avez pas disposé des demandes</div></h1>";
                       }
                   else{
  
                   $requete="SELECT * from demandeconge,authentification where   demandeconge.numeroEnchainement=authentification.numeroEnchainement  and   user='$userr';";
                   $array=$dbh->query($requete);
                   foreach ($structure["supervisors"] as $elt)
                   { 
                      if( in_array($userr,$structure["$elt"])){$supervisor=$elt; break;}
                     
                   }     
                   foreach($array as $row) { 
                    if ($row['derniereaccepter']==$supervisor) { echo '<li class="other"><div class="msg">   <p><b> votre demande qui a été déposée à partir  de  </b>',$row['datedebut'],'  à  ',$row['datefin'],' 
                        est en cours 
                        </p>  <time>',$row['time'],'<br>',$row['date'],'</time>
                        </div>
                        </li>';  } 

                      else {
                        if ($row['derniereaccepter']=='accepted') { echo '<li class="other"><div class="msg">   <p><b> votre demande qui a été déposée à partir  de  </b>',$row['datedebut'],'  à  ',$row['datefin'],' 
                        est acceptée 
                        </p>  <time>',$row['time'],'<br>',$row['date'],'</time>
                        </div>
                        </li>';  }
                     else if(strpos($row['derniereaccepter'], 'refus') !== false){

                        echo '<li class="other"><div class="msg">votre demande qui a été déposée à partir  de  </b>',$row['datedebut'],'  à  ',$row['datefin'],"
                       est ", $row["derniereaccepter"],
                            '</p>  <time>',$row['time'],'<br>',$row['date'],'</time>
                          </div>
                          </li>';  

                     }
                        else  echo '<li class="other"><div class="msg">votre demande qui a été déposée à partir  de  </b>',$row['datedebut'],'  à  ',$row['datefin'],"
                      attend  l'",'acceptation de ', $row["derniereaccepter"],
                          '</p>  <time>',$row['time'],'<br>',$row['date'],'</time>
                        </div>
                        </li>';   

    }}  }}
  
    
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>