
 <!DOCTYPE html>
<html>
   <head>
       <meta charset="utf-8">

       <title>mon projet </title>
       <style>

.zoom:hover {
  transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
       <link rel="stylesheet" href="src/css/main.css">
       <!--font-->
       <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;700&display=swap" rel="stylesheet">
        <!--font-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script> 

$(document).ready(function(){

  $('.zoom').mouseover(function(){
      
    $(".msgg").show();
  });
  $('.zoom').mouseout(function(){
      
      $(".msgg").hide();
    });
    
});





</script>
      <script  type="text/javascript" src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
      <script  type="text/javascript" src="src/js/main.js"></script>
  
      <meta name="description" content="Description de ma site">
      <meta name="keyword" content="Description de ma site">
      <meta name="viewport" content="width=device-width,user-scalable=no ,initial-scale=1">
<style>

</style>
    </head>
 <body>
      <div class="block">
            <header class="header">
                <a href="#" class="header-logo">Portail Interne Des Ciments de Bizerte </a> 
                <nav class="header-menu"  class="zoomm">
                    <a href="profile.php" ><img src="src/image/home.png"  class="zoom"></a>     
                    <a href="afficherNotif.php" id="bell" ><img src="src/image/bell.png"  class="zoom" >  
               
                      <span class="text" style="color:red"   >  
                        <?php $user="root";
                          $pass="";
                            $t=0;
try {   
    $dbh = new PDO('mysql:host=localhost;dbname=mon_site', $user, $pass);
    
    foreach($dbh->query(" SELECT Count(*) as nbre from notifs where date in (select max(date) from notifs)  ") as $row) {

      echo $row['nbre'];
     }
     $dbh = null;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
      ?></span>   </a>              
                    <a href="afficherMsg.php" id="chat"><img src="src/image/chat.png" class="zoom" ></a>  
                    <a href="modif.php" id="gear">   <img src="src/image/gear.png" class="zoom"></>
                     <a href="Deconnexion.php" id="exit" >  <img src="src/image/exit.png" class="zoom"></a>
                     <a href="demande.php" id="idea" > <img src="src/image/business-idea.png" class="zoom"></a>
                     <a href="voirdemande.php" id="search" > <img src="src/image/search.png" class="zoom"></a>
                     <a href="suivre.php" id="follow" ><img src="src/image/follow.png" class="zoom"></a>

                     <a href="#" ><img src="src/image/user.png"> <?php 
             session_start();
             echo '                                ';
             echo $_SESSION['user'];?> </a><li>
                      
                </nav>
            </header>
</div>





<div class="block">
      <div class="banner" id="gg">
             <img src="src/image/interface.jpg"  alt=" LES CIMENTS DE BIZERTE"  class="banner-image">
             <div class="banner-content">
                 <h1 class="title is-1" id="bienvenu" > 
      </div>
</div>
<div class="footer-informations" align="center">
<p>L’Usine de Production sis Baie de Sabra à 3km Sud-ouest de la ville de Bizerte, </p>
<p>délégation Bizerte Sud, sur la route de la pêcherie.</p>

</div>
</footer></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="src/js/main.js"></script>
   
 </body>
</html>
    
       
