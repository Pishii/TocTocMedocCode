<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=toc_toc_medoc-3','root','');
	
}
catch (PDOException $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
