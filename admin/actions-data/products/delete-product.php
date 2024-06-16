<?php
require '../../../config/database.php';
require '../auth-role-admin.php';
$id = $_GET['id'];
$query_delete = "DELETE FROM products WHERE id = '$id' ";
$query = mysqli_query($conn, $query_delete);
if($query){
    header('Location: ./admin-product.php');
    exit();
}
?>