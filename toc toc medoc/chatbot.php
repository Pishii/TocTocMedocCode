
<?php 
session_start();
//on récupère le mail de la personne connecté 
$emailpseudo=$_SESSION['mail']; 
//connexion à la base de données 


include "db.php"; 

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    

    <script src="JS/vendors/jquery/jquery.min.js"></script>
    <script src="JS/vendors/bootstrap.min.js"> </script>
    <script src="JS/main.js"> </script>
    <!-- Style CSS -->
    <link rel="stylesheet" href="CSS/style_chatbot.css">

</head>
<body>
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

    <span id="ref">
        <div class="square">
            <center><h2>Pose moi une question </h2></center>
            <br/>

            <button class="btn btn-primary" style="margin-left: 600px;" onclick="delete_message()"> 
                <i class="fa fa-trash-o fa_lg"></i> trash
            </button>
            <?php
                //$query="select * from chatbot where del_msg='1' where id_user = ORDER by date ASC ";
                //$pseudoafficher ="select * FROM membres WHERE mail='$emailpseudo'";
                //$idUser ="SELECT id FROM membres WHERE mail= '$emailpseudo'";

                $res2=mysqli_query($conn,"select * FROM membres WHERE mail='$emailpseudo'");
                $data2 = mysqli_fetch_array($res2);
                $idUser = $data2['id'];

                $res=mysqli_query($conn,"select * from chatbot where del_msg='1' and id_user = '$idUser' ORDER by date ASC ");
              
                //$res3 = mysqli_query($conn, $idUser);
                //$data3 =  mysqli_fetch_array($res3);
                //echo $data3;

                while($data=mysqli_fetch_array($res)){
                    $user=$data['user'];
                    $chatbot=$data['chatbot'];
                    $date=$data['date'];
                    $timestamp = strtotime($date);
                    
                    $action = $data['action'];

                    $pseudoUser =  $data2['pseudo'];
                  

                    $trait = "select * FROM mes_traitement WHERE Idt='$idUser'";
                    $res3=mysqli_query($conn,$trait);
                    $data3 = mysqli_fetch_array($res3);

                    $nom_medoc =   $data3['nom_medoc'];
                    $date_fin = $data3['date_fin'];

                    $rdv = "select * FROM mesrndvs WHERE Id_m='$idUser' order by date ASC";
                    $res4=mysqli_query($conn,$rdv);
                    $data4 = mysqli_fetch_array($res4);

                    $nom_medoc =   $data3['nom_medoc'];
                    $date_fin = $data3['date_fin'];
                    $date_rdv = $data4['date'];
                    $heure_rdv = $data4['heure'];
                    $nom_med = $data4['medecin'];
                
                
            ?>
             
            <?php if ($action == 'text'){ ?>
                <!-- affichage des messages de l'utilisateur -->
                <div class="container1" style="margin-right: 400px;">
                    <img src="Image/Avatar_Penguin.png"  style="width:100%;"/> 
                    <p id="message"><?php echo $user;?></p>
                    <span class="time-right"><?php echo $date;?></span>
                </div>
            
                <!-- affichage de la réponse automatique pour chaque message  -->
                <div class="container1 darker" style="margin-left: 400px;">
                    <img src="Image/avatar_bot.png" alt="Avatar" class="right" style="width:100%;">
                    <p><?php echo $chatbot;?></p>
                    <span class="time-left"><?php echo $date;?></span>
                </div>

            <?php } else{  ?>
                <!-- affichage des messages de l'utilisateur -->
                <div class="container1" style="margin-right: 400px;">
                    <img src="Image/Avatar_Penguin.png"  style="width:100%;"/> 
                    <p id="message"><?php echo $user;?></p>
                    <span class="time-right"><?php echo $date;?></span>
                </div>
            
                <!-- affichage de la réponse automatique pour chaque message  -->
                <div class="container1 darker" style="margin-left: 400px;">
                    <img src="Image/avatar_bot.png" alt="Avatar" class="right" style="width:100%;">
                    <p><?php eval($chatbot);?></p>
                    <span class="time-left"><?php echo $date;?></span>
                </div>

            <?php } ?>
                
            <?php } ?>
            <div class="sticky">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="msg">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="send()">Send</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </span>




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
   

    <script type="text/javascript">
    // la fonction send recherche dans la bdd une réponse à la question qui vient d'etre posée 
    function send(){
        var text=$('#msg').val().toLowerCase();
    
        $.ajax({
                    type:"post",
                    url:"mysearch.php",
                    data:{text:text},
                    success:function(data){
                        //alert(data);
                        $('#ref').load(' #ref');
                    }
        });
    }

    function delete_message(){
        $.ajax({

            type:"post",
            url:"delete_message.php",
            success:function(data){
                $('#ref').load(' #ref');
            }
        });
    }
    </script>

    

</body>
</html>