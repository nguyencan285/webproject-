<?php
require '../config/database.php';
$email = $_POST['email'];
$id = $_GET['id'];

$query_validate = "UPDATE user SET status = 'active' WHERE id = '$id' "; // kích hoạt tài khoản (active)
$validate = mysqli_query($conn, $query_validate);
$query_add_infor = "INSERT INTO information_user(`userid`,`fullname`,`numberphone`,`country`,`address`,`city`,`typepaycard`,`cardnumber`,`nameowner`)
                    VALUES('$id','','','','','','','','')"; // Tạo thông tin người dùng
$addting = mysqli_query($conn, $query_add_infor);
if($validate && $addting){
    header('Location: ./login.php');
    exit();
}else{
    echo "<script>Lỗi</script>";
}
?>



