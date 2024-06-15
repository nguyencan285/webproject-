<?php
require '../../../config/database.php';
require '../auth-role-admin.php';
$status = $_GET['status'];
$id = $_GET['id'];
$edit_status = mysqli_query($conn, "UPDATE orders SET status = '$status' WHERE id = '$id'");
if($edit_status){
    header('Location: ./admin-order.php');
}
?>