<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "User");
if ($con){
    ?>



    <?php
    
}else{
    echo "no connection";
}


?>
