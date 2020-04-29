<!DOCTYPE html>
<html lang = "fr">
<head>
    <meta charset="UTF8">
    
    <link rel="stylesheet" href="CSS/vendors/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/vendors/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/style-accueil.css">
    
    
    <title>Document</title>
</head>
    <script>
        //fonction de redirection vers la page d'inscription
        function fonctionInscription(){
            document.location.href="inscription.php";
        }

        //fonction de redirection vers la page de connexion
        function fonctionConnexion()
		{
            document.location.href="connexion_membre.php";
        }
    
    </script>
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
        }
        
        .foot h6{
            color: green;
        }
    </style>
<body>
    
    <!-- Hearder -->
   <header  class="container-fluid header">
        <div class="container">
            <!-- on va créer une ligne -->   
            <div class="row">
                <!-- Bars icon for nav -->
                <i class="icon far fa-bars"></i>  
                <!-- logo -->
                <div class="col-md-3 col-xs-12 col-sm-12 col-lg-3">
                    <div class="logo">
                        <!--<h2>Toc Toc Médoc</h2>-->
                        <img src="Image/logo2.png">
                    </div>
                </div>
                
                <!-- Navigation du site -->
                <nav class="col-md-9 col-xs-12 col-sm-12 col-lg-9">
                    <ul class="nav-list">
                        <li class="list"><a href="#">Accueil</a></li>
                        <li class="list"><a href="inscription.php">Inscription</a></li>
                        <li class="list"><a href="connexion_membre.php">Connexion</a></li>
                        <li class="list"><a href="YAKHAR/main_menu.php">Trouver un remède</a></li>
                      
                       
                    </ul>
                </nav>
                
            </div>
        </div>
    </header> 
    
    <!-- end header -->
    
    <!-- Home -->
    <section class="sections home text-center">
        <div class="over-lay">
            <div class="container">
               <div class="home-content">
                    <h3 class="home-title"> Bienvenue sur Toc Toc Médoc</h3>
                    <p class="lead home-desc">
                        Toc Toc Médoc, l'application qui vous accompagne, enregistre et vous rappelle tous vos traitements et rendez-vous médicaux !
                    </p>
                    <button class="btn button" onclick="fonctionConnexion()"> Connexion</button>
                    <button class="btn button" onclick="fonctionInscription()"> Inscription</button>
                </div>
            </div>
        </div>
    </section>
    <script src="JS/vendors/jquery/jquery.min.js"></script>
    <script src="JS/vendors/bootstrap.min.js"> </script>
    <script src="JS/main.js"> </script>
   


   
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