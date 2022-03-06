
<?php
session_start();
		
$user="root";
$pass="";
$userr=$_POST['uname'];
$mdp=$_POST['psw'];
$cin=$_POST['cin'];
$t=0;	
$us=htmlentities(trim($_GET['user']));
try {   
    $dbh = new PDO('mysql:host=localhost;dbname=mon_site', $user, $pass);
    
    foreach($dbh->query(" SELECT user from authentification  where mdp='$mdp' and cin='$cin' ") as $row) {
       if( $row['user']==$userr)
           {$t=1;
			$_SESSION['user']=$_POST['uname'];
            header('Location: index2.php?');
			
          
          }
      
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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



<form action="action_page.php" method="post">
 

  <div class="contact-form">
  <img class="avatar" src="src\image\general\lock.png" alt="lock">
  <h2>Login Form</h2>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" id="uname" required>
    <label for="cin"><b>CIN</b></label>
    <input type="text" placeholder="Enter Cin" name="cin" id="cin" required>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
    
    <button type="submit">Login</button>
    <button type="button" class="cancelbtn">Cancel</button>
  <h2 style="color:rgb(255,0,40);"><?php if($t==0)
       echo "Informations incorrects";
    
    ?>   </h2>
  </div>

  
</form>

</body>

</html>
