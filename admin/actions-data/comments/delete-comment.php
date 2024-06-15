<?php
require '../auth-role-admin.php';
require '../../../config/database.php';
$id = $_GET['id'];
if(isset($id) && !empty($id)){
    $delete = $conn->prepare("DELETE FROM comment WHERE id = ?");
    $delete->bind_param("i", $id);
    $delete->execute();
    if($delete){
        header('Location: ./admin-comment.php');
    }else{
        echo 'lỗi';
    }
}else{
    echo "Lỗi";
}
?>