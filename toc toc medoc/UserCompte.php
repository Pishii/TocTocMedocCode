
<?php
session_start();
 
include_once 'ConnexionBD.php';
 
if(isset($_SESSION['mail'])) {
   $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
   $requser->execute(array($_SESSION['mail']));
   $user = $requser->fetch();
   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
      $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE mail = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['mail']));
      header('Location: Deconnexion.php?mail='.$_SESSION['mail']);
   }
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE mail = ?");
      $insertmail->execute(array($newmail, $_SESSION['mail']));
      header('Location: Deconnexion.php?id='.$_SESSION['mail']);
   }
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE mail = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['mail']));
         header('Location: Deconnexion.php?id='.$_SESSION['mail']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
	  <link href="CSS/style_modif_user_compte.css" rel="stylesheet"/>
      <link rel="stylesheet" href="CSS/vendors/bootstrap.min.css">
      <link rel="stylesheet" href="CSS/vendors/font-awesome.min.css">
     
      <style>
        /*footrt*/
        footer{
            background-color: black;
            color:white;
            text-decoration: none;
        }

        .foot a{
            text-decoration: none;
            color:white;
        }

        .foot a:hover{
            text-decoration: none;
            color:green;
        }
        
        .foot h6{
            color: green;
        }
    </style>
	  
	 
   </head>
   <body>
     
        <ul>
            
			<li class="trait"><a href="#">Mon Traitement</a>
                <ul>
                    <li><a href="Traitement2.php">Nouveau traitement</a></li>
                    <li><a href="Traitement2.php">Tous mes traitements</a></li>
                    
                </ul>
            </li>
            <li class="rdv"><a href="#">Mes Rendez-Vous</a>
                 <ul>
                    <li><a href="Rendez-Vous.php">Nouveau rendez-vous</a></li>
                    <li><a href="Rendez-Vous.php">Tous mes rendez-vous</a></li>
                </ul>
            </li>
         
            <li><a href="UserCompte.php">Mon profil</a></li>
            <li><a href="chatbot.php">Mon tchatbot</a></li>
            <li class="list"><a href="YAKHAR/main_menu.php">Trouver un remède</a></li>
            <li><a class="active" href="profil.php">Accueil</a></li>
			<li><a href="Deconnexion.php">Déconnexion</a></li>
        </ul>	

	  <div id="login">
	  
           <!--<h3 class="text-center text-white pt-5"></h3>-->
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="" method="post" enctype="multipart/form-data">
                                <h3 class="text-center text-info"><b>Edition de mon profil</b></h3>
                                <div class="form-group">
                                    <label  class="text-info " id="label1"><b>Pseudo:</b></label><br>
                                    <input type="text" name="newpseudo" class="form-control" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" >
                                </div>
                                <div class="form-group">
                                    <label class="text-info " id="label2"><b> Email:</b></label><br>
                                    <input type="text" name="newmail" class="form-control" placeholder="Mail" value="<?php echo $user['mail']; ?>">
                                </div>
                                <div class="form-group">
                                    <label  class="text-info " id="label"><b> Mot de passe </b></label><br>
                                    <input type="password" name="newmdp1" class="form-control" placeholder="Mot de passe">
                                </div>
                                <div class="form-group">
                                    <label for="date_fin" class="text-info " id="label"><b> Confirmation mot de passe </b></label><br>
                                    <input type="password" name="newmdp2"  class="form-control" placeholder="Confirmation du mot de passe">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-info btn-lg"  value="Mettre à jour mon profil !" >
                                </div>
                               
                                <div> <?php   if(isset($msg)){
													echo '<font color="red " size="4px" >'.'<b>'.'<h4 style="text-align: center;">'.$msg.'</h4>'.'</b>'.'</font>'; }?>
													 
                                </div> 
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            
		<br/><br/><br/><br/><br/>

        <!-- Footer -->
        <footer class="page-footer font-small foot">

            <div align="center" style="width:400px; height:1px; background-color:black; font-size:0;"></div>

            <!-- Footer Links -->
            <div class="container text-center text-md-left mt-5">

            <!-- Grid row -->
            <div class="row mt-3">

                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

                    <!-- Content -->
                    <h6 class="text-uppercase font-weight-bold">Toc Toc Médoc</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p> Toc Toc Médoc, l'application qui vous accompagne, enregistre et vous rappelle tous vos traitements et rendez-vous médicaux !</p>

                    </div>
                    <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

                    <!-- Links -->
                    <h6 class="text-uppercase font-weight-bold">Mon compte</h6>
                    <hr  style="width: 90px; color:red;">
                    <p>
                        <a href="Traitement_historique.php" style=" text-decoration: none;">Tous mes traitements</a>
                    </p>
                    <p>
                        <a href="Traitement2.php" style=" text-decoration: none;">Nouveau traitement</a>
                    </p>
                    <p>
                        <a href="Rendez-vous_historique.php" style=" text-decoration: none;">Tous mes rendez-vous</a>
                    </p>
                    <p>
                        <a href="Rendez-Vous.php" style=" text-decoration: none;">Nouveau rendez-vous</a>
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    
                    <!-- Links -->
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p style="margin-top:29px;">
                        <a href="UserCompte.php" style=" text-decoration: none;">Mon profil</a>
                    </p>
                    <p>
                        <a href="chatbot.php" style=" text-decoration: none;">Mon tchatbot</a>
                    </p>
                    <p>
                        <a href="YAKHAR/main_menu.php" style=" text-decoration: none;">Mes remèdes</a>
                    </p>
                    <p>
                        <a href="profil.php" style=" text-decoration: none;">Accueil</a>
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

                    <!-- Links -->
                    <h6 class="text-uppercase font-weight-bold">  Contact</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>
                        <i class="fas fa-home mr-3"></i> Université Sorbonne Paris Nord</p>
                    <p>
                        <i class="fas fa-envelope mr-3"></i> info@example.com</p>
                    <p>
                        <i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                    <p>
                        <i class="fas fa-print mr-3"></i> + 01 234 567 89</p>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

            </div>
            <!-- Footer Links -->

                <!-- Copyright -->
                <div class="footer-copyright text-center py-3">© 2020 Copyright:
                <a href="http://localhost/" style=" text-decoration: none;"> TocTocMédoc.com</a>
            </div>
            <!-- Copyright -->

        </footer>
        <!-- Footer -->
   </body>
</html>
<?php   
}
else {
   header("Location: Connexion_membre.php");
}
?>

