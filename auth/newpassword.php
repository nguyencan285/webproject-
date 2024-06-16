<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins:wght@300&family=Rubik&display=swap"rel="stylesheet">
    <title>NEW PASSWORD</title>
    <link rel="shortcut icon" href="../favicon/favicon.png" type="image/x-icon">
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <form method="POST" action="" onsubmit="return validateForm_newpassword()">
        <h2>NEW PASSWORD</h2>
        <label for="password">New password <i class="fa-solid fa-lock-open"></i></label>
        <input type="password" name="password" id="password" placeholder="Enter Password">
        <label for="confirm-password">Confirm password <i class="fa-solid fa-lock"></i></label>
        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
        <button type="submit" name="submit-newpass">Submit</button>
    </form>
    <?php
    require '../config/database.php';
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $token = $_GET['token'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);

        if(isset($_POST['submit-newpass'])){
            $check_email = "SELECT * FROM user WHERE token = '$token' AND status = 'active'";
            $query_check_email = mysqli_query($conn, $check_email);
            if(mysqli_num_rows($query_check_email) > 0){
                $query_update = " UPDATE user SET password = '$hashed_password' WHERE token = '$token' ";
                $susscess = mysqli_query($conn,$query_update);
                if($susscess){
                    ?>
                    <script>
                        Swal.fire({
                            title: 'New password has been updated',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Confirm',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = './login.php';
                            }
                        });
                    </script> 
                    <?php

                    exit();
                }
            }else{
                ?>
                <script>
                    Swal.fire({
                        title: 'Account does not exist',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = './login.php';
                        }
                    });
                </script> 
                <?php
            }
        }
    }
    ?>
    <script src="../assets/js/form.js"></script>
    <!-- Có thể code giao diện đăng nhập gồm: dòng thông báo đổi mật khẩu thành công và giao diện đăng nhập  -->
</body>
</html>