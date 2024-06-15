<?php
require '../../../config/database.php';
require '../auth-role-admin.php';
$id = $_GET['id'];
$sql = "DELETE FROM blogs WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
$run = mysqli_stmt_execute($stmt);
if(!$run){
    echo "Lỗi";
}
if(mysqli_affected_rows($conn)>0){
    header("Location: ./admin-blogs.php");
    exit();
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>