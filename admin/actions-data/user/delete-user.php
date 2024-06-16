<?php
require '../../../config/database.php';
require '../auth-role-admin.php';
$id = $_GET['id'];
$query_delete = "DELETE FROM user WHERE id = '$id' ";
$query = mysqli_query($conn, $query_delete);
if($query){
    header('Location: ./admin-user.php');
    exit();
}
?>