<?php

      $servername="localhost";
      $username="root";
      $password="";
      $dbname="toc_toc_medoc-3";

      $server_time=date("Y-m-d H:i:s");

      $conn= new mysqli($servername,$username,$password,$dbname);

      if($conn){

          //echo "Connected";

      }else{

          echo "Failed to Connect";
    }

?>