<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins:wght@300&family=Rubik&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon/favicon.png" type="image/x-icon">
    <!-- FONT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style-header.css">
    <link rel="stylesheet" href="../assets/css/style-footer.css">
    <link rel="stylesheet" href="../assets/css/style-slider.css">
    <link rel="stylesheet" href="../assets/css/style-products.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/myprofile.css">
    <!-- CSS -->
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
    <title>My Profile - Edit</title>
</head>

<body>
    <div class="container">
        <!-- --------------- HEADER -----------------    -->
        <?php include '../layout/header-component.php'; ?>
        <!-- --------------- HEADER -----------------    -->
        <!-- --------------- SLIDER -----------------    -->
        <!-- --------------- SLIDER -----------------    -->
        <main>
            <h1 style="text-align:center;padding:10px 0px;">Edit Profile</h1>
            <?php
            require '../config/database.php';
            require '../auth/auth-role-user.php';
            $avatar = mysqli_query($conn, "SELECT avatar FROM user WHERE id = '$userid' ");
            $getavatar = mysqli_fetch_assoc($avatar);
            $information_user = mysqli_query($conn, "SELECT * FROM information_user WHERE userid = '$userid' ");
            $infor = mysqli_fetch_assoc($information_user);
            ?>
            <form method="POST" action="">
            <div class="my-profile">
                <div class="image-profile">
                    <img src="<?php echo $getavatar['avatar'];?>" alt="">
                </div>
                <div class="information-profile">
                    <div>
                        <span>Full Name</span>
                        <input autofocus type="text" name="new_fullname" value="<?php echo $infor['fullname'];?>">
                    </div>
                    <div>
                        <span>Number Phone</span>
                        <input type="text" name="new_numberphone" value="<?php echo $infor['numberphone'];?>">
                    </div>
                    <div>
                        <span>Country</span>
                        <input type="text" name="new_country" value="<?php echo $infor['country'];?>">
                    </div>
                    <div>
                        <span>City</span>
                        <input type="text" name="new_city" value="<?php echo $infor['city'];?>">
                    </div>
                    <div>
                        <span>Address</span>
                        <input type="text" name="new_address" value="<?php echo $infor['address'];?>">
                    </div>
                    <div>
                        <span>Type Pay Card</span>
                        <input type="text" name="new_typepaycard" value="<?php echo $infor['typepaycard'];?>">
                    </div>
                    <div>
                        <span>Cart Number</span>
                        <input type="text" name="new_cardnumber" value="<?php echo $infor['cardnumber'];?>">
                    </div>
                    <div>
                        <span>Name Owner</span>
                        <input type="text" name="new_nameowner" value="<?php echo $infor['nameowner'];?>">
                    </div>
                    <div class="action-profile">
                        <span style="opacity: 0;"> .</span>
                        <div>
                            <button name="edit-profile" style="padding: 10px 20px;">Submit</button>
                            <button name="edit-profile"><a href="./checkout.php">Checkout</a></button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <div class="edit-avatar">
                <form class="update-avatar" action="" method="post" enctype="multipart/form-data">
                    <input class="select-file" type="file" name="avatar">
                    <input class="sub-avt" name="sub-avt" type="submit" value="Completed">
                </form>
            </div>
        <!-- EDITINGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG -->
        <?php
        require '../config/database.php';
        if($_SERVER["REQUEST_METHOD"]==='POST'){
            if( isset($_POST['edit-profile'])){
                $new_fullname = $_POST['new_fullname'];
                $new_numberphone = $_POST['new_numberphone'];
                $new_country = $_POST['new_country'];
                $new_city = $_POST['new_city'];
                $new_address = $_POST['new_address'];
                $new_typepaycard = $_POST['new_typepaycard'];
                $new_cardnumber = $_POST['new_cardnumber'];
                $new_nameowner = $_POST['new_nameowner'];

                if(!empty($userid) && !empty($new_fullname) && !empty($new_numberphone) && !empty($new_country) && !empty($new_city) && !empty($new_address) && !empty($new_typepaycard) && !empty($new_cardnumber) && !empty($new_nameowner) ){
                    $query_edit = "UPDATE information_user SET fullname = '$new_fullname', numberphone = '$new_numberphone', country = '$new_country',
                                    city = '$new_city', address = '$new_address', typepaycard = '$new_typepaycard', cardnumber = '$new_cardnumber',
                                    nameowner = '$new_nameowner' WHERE userid = '$userid'";
                    $editing = mysqli_query($conn, $query_edit);
                    if($editing){
                        ?>
                            <script>
                                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1500
                                });
                            </script>
                        <?php
                    }
                }else{
                    ?><span style="color: red;">Failed. Fields cannot be left blank</span><?php
                }
            }
            if(isset($_POST['sub-avt'])){
                $targetFile = "../uploads/" . basename($_FILES["avatar"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                if (file_exists($targetFile)) { // Xem tệp tin tồn tại chưa
                    ?><span class="error-file-avt">Tệp tin đã tồn tại.</span><?php
                    $uploadOk = 0;
                }
                if ($_FILES["avatar"]["size"] > 5000000) { // Kiểm tra kích thước
                    ?><span class="error-file-avt">Tệp tin quá lớn.</span><?php
                    $uploadOk = 0;
                }
                if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") { // Kiểm tra định dạng
                    ?><span class="error-file-avt">Chỉ cho phép tệp tin định dạng JPG, JPEG, hoặc PNG.</span><?php
                    $uploadOk = 0;
                }
                if ($uploadOk == 0) { // Lỗi thì báo
                    ?><span class="error-file-avt">Không thể tải lên tệp tin</span><?php
                } else {
                    // Di chuyển tệp tin tải lên vào thư mục lưu trữ
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
                        $avatarPath = $targetFile;
                        $stmt = mysqli_prepare($conn, "UPDATE user SET avatar = '$avatarPath' WHERE id = ? ");
                        mysqli_stmt_bind_param($stmt, "i", $userid);
                        $update_avatar = mysqli_stmt_execute($stmt);
                        if($stmt){
                            ?>
                            <script>
                                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1500
                                });
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                            <script>
                                Swal.fire({
                                icon: 'error',
                                title: 'Oops',
                                showConfirmButton: false,
                                timer: 1500
                                });
                            </script>
                        <?php
                    }
                }
            }
        }
        ?>
        <!-- EDITINGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG -->
        <!-- --------------- COMMENT -----------------    -->
        <!-- --------------- COMMENT -----------------    -->
        </main>
        <!-- --------------- FOOTER -----------------    -->
        <?php include '../layout/footer-component.php'; ?>
        <!-- --------------- FOOTER -----------------    -->
    </div>
    <!-- --------------- JAVASCRIPT -----------------    -->
    <!-- <script src="../assets/js/index.js"></script> -->
    <!-- --------------- JAVASCRIPT -----------------    -->
</body>

</html>