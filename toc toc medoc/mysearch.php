<?php
session_start();
//on récupère le mail de la personne connecté 
$emailpseudo=$_SESSION['mail'];

include "db.php";


$queryUser = mysqli_query($conn, "select * FROM membres WHERE mail='$emailpseudo'");
$userData = mysqli_fetch_array($queryUser);
  
$server_time=date("Y-m-d H:i:s");

if(isset($_POST['text'])){

    //on réccupère la question (message) qui vient d'etre posté sur le tchat
    $msg=mysqli_real_escape_string($conn,$_POST["text"]);

    // on parcours la table des question pour rechercher une réponse prédéfine pour cette question 
    $query=mysqli_query($conn,"SELECT * FROM questions WHERE question RLIKE '[[:<:]]".$msg."[[:>:]]'");
    $count = mysqli_num_rows($query);

   

        // Si aucune réponse ne correspond à cette question on affiche le message suivant
        if($count=="0"){
            $data = " Je suis désolé mais je ne sais pas exactement comment vous aider";
            $idUser = $userData['id'];
            $query4=mysqli_query($conn,"insert into chatbot(id_user,user,chatbot,action,date)values('$idUser','$msg','$data','text','$server_time')");
        
        }else{
            //Sinon on affiche la réponse correspondant à la question 
            while($row = mysqli_fetch_array($query)){
        
                $data= $row['réponse'];
                $idUser = $userData['id'];
                $action = $row['action'];
                //puis on insère ce nouveau message et sa réponse dans la table chatbot ain d'avoir un historique des conversations avec le chatbot
                $query4=mysqli_query($conn,"insert into chatbot(id_user,user,chatbot,action,date)values('$idUser','$msg','$data','$action','$server_time')");
            }
        }
}  
?>