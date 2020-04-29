<?php
 
session_start();
$emailpseudo=$_SESSION['mail']; 
include_once 'ConnexionBD.php'; //  connexion à la base de données
 
		
$idm = "SELECT id FROM membres WHERE mail= '$emailpseudo'";
$statement1 = $bdd->prepare($idm);
$statement1->execute(array(':id' => $idm));
$donnees = $statement1->fetch();
$idez = $donnees['id'];

if(isset($_POST['formRDV'])) {

   $date = trim(htmlspecialchars($_POST['date']));
   $heure = trim(htmlspecialchars($_POST['heure']));
   $medecin = trim(htmlspecialchars($_POST['medecin']));
   $specialite = trim(htmlspecialchars($_POST['specialite']));
   $adresse = trim(htmlspecialchars($_POST['adresse']));
    

    
   if(!empty($_POST['date']) AND !empty($_POST['heure']) AND !empty($_POST['medecin']) AND !empty($_POST['specialite']) AND !empty($_POST['adresse']) AND !empty($_POST['date'])) {
      $medecinlength = strlen($medecin);
      if($medecinlength <= 255) {
         
          
              $reqspecialite = $bdd->prepare("SELECT * FROM  mesrndvs WHERE specialite = ?");
              
                     $insertmbr = $bdd->prepare("INSERT INTO mesrndvs(id_m,medecin, specialite, date,heure,adresse) VALUES(:id_m, :medecin, :specialite, :date, :heure,:adresse)");
                     $insertmbr->execute(array( 
                                                'id_m'=> $idez,
                                                'medecin' => $medecin,
                                                'specialite' => $specialite,
                                                'date' => $date,
                                                'heure' => $heure,
                                                'adresse' => $adresse));
                    //On redirige l'utilisateur vers la page du récapitulatif
                    header('Location:MonRdv.php');
                    exit;
                 
       } else {
         $erreur = "Votre medecin ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}   

?>
<html>
   <head>
      <title>Rdv</title>
	<meta charset="utf-8">
   
	<!-- CSS -->
	<link href="CSS/style_Rdv.css" rel="stylesheet"/>
    <link rel="stylesheet" href="CSS/vendors/bootstrap.min.css">

	<!-- Framwork--> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	
	
	<!-- Polices -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

	<!-- icon de l'onglet titre de la page -->
    <link rel="icon" type="image/png" href="image/LogoM.jpg" />
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

        <!-- le menu de la page (navbar) -->
        <ul>
			<li class="trait"><a href="#">Mon Traitement</a>
                <ul>
                    <li><a href="Traitement2.php">Nouveau traitement</a></li>
                    <li><a href="Traitement_historique.php">Tous mes traitements</a></li>
                    
                </ul>
			</li>
			<li class="rdv"><a href="#">Mes Rendez-Vous</a>
                 <ul>
                    <li><a href="Rendez-Vous.php">Nouveau rendez-vous</a></li>
                    <li><a href="Rendez-vous_historique.php">Tous mes rendez-vous</a></li>
                </ul>
            </li>
         
			<li><a href="UserCompte.php">Mon profil</a></li>
            <li><a href="chatbot.php">Mon tchatbot</a></li>
            <li><a href="YAKHAR/main_menu.php">Trouver un remède</a></li>
            <li><a href="profil.php">Accueil</a></li>
			<li><a href="Deconnexion.php">Déconnexion</a></li>
    	</ul>	

				
     <div id="login">
           <!--<h3 class="text-center text-white pt-5"></h3>-->
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="" method="post">
                                <h3 class="text-center text-info"><b> Rendez-vous</b></h3>
                                <div class="form-group">
                                    <label for="date" class="text-info " id="label2"><b> Date:</b></label><br>
                                    <input type="date" name="date" id="date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="heure" class="text-info " id="label2"><b> Horraire:</b></label><br>
                                    <input type="time" name="heure" id="heure" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="medecin" class="text-info " id="label1"><b>medecin:</b></label><br>
                                    <input type="text" name="medecin" id="medecin" class="form-control">
                                </div>
                               <!-- <div class="form-group">
                                    <label for="datenaissance" class="text-info " id=""><b>Date de naissance:</b></label><br>
                                    <input type="text" name="datenaissance" id="datenaissance" class="form-control">
                                </div>-->
                                <div class="form-group">
                                    <label for="specialite" class="text-info " id="label2"><b> specialite:</b></label><br>
                                    <input type="especialite" name="specialite" id="specialite" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="adresse" class="text-info " id="label2"><b> Adresse:</b></label><br>
                                    <input type="adresse" name="adresse" id="adresse" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <input type="submit" name="formRDV"  class="btn btn-info btn-lg" value="valider">
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
