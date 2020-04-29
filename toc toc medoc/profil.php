<?php 
session_start();
$emailpseudo=$_SESSION['mail']; 
include_once 'ConnexionBD.php'; // l'appel a la connexion avec la base de données
 
 // pour récuperer le prénom d'affichage (Bonjour Pseudo)
		
$pseudoafficher ="SELECT * FROM membres WHERE mail= '$emailpseudo'";
$statement = $bdd->prepare($pseudoafficher);
$statement->execute(array(':pseudo' => $pseudoafficher));

$idm = "SELECT id FROM membres WHERE mail= '$emailpseudo'";
$statement1 = $bdd->prepare($idm);
$statement1->execute(array(':id' => $idm));
$donnees = $statement1->fetch();
$idez = $donnees['id'];

$requeteUser= $bdd->prepare("SELECT * FROM mes_traitement WHERE idt=?");
$requeteUser -> execute(array($idez));

$requeteUser1= $bdd->prepare("SELECT * FROM mesrndvs WHERE id_m =?");
$requeteUser1 -> execute(array($idez));

?>

<html>
		<head>
			<title>Profil</title>
			<meta charset="utf8">
			
			<!-- Framwork--> 
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

			
			
			<!-- Polices -->
			<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
			<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
			<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
			<link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
			<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
			<!-- CSS -->
			
			<link rel="stylesheet" href="CSS/vendors/bootstrap.min.css">
			<link href="CSS/style_profil.css" rel="stylesheet"/>
			<style type="text/css">
				table {
  					border-collapse: collapse;
				}

				table, th, td {
  					border: 1px solid black;
  					padding: 15px;
  					text-align: center;
  					background-color: #f2f2f2;
				}

				th {
  					background-color: green;
  					color:white;
				}

				#traite{
					
                }
                
                #traite h2{
                    text-align: center;
                }

                #traitee{
				
                }
                
                #traitee h2{
                    text-align: center;
                }
                

			</style>
        	
		</head>
		<body>
					  
     <!-- header -->
		<header >
	
				
				<!-- La balise <nav> définit un ensemble de liens de navigation. -->
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
	

		</header> <!-- end header-->
		


			
		<div id="traite">
			<h2 style="margin-top:60px;">Tous Mes Traitements</h2>
			<table>
				<tr>
					<th>
						Nom du médicament
					</th>
					<th>
						Date debut
					</th>
					<th>
						Date Fin
					</th>
					<th>
						Matin
					</th>
					<th>
						Midi
					</th>
					<th>
						Soir
					</th>
				</tr>
				<?php
					while($row = $requeteUser->fetch()){
				?>
				<tr>
					<td>
						<?php echo $row["nom_medoc"];?>
					</td>
					<td>
						<?php echo $row["date_debut"];?>
					</td>
					<td>
						<?php echo $row["date_fin"];?>
					</td>
					<td>
						<?php echo $row["matin"];?>
					</td>	
					<td>
						<?php echo $row["midi"];?>
					</td>
					<td>
						<?php echo $row["soir"];?>
					</td>				
				</tr>
				<?php }?>
			</table>
		</div>

		
		<div id="traitee">
			<h2 style="margin-top:60px;">Tous Mes Rendez-Vous</h2>
			<table>
				<tr>
					<th>
						Date 
					</th>
					<th>
						Heure
					</th>
					<th>
						Medecin
					</th>
					<th>
						Spécialité
					</th>
					<th>
						Adresse
					</th>
				</tr>
				<?php
					while($row = $requeteUser1->fetch()){
				?>
				<tr>
					<td>
						<?php echo $row["date"];?>
					</td>
					<td>
						<?php echo $row["heure"];?>
					</td>
					<td>
						<?php echo $row["medecin"];?>
					</td>
					<td>
						<?php echo $row["specialite"];?>
					</td>	
					<td>
						<?php echo $row["adresse"];?>
					</td>			
				</tr>
				<?php }?>
			</table>
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