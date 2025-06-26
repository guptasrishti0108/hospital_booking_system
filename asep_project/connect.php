<?php
session_start();
$username="if0_38509947";
$password="I123456789c";
$server="sql205.infinityfree.com";
$db="if0_38509947_User";

$con = mysqli_connect($server,$username,$password,$db);

if ($con){
    ?>



    <?php
    
}else{
    echo "no connection";
}


?>
