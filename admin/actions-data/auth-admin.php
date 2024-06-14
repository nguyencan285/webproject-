<?php
session_start();
if(isset($_SESSION['role'])){
    if($_SESSION['role']==='admin'){
        // Xác nhận đó là admin
    }else{
        header('Location: ../../../error/401.php');
    }
}else{
    header('Location: ../../../error/401.php');
}
?>