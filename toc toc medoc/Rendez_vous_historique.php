<?php
session_start();
$emailpseudo=$_SESSION['mail']; 
include_once 'ConnexionBD.php'; //  connexion à la base de données

$idm = "SELECT id FROM membres WHERE mail= '$emailpseudo'";
$statement1 = $bdd->prepare($idm);
$statement1->execute(array(':id' => $idm));
$donnees = $statement1->fetch();
$idez = $donnees['id'];

$requeteUser= $bdd->prepare("SELECT * FROM mesrndvs WHERE id_m =?");
$requeteUser -> execute(array($idez));

?>

<html>
		<head>
			<title>Tous Mes Rendez-Vous</title>
			<meta charset="utf-8">
			<link href="CSS/style_historique_rdv.css" rel="stylesheet"/>
			<link rel="stylesheet" href="CSS/vendors/bootstrap.min.css">
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
					width:50%; text-align:center;
                    position: absolute;
                    display:block;
					margin-top: 250px;
					left: 50%;
					-webkit-transform: translate(-50%, -50%);
					-moz-transform: translate(-50%, -50%);
					-ms-transform: translate(-50%, -50%);
					-o-transform: translate(-50%, -50%);
					transform: translate(-50%, -50%);
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
         
			<li><a href="UserCompte.php">Modifier mon profil</a></li>
            <li><a href="chatbot.php">Mon tchatbot</a></li>
            <li><a href="YAKHAR/main_menu.php">Trouver un remède</a></li>
            <li><a href="profil.php">Accueil</a></li>
			<li><a href="Deconnexion.php">Déconnexion</a></li>
    	</ul>	

        <div id="traite">
            <h2 style="margin-top:60px;">Tous Mes rendez-vous</h2>
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
                    while($row = $requeteUser->fetch()){
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
	
		
		</body>
</html>