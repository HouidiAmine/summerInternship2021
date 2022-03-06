
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

<style>
  body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    
  }
  body:before {
    content: '';
    position: fixed;
    width: 100vw;
    height: 100vh;
    background-image: url("src/image/general/back.jpeg");
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    -webkit-background-size: cover;
    background-size: cover;
    -webkit-filter: blur(10px);
    -moz-filter: blur(10px);
    filter: blur(10px);
  }
  .contact-form {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    height: 350px;
    padding: 80px 40px;
    background: rgba(0, 0, 0, 0.5);
  }
  .avatar {
    position: absolute;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    top: calc(-80px/2);
    left: 140px;
  }
  .contact-form h2 {
    margin: 0;
    padding: 0 0 20px;
    color: #fff;
    text-align: center;
    text-transform: uppercase;
  }
  .contact-form p {
    margin: 0;
    padding: 0;
    font-weight: bold;
    color: #fff;
  }
  .contact-form input {
    width: 100%;
    margin-bottom: 20px;
  }
  .contact-form input[type=email], .contact-form input[type=password] {
    border: none;
    border-bottom: 1px solid #fff;
    background: transparent;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 16px;
  }
  .contact-form input[type=submit] {
    height: 30px;
    color: #fff;
    font-size: 15px;
    background: red;
    cursor: pointer;
    border-radius: 25px;
    border: none;
    outline: none;
    margin-top: 15%;
  }
  .contact-form a {
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    text-decoration: none;
  }
  input[type=checkbox] {
    width: 20%;
  }
  

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>



<form action="modif.php" method="post">
    <div class="contact-form">
   
    <img class="avatar" src="src\image\gear.png" alt="lock">
  


    <label for="mdp"><b>Ancien mot de passe</b></label>
    <input type="password" placeholder="mot de passe" name="mdp" id="mdp" required>
    <label for="mdp1"><b>nouveau mot de passe</b></label>
    <input type="password" placeholder="mot de passe" name="mdp1" id="mdp1" required>
    <label for="mdp2"><b> Réecrivez votre nouveau mot de passe</b></label>
    <input type="password" placeholder="mot de passe" name="mdp2" id="mdp2" required>
    <?php 
    session_start();
      if (isset($_POST["mdp"]) &&  (isset($_POST["mdp1"])) &&  (isset($_POST["mdp2"]))){
        
        $user="root";
        $pass="";
        $userr=$_SESSION["user"];
        $mdp=$_POST['mdp'];
        $mdp1=$_POST['mdp1'];
        $mdp2=$_POST['mdp2'];
        $t=0;	
        
        try {   
            $dbh = new PDO('mysql:host=localhost;dbname=mon_site', $user, $pass);
            
            foreach($dbh->query(" SELECT * from authentification  where user='$userr' ") as $row) {
               if( $row['mdp']==$mdp)
                   {$t=1;
                  }
        
              
            }
            $identique=0;
        if($mdp1==$mdp2)
            $identique=1;
            $dbh = null;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }}
        ?>
          
          <h1><?php if (isset($_POST["mdp"]) &&  (isset($_POST["mdp1"])) &&  (isset($_POST["mdp2"]))){
      
      if ($t==0 )
       echo "<h1 style='color:red'>verifier votre ancien mot de passe</h1>";
       else  if ($identique==0) echo "<h1 style='color:red'>verifier les deux nouvelles mots de passe ne sont pas identiques </h1>";
       else  
     

try {   
    $dbh = new PDO('mysql:host=localhost;dbname=mon_site', $user, $pass);
    
 $dbh->query("UPDATE authentification
 SET mdp = '$mdp1'
 WHERE user='$userr'") ;
    echo "<h1 style='color:green'>mot de passe modifié avec succés</h1>";
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}}?> </h1>
      
    <button type="submit">valider</button>
    <a href="index2.php"><button type="button" class="cancelbtn">Cancel</button></a>
  </div>

  
</form>

</body>

</html>
