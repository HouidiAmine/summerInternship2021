
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="src/css/msg.css" />
</head>
<body>
<div class="menu">
<a href="index2.php"><div class="back"><i class="fa fa-chevron-left"></i> <img src="src/image/notice.png" draggable="false"/></div></a>
    <div class="name">Notifs</div>
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
    
    foreach($dbh->query(" SELECT * from notifs order by  date desc,time desc  ") as $row) {
       $note=str_replace('"',"'",$row['notif']);
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
<form action="afficherNotif1.php" method="post" >
<input class="textarea" type="text"  name="nouvellenotif" id="nouvellenotif" placeholder="Type here!"/><div class="emojis"></div>
</form>
</div>
</body>
</html>