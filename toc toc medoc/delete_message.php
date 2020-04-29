<?php 

include "db.php";

$query = mysqli_query($conn,"update chatbot SET del_msg='0' ");

?>