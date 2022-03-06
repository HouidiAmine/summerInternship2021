<?php 
$nom= $_POST["nom"];
$prenom= $_POST["prenom"];
$mdp= $_POST["mdp"];
$mdp2= $_POST["mdp2"];
$email= $_POST["email"];
$tel= $_POST["tel"];

$identique=0;
if($mdp==$mdp2)
    {$identique=1;
      if(strlen(str($tel))==8)
         verif_tel==1;
            if (isset($nom) && isset($prenom)&& isset($mdp)&& isset($mdp2)&& isset($email) && isset($tel))
         {
            

$user="root";
$pass="";
$t=0;
try {   
    $dbh = new PDO('mysql:host=localhost;dbname=produit', $user, $pass);
    
 $dbh->query("Insert into produit.Client values ('$nom','$prenom','$email','$tel',$mdp)") ;   
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>
<!DOCTYPE html>
<html>
   <head>
       <meta charset="utf -8">
       <title>mon projet </title>
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
       <link rel="stylesheet" href="src/css/main.css">
       <!--font-->
       <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;700&display=swap" rel="stylesheet">
        <!--font-->

      <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
      <meta name="description" content="Description de ma site">
      <meta name="keyword" content="Description de ma site">
      <meta name="viewport" content="width=device-width,user-scalable=no ,initial-scale=1">

    </head>
 <body>
        <form action="inscription.php" method="post">
          <div class="field">
            <label class="label">Nom</label>
            <div class="control">
              <input class="input" type="text" placeholder="Ton Nom"name="nom">
            </div>
          </div>     
          <div class="field">
            <label class="label">Prénom</label>
            <div class="control has-icons-left has-icons-right">
              <input class="input is-success" type="text" placeholder="Ton Prénom" value="xxxxx" id="prenom"name="prenom">
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
              <span class="icon is-small is-right">
                <i class="fas fa-check"></i>
              </span>
            </div>
          </div>         
          <div class="field">
            <label class="label" >Email</label>
            <div class="control has-icons-left has-icons-right">
              <input class="input is-danger" type="email" placeholder="Email" value="xxxxxxxxx@" name="email" id="email">
              <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
              </span>
              <span class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
              </span>
            </div>       
          </div>
          <div class="field">
            <label class="label">mot de passe</label>
            <div class="control">
              <input class="input" type="text" placeholder="votre mot de passe" name="mdp" id="mdp">
            </div>
          </div>
          <div class="field">
            <label class="label">récrire votre mot de passe</label>
            <div class="control">
              <input class="input" type="text" placeholder="votre mot de passe" name="mdp2" id="mdp2">
            </div>
          </div>
        <h2> <?php if($identique==0)echo "mots de passe ne sont pas identiques " ;?> </h2>   
      <footer class="modal-card-foot">
        <button class="button is-link" >Inscription</button>
        <button class="button" id="close-modal">Cancel</button>
      </footer>
       </form>
</body>
</html>