<html>

<head>
<script>
        //fonction de redirection vers la page d'inscription
        function backToDiagnosticPage(){
            document.location.href="main_menu.php";
        }

        //fonction de redirection vers la page de connexion
       
    
    </script>
<style>

div {
  border: 2px solid gray;
  padding-left: 70px;
  padding-right:70px
}


h3,h2,h4 {
    text-align: justify;
    color: #000000;
    font-family: Helvetica, 'Open Sans', Arial, sans-serif;
    font-size: 20px;
    font-weight: bold;
}
h1{
	text-align: center;
  text-transform: uppercase;
  color: #4CAF50;
}

p{
	text-align: justify;
    color: #000000;
    font-family: Helvetica, 'Open Sans', Arial, sans-serif;
    font-size: 19px;
    
}
button{
position: absolute;
top: 750px;
right: 670px;
height:50px;
 font-size:17px;
  background-color:#00001a; 
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
  border-radius: 8px;
}
button:hover{
  border-radius: 8px;
  background-color: white; 
  color: #00001a; 
  border: 3px solid #00001a;
  font-size:17px;

}

body {
  background-color:white;
}

</style>
    <meta charset="UTF-8">
</head>

<body>

    <?php
	function redirect() {
		die();
	}
$symptome = utf8_decode($_POST['symptome']);

$dbuser='root';
$dbpassword='';
$dbconnection ='mysql:host=localhost;dbname=test';
$indicator=0;
$dbh = new PDO($dbconnection, $dbuser, $dbpassword);
echo '
<div>
';

				foreach($dbh->query("SELECT nom_commun, description_symptome  FROM SYMPTOMES WHERE nom_commun  =\"$symptome\"") as $row)
				{	
					$indicator++;
					$nom_symptome=utf8_encode($row[0]);
					
					$description_symptome=utf8_encode($row[1]);
					echo "<h1>".$nom_symptome."</h1>
						<h2>Description du symptôme</h2>
						<p>".$description_symptome."</p>
						<h3>Liste des remèdes possibles</h3>
						<ul>";
						//requete pour la liste des remedes de chaque symptome
					foreach($dbh->query("SELECT a.nom_remede, a.description_remede, b.posologie FROM REMEDES a JOIN SOIGNE b ON a.id_remede = b.id_remede JOIN SYMPTOMES c ON c.id_symptome = b.id_symptome WHERE c.nom_commun  =\"$nom_symptome\"") as $row2)
					{
						$nom_remede =utf8_encode($row2[0]);
						$description_remede=utf8_encode($row2[1]);
						$posologie=utf8_encode($row2[2]);
						echo "<li>
						<h3>".$nom_remede."</h3>
						<p>".$description_remede."</p>
						<h4>Posologie</h4>
						<p>".$posologie."</p>";
					}
					
					echo "</li>";
					echo '
</div>
<div id="choixSyndrome">
<h1>Les maladies/syndromes liés à '.utf8_encode($symptome).':</h1>';
//requete liste syndrome
foreach($dbh->query("SELECT DISTINCT a.nom_syndrome FROM SYNDROMES a JOIN FAIT_PARTIE_DE b ON a.id_syndrome = b.id_syndrome JOIN SYMPTOMES c ON b.id_symptome=c.id_symptome WHERE c.nom_commun  =\"$nom_symptome\"") as $row3)
					{
						$nom_syndrome =utf8_encode($row3[0]);
						echo "<h2>Symptomes associés à ".$nom_syndrome.":</h2>
						<ul>";
						//requete symptomes inclus dans tel syndrome
						foreach($dbh->query("SELECT c.nom_commun FROM SYNDROMES a JOIN FAIT_PARTIE_DE b ON a.id_syndrome = b.id_syndrome JOIN SYMPTOMES c ON b.id_symptome=c.id_symptome WHERE a.nom_syndrome  =\"$nom_syndrome\"") as $row4)
						{
							$symptomes =utf8_encode($row4[0]);
							echo "<li>
						<h3>".$symptomes."</h3>
						</li>";
						}
					}
echo '</ul>	';
				}
				if($indicator==0){
					header('Location: Oops.php');
					exit();
				}
				
 echo '</div>';
?>
 <button class="btn_back" onclick="backToDiagnosticPage()">Retourner</button>

</body>

</html>

