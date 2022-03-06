<?php  session_start();
     $userr=$_SESSION['user'];
   
     $Json = file_get_contents("structure.json");
     // Converts to an array 
     $structure = json_decode($Json, true);
      $user="root";
      $pass="";
      
      try {   
            $dbh = new PDO('mysql:host=localhost;dbname=mon_site', $user, $pass);
            foreach($dbh->query(" SELECT * from authentification  where user='$userr' ") as $row) {
            $nu= $row['numeroEnchainement'];
                  }
                  
                  $dbh = null;
                } catch (PDOException $e) {
                    print "Erreur !: " . $e->getMessage() . "<br/>";
                    die();
                }  ?>
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
                height: 500px;
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
<body> <div class="contact-form">
<form action="demande.php" method="post">
    
     <img class="avatar" src="src\image\business-idea.png" alt="lock">
     <h2>Demande Congé</h2>
     <label for="num"><b>numero d'enchainement</b></label>
    
     <input type="number" placeholder="numero d'enchainement" name="num" id="num"   value= <?php echo $nu;?>  readonly="readonly" >
    <label for="datedeb"><b>Date de debut</b></label>
    <input type="date" data-date-format="DD MMMM YYYY" placeholder="sous la forme jj-mois-année" name="datedeb" id="datedeb" required>
    <label for="datefin"><b>date de fin</b></label>
    <input type="date" data-date-format="DD MMMM YYYY" placeholder="sous la forme jj-mois-année" name="datefin" id="datefin" required>
  
<!--possibilité d'etre demandé durant ces jours-->
    <?php 

    $k=0;
      if (isset($_POST["datedeb"]) &&  (isset($_POST["datefin"]))  ){
        $date=date("Y-m-d");
        $time= date("h:i:sa");
        $datedeb=$_POST['datedeb'];
        $datefin=$_POST['datefin'];
        $h=1;
        try {     
        $m=1;
            if($datefin<=$datedeb) $h=0; 
            if($h==1){
            $dbh = new PDO('mysql:host=localhost;dbname=mon_site', $user, $pass);
            if($userr==$structure["racine"])
              {$supervisor="accepted";
                $m=0;
 
                 }

     

   
    if($m==1)
    foreach ($structure["supervisors"] as $elt)
    { 
       if( in_array($userr,$structure["$elt"])){$supervisor=$elt; break;}
      
    }
 
         $dbh->query("Insert into demandeconge  (NumeroEnchainement,datedebut,datefin,time,date,derniereaccepter)values('$nu','$datedeb','$datefin','$time','$date','$supervisor');") ;
         $k=1;
        }} catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }}
        ?>         
          <h1><?php if (isset($_POST["datedeb"]) &&  (isset($_POST["datefin"]))  ){
      
     if ($h==0) echo "<h1 style='color:red'>la date de fin est antérieure à la date de debut </h1>";
       else  if($k==1)
       echo "<h1 style='color:green'>votre demande a été enregistrée avec succés </h1>";}
     

?> </h1>
 <button type="submit">valider</button>
<a href="index2.php"><button type="button" class="cancelbtn"> Cancel </button></a>
</div>
</form>
</body>
</html>
