
<!------ Include the above in your HEAD tag ---------->
<?php 
session_start();

    //connexion à la base de données
    include_once 'ConnexionBD.php'; 
    
    if(isset($_POST['formconnect']))
    {   
        //on recupere le mail qui est saisi sur le champs
        $mailconnect = htmlspecialchars($_POST['mailconnect']);
        //je recupere le mdp tout en hasha
        $mdpconnect = $_POST['mdpconnect'];
        $admin='admin';

        if(!empty($mailconnect) AND !empty($mdpconnect))
        {   
            if(filter_var($mailconnect, FILTER_VALIDATE_EMAIL)){
                $_SESSION['mail']=$_POST['mailconnect'];

                $requeteUser= $bdd->prepare("SELECT * FROM membres WHERE mail=?");
                $requeteUser ->execute(array($mailconnect));
                //on va compter le nombre de ranger qui existent avec les info 
                //que vient de rentre l'utilisateur
                $userexist = $requeteUser ->rowCount();
                
                if($userexist == 1){
                    $userInfo = $requeteUser->fetch();
                    //if(password_verify( $mdpconnect,$userInfo->motdepasse)){
                         // nous peermet  de rediriger vers la profil de la personne ou de l'admin 
                   
                        if ($mdpconnect == md5($admin))
                        {
                            $_SESSION['auth'] = $userinfo;
                            header("location:/YAKHAR/Admin/Admin2.php"); 
                        }
                        if($mdpconnect != md5($admin))
                        {
                            $_SESSION['auth'] = $userinfo; 
                            header("location:profil.php");  
                            // echo("vous etes connecté bravo !! ");
                            
                        }
                       
                       
                      
                   // } 


                }
                else{
                    $erreur = "Mauvais mail ou mot de passe !";
                }
            }
            else{
                $erreur= "Votre adresse mail n'est pas valide";
            }

        }
        else {
            $erreur = "Tous les champs doivent etre complétés";
        }
    }


   
?>



<html>
<head>
    <meta charset="utf-8">
    <title>Page connextion PHP</title>
    <!-- CSS -->
  
    <link rel="stylesheet"  href="CSS/style_connexion.css">
   
    <!--Framwork-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
</head>
<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info"><b>Connexion</b></h3>
                            <div class="form-group">
                                <label for="mailconnect" class="text-info"><b>Email:</b></label><br>
                                <input type="text" name="mailconnect" id="mailconnect" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="mdpconnect" class="text-info"><b>Mot de passe:</b></label><br>
                                <input type="password" name="mdpconnect" id="mdpconnect" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="formconnect" class="btn btn-info btn-lg"  value="Se connecter">
                            </div>
                            <div> <?php   if(isset($erreur)){
                                                echo '<font color="red " size="4px" >'.'<b>'.'<h4 style="text-align: center;">'.$erreur.'</h4>'.'</b>'.'</font>'; }?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
