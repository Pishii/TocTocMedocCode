<?php
include_once 'ConnexionBD.php';

if(isset($_POST['forminscription'])) {
    
   $pseudo = trim(htmlspecialchars($_POST['pseudo']));
   $mail = trim(htmlspecialchars($_POST['mail']));
   $mail2 = trim(htmlspecialchars($_POST['mail2']));
    
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
    
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                  	$mdp_crypted = sha1($mdp);
                     $insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse) VALUES(:pseudo, :mail, :motdepasse)");
                     $insertmbr->execute(array('pseudo' => $pseudo,
                                               'mail' => $mail,
                                               'motdepasse' => $mdp_crypted));
                      
                     //On redirige l'utilisateur vers la page de connexion
                     header('Location:connexion_membre.php');
                     exit;
                                 
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<html>
   <head>
      <title>Inscription</title>
	<meta charset="utf-8">

	<!-- CSS -->
	<link href="CSS/style_inscription.css" rel="stylesheet"/>
    <link rel="stylesheet" href="CSS/vendors/bootstrap.min.css">

	<!-- Framwork--> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	
	
	<!-- Polices -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

	<!-- icon de l'onglet titre de la page -->
	<link rel="icon" type="image/png" href="image/LogoM.jpg" />
   </head>
  
   <body>

		<!-- le menu de la page (navbar) -->
		
     <div id="login">
           <!--<h3 class="text-center text-white pt-5"></h3>-->
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="" method="post">
                                <h3 class="text-center text-info"><b>Inscription</b></h3>
                                <div class="form-group">
                                    <label for="pseudo" class="text-info " id="label1"><b>Pseudo:</b></label><br>
                                    <input type="text" name="pseudo" id="pseudo" class="form-control">
                                </div>
                               <!-- <div class="form-group">
                                    <label for="datenaissance" class="text-info " id=""><b>Date de naissance:</b></label><br>
                                    <input type="text" name="datenaissance" id="datenaissance" class="form-control">
                                </div>-->
                                <div class="form-group">
                                    <label for="mail" class="text-info " id="label2"><b> E-mail:</b></label><br>
                                    <input type="email" name="mail" id="mail" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="mail2" class="text-info"  id="label3"><b> Confirmez votre E-mail:</b></label><br>
                                    <input type="email" name="mail2" id="mail2" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="mdp" class="text-info " id="label4"><b> Mot de passe:</b></label><br>
                                    <input type="password" name="mdp" id="mdp" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="mdp2" class="text-info" id="label5"><b> Confirmez votre mot de passe:</b></label><br>
                                    <input type="password" name="mdp2" id="mdp2" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="forminscription"  class="btn btn-info btn-lg" value="S'inscrire">
                                </div>
                                <div> <?php   if(isset($erreur)){
                                                    echo '<font color="red " size="4px" >'.'<b>'.'<h4 style="text-align: center;">'.$erreur.'</h4>'.'</b>'.'</font>'; }?>
                                </div> 
                            </form>

                        </div>
                    </div>
                </div>
            </div>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
   </body>
</html>
