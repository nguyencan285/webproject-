<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins:wght@300&family=Rubik&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Register</title>
    <link rel="shortcut icon" href="../favicon/favicon.png" type="image/x-icon">
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <form method="POST" action="" onsubmit="return validateForm_register()">
        <h2>REGISTER</h2>
        <label for="email">Email <i class="fa-solid fa-user"></i> </label>
        <input type="email" name="email" id="email" placeholder="Enter Email">
        <label for="password">Password <i class="fa-solid fa-lock-open"></i></label>
        <input type="password" name="password" id="password" placeholder="Enter Password">
        <label for="confirm-password">Confirm password <i class="fa-solid fa-lock"></i></label>
        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
        <span id="error_pass"></span>
        <div class="dp-pass">
            <input type="checkbox" id="dp-pass">
            <label for="dp-pass">Show Password?</label>
        </div>
        <button type="submit" name="submit-register">Register</button>
        <div class="more">
            <a href="./login.php">Login</a>
            <a href="./forgotpassword.php">Forgot Password?</a>
        </div>
        <div class="login-app">
            <a href="" class="fb"><img width="25px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/1200px-Facebook_Logo_%282019%29.png" alt=""></a>
            <a href="" class="gg"><img width="25px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2008px-Google_%22G%22_Logo.svg.png" alt=""></a>
            <a href="" class="pin"><img width="28px" src="https://upload.wikimedia.org/wikipedia/commons/0/08/Pinterest-logo.png" alt=""></a>
        </div>
    </form>
    <?php
    require '../config/database.php';
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $createdate = date('Y-m-d H:i:s');
        $hashed_password = password_hash($password,PASSWORD_DEFAULT); // Mã hóa pass

        if(isset($_POST['submit-register'])){
            $check_email = "SELECT * FROM user WHERE email = '$email' AND status = 'active'";
            $query_check_email = mysqli_query($conn, $check_email);
            if(mysqli_num_rows($query_check_email) > 0){
                ?>
                    <script>
                        Swal.fire({
                            title: 'Account already exists',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Confirm',
                        })
                    </script> 
                    <?php

                exit();
            }
            else{
                // // KHÔNG DÙNG SEND_MAIL
                $token = md5($email);
                $query_register = "INSERT INTO user(`avatar`,`token`,`email`,`password`,`role`,`createdate`,`status`)
                                    VALUES('../uploads/avatar-default.jpg','$token','$email','$hashed_password','user','$createdate','active');";
                $susscess = mysqli_query($conn,$query_register);


                // Lấy id của tài khoản vừa tạo để tạo thông tin người dùng
                $check_email = "SELECT * FROM user WHERE email = '$email' ";
                $query_check_email = mysqli_query($conn, $check_email);
                $row = mysqli_fetch_assoc($query_check_email);
                $id = $row['id'];
                // ------------------------------------------------------------
                $query_add_infor = "INSERT INTO information_user(`userid`,`fullname`,`numberphone`,`country`,`address`,`city`,`typepaycard`,`cardnumber`,`nameowner`)
                                    VALUES('$id','','','','','','','','')";
                $addting = mysqli_query($conn, $query_add_infor);
                if($susscess && $addting){
                    ?>
                    <script>
                        Swal.fire({
                            title: 'Account successfully created',
                            text: 'Please log in to shop',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Go to login',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = './login.php';
                            }
                        });
                    </script> 
                    <?php
                }else{
                    echo "<script>Lỗi</script>";
                }
                // // --------------------------------------------------------------------------------------------------------
                // // DÙNG SEND_MAIL (sẽ tạo thông tin người dùng bên link validate)
                // $query_register = "INSERT INTO user(`email`,`password`,`role`,`createdate`,`status`)
                //                     VALUES('$email','$hashed_password','user','$createdate','no active');";
                // $susscess = mysqli_query($conn,$query_register);

                // if($susscess){
                //     $check_email = "SELECT * FROM user WHERE email = '$email' ";
                //     $query_check_email = mysqli_query($conn, $check_email);
                //     $row = mysqli_fetch_assoc($query_check_email);
                //     $id = $row['id'];

                //     $to_Mail = $email;
                //     $subject = 'CONFIRM ACCOUNT';
                //     $content = 'Nhấn vào link để kích hoạt tài khoản: http://localhost/newstyle/pages/form/validateMail.php?id=' . $id;
                //     $headers = 'From: niboss458@gmail.com';
    
                //     if(mail($to_Mail,$subject,$content,$headers)){
                //         echo "<script>alert('Đã gửi xác thực đến email của bạn!!!')</script>";
                //     }else{
                //         echo "<span>Không thành công</span>";
                //     }
                // }
                // // --------------------------------------------------------------------------------------------------------
            }
        }
    }
    ?>
    <script src="../assets/js/form.js"></script>
</body>
</html>