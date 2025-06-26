<?php
session_start();
$servername = "sql205.infinityfree.com";
$username = "if0_38509947";
$password = "I123456789c";
$dbname = "if0_38509947_asep_web";


$con = mysqli_connect($servername,$username,$password,$dbname);
if ($con){
    ?>
    




    <?php
    
}else{
    echo "no connection";
}


?>


