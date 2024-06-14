<?php
$conn = mysqli_connect('localhost','root','','newstyle');
if(!$conn){
    header("Location: ../error/500.php");
    exit('Database connection failed !!!');
}
?>