<?php
$user="root";
$pass="";
session_start();
$userr=$_SESSION['user'];
$notif=$_POST['nouvellenotif'];
$date=date("Y-m-d");
$time= date("h:i:sa");


$t=0;

try {    
      
     
    $dbh = new PDO('mysql:host=localhost;dbname=mon_site', $user, $pass);
     
        foreach($dbh->query("SELECT user from authentification ") as $row) {
       if( $row['user']==$userr)
           {$t=1;
			
          break;        
		     

          }
      
    }
 
	if($t==1)
    {$note=str_replace("'",'"',$notif);
            
      $dbh->query("Insert into msgs values ('$userr','$date','$time','$note') ");}
    
    $dbh = null;}
 catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="src/css/msg.css" />
</head>
<body>
<div class="menu">
<a href="index2.php"><div class="back"><i class="fa fa-chevron-left"></i> <img src="src/image/MESSAGERIE.jpeg" draggable="false"/></div></a>
    <div class="name">Messagerie</div>
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
    
    foreach($dbh->query(" SELECT * from msgs order by  date desc,time desc  ") as $row) {
        $note=str_replace('"',"'",$row['msg']);
       echo '<li class="other">
       <div class="avatar"> <img src="src/image/general/lock.png"></div>';
       echo '<div class="msg">
       <p><b>',$row["pseudo"],'</b></p>  <p>',$note,'</p>
       <time>',$row["time"],'<br>',$row['date'],'</time>
       </div>
       </li>';
        
      
      
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>

</ol>
<form action="afficherMsg1.php" method="post" >
<input class="textarea" type="text"  name="nouvellenotif" id="nouvellenotif" placeholder="Type here!"/><div class="emojis"></div>
</form>
</div>
</body>
</html>