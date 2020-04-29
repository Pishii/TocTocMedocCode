<?php

session_start();
$emailpseudo=$_SESSION['mail']; 
include_once 'ConnexionBD.php'; // connexion à la base de données 


$idt = "SELECT id FROM membres WHERE mail= '$emailpseudo'";
$statement1 = $bdd->prepare($idt);
$statement1->execute(array(':id' => $idt));
$donnees = $statement1->fetch();
$idez = $donnees['id'];

if(isset($_POST['formtraitement'])) {

    $nom_medoc = trim(htmlspecialchars($_POST['nom_medoc']));
    $type_prise = trim(htmlspecialchars($_POST['type_prise']));
    $matin = trim(htmlspecialchars($_POST['matin']));
    $midi = trim(htmlspecialchars($_POST['midi']));
    $soir= trim(htmlspecialchars($_POST['soir']));
    $date_debut= trim(htmlspecialchars($_POST['date_debut']));
    $date_fin= trim(htmlspecialchars($_POST['date_fin']));
    
    if(!empty($_POST['nom_medoc']) AND !empty($_POST['type_prise']) AND !empty($_POST['date_debut']) AND !empty($_POST['date_fin'])) {
        $medicamentlength = strlen($nom_medoc);
        $quan = $_POST['quantite'];
        if(empty($quan[0])&&empty($quan[1])&&empty($quan[2])){
            $erreur =  "veuillez saisir au moins une quantite";
        }
        else if($medicamentlength <= 255){
                //if(!empty($_POST['frm_arg'])){
                    $frm = $_POST['frm_arg'];
                    $jour = array();
                    for($j = 0;$j<8;$j++){
                        $jour[$j] = 0;
                    }
                    for($i = 0; $i<count($frm);$i++){
                        switch ($frm[$i]) {
                            case 'Lundi':
                                $jour[0] = 1;
                                break;
                            case 'Mardi':
                                $jour[1] = 1;
                                break;
                            case 'Mercredi':
                                $jour[2] = 1;
                                break;
                            case 'Jeudi':
                                $jour[3] = 1;
                                break;
                            case 'Vendredi':
                                $jour[4] = 1;
                                break;
                            case 'Samedi':
                                $jour[5] = 1;
                                break;
                            case 'Dimanche':
                                $jour[6] = 1;
                                break;
                        }
                    }
                    $quanNew = array();
                    for($k=0;$k<3;$k++){
                        if(!empty($quan[$k])){
                            $quanNew[$k] = $quan[$k];
                        }
                        else 
                            $quanNew[$k] = 0;
                    }

                    $insertTraitement = $bdd->prepare("INSERT INTO mes_traitement(idt,nom_medoc,type_prise,matin,midi,soir,lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche,date_debut,date_fin) VALUES (:idt,:nom_medoc,:type_prise,:matin,:midi,:soir,:lundi,:mardi,:mercredi,:jeudi,:vendredi,:samedi,:dimanche,:date_debut,:date_fin)");
                    $insertTraitement -> execute(array( 'idt' => $idez,
                                                'nom_medoc' => $nom_medoc,
                                                'type_prise'=> $type_prise,
                                                'matin'=> $quanNew[0],
                                                'midi'=> $quanNew[1],
                                                'soir'=> $quanNew[2],
                                                'lundi'=> $jour[0],
                                                'mardi'=> $jour[1],
                                                'mercredi'=> $jour[2],
                                                'jeudi'=> $jour[3],
                                                'vendredi'=> $jour[4],
                                                'samedi'=> $jour[5],
                                                'dimanche'=> $jour[6],
                                                'date_debut' => $date_debut,
                                                'date_fin' => $date_fin));
                //$erreur = "votre traitement a été enregistré";
                //On redirige l'utilisateur vers la page du récapitulatif
                header('Location:MonTraitement.php');
                exit;
            }
            //else{
                //$erreur = "Veuillez cocher au moins une fois le Jour de Prise !";
            //}
        else{
            $erreur = "Votre nom de médicament est trop long !";
        }
        
        
    }
    else{
        
        $erreur = "Tous les champs doivent etre complétés !";
    }
    
}  
?>
<html>
   <head>
        <title>Traitement</title>
        <meta charset="utf-8">

        <!-- CSS -->
        <link href="CSS/style_traitement.css" rel="stylesheet"/>
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
    <style>
                /*footer*/
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
					color: green;
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
                        <form id="login-form" class="form" action="" method="post">
                                <h3 class="text-center text-info"><b>Traitement</b></h3>
                                <div class="form-group">
                                    <label for="nom_medoc" class="text-info " id="label1"><b>Nom médicament:</b></label><br>
                                    <input type="text" name="nom_medoc" id="nom_medoc" class="form-control" value="<?php if (isset($nom_medoc))  { echo $nom_medoc; } ?>" >
                                </div>

                                <div class="form-group">
                                    <label for="type_prise" class="text-info " id="label"><b>Type de prise </b></label>
                                      <select name="type_prise" id="type_prise" class="form-control">
                                        <option value="Cuillère à soupe">Cuillère à soupe</option>
                                        <option value="Cuillère à café">Cuillère à café</option>
                                        <option value="Comprimé">Comprimé</option>
                                        <option value="Bouchon">Bouchon</option>
                                      </select>
                                </div>
                                <div class="form-group">
                                    <label for="matin" class="text-info " id="label2"><b> Quantité-Matin:</b></label><br>
                                    <input type="text" name="quantite[]" id="matin" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="midi" class="text-info " id="label2"><b> Quantité-Midi:</b></label><br>
                                    <input type="text" name="quantite[]" id="midi" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="soir" class="text-info " id="label2"><b> Quantité-Soir:</b></label><br>
                                    <input type="text" name="quantite[]" id="soir" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="jour" class="text-info " id="label2"><b> Jours de Prise:</b></label><br>
                                    <input type="checkbox" name="frm_arg[]" value="Lundi"> <label for="Lundi"  class="text-info"> Lundi  </label>
                                    <input type="checkbox" name="frm_arg[]" value="Mardi"> <label for="Mardi"  class="text-info"> Mardi  </label>
                                    <input type="checkbox" name="frm_arg[]" value="Mercredi"> <label for="Mercredi"  class="text-info"> Mercredi  </label>
                                    <input type="checkbox" name="frm_arg[]" value="Jeudi"> <label for="Jeudi"  class="text-info"> Jeudi  </label><br>
                                    <input type="checkbox" name="frm_arg[]" value="Vendredi"> <label for="Vendredi"  class="text-info"> Vendredi  </label>
                                    <input type="checkbox" name="frm_arg[]" value="Samedi"> <label for="Samedi"  class="text-info"> Samedi  </label>
                                    <input type="checkbox" name="frm_arg[]" value="Dimanche"> <label for="Dimanche"  class="text-info"> Dimanche  </label>
                                </div>
                                <div class="form-group">
                                    <label for="date_debut" class="text-info " id="label"><b> Date Début </b></label><br>
                                    <input type="date" name="date_debut" id="date_debut" class="form-control" value="<?php if (isset($date_debut))  { echo $date_debut; } ?>">
                                </div>
                                <div class="form-group">
                                    <label for="date_fin" class="text-info " id="label"><b> Date Fin </b></label><br>
                                    <input type="date" name="date_fin" id="date_fin" class="form-control" value="<?php if (isset($date_fin))  { echo $date_fin; } ?>">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="formtraitement"  class="btn btn-info btn-lg" value="Enregistrer">
                                </div>
                               
                                <div> <?php   if(isset($erreur)){
                                                    echo '<font color="red " size="4px" >'.'<b>'.'<h4 style="text-align: center;">'.$erreur.'</h4>'.'</b>'.'</font>'; }?>
                                </div> 
                            </form>

                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>




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