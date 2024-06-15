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
    <title>Login</title>
    <link rel="shortcut icon" href="../favicon/favicon.png" type="image/x-icon">
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <form method="POST" action="" onsubmit="return validateForm_login()">
        <h2>LOGIN</h2>
        <label for="email">Email <i class="fa-solid fa-user"></i> </label>
        <input type="email" name="email" id="email" placeholder="Enter Email">
        <label for="password">Password <i class="fa-solid fa-lock"></i></label>
        <input type="password" name="password" id="password" placeholder="Enter Password">
        <div class="dp-pass">
            <input type="checkbox" id="dp-pass">
            <label for="dp-pass">Show Password?</label>
        </div>
        <button type="submit" name="submit-login">Login</button>
        <div class="more">
            <a href="./register.php">Regiter</a>
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
        session_start();
        if($_SERVER['REQUEST_METHOD']==="POST"){
            $email = $_POST['email'];
            $password = $_POST['password']; 

            if(isset($_POST['submit-login'])){
                $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE email = ?");
                mysqli_stmt_bind_param($stmt,"s",$email);
                $check_email = mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt); // Lưu kết quả câu truy vấn

                if(mysqli_stmt_num_rows($stmt) > 0){
                    // Check email
                    $query_email = "SELECT * FROM user WHERE email = '$email' AND status = 'active' "; // tài khoản đã đăng kích hoạt chưa
                    $result_email = mysqli_query($conn, $query_email);
                    if(mysqli_num_rows($result_email)==0){ // Nếu chưa đăng ký
                        echo "Tài khoản chưa được đăng ký";
                        exit();
                    }else{ // Nếu đã đăng ký
                        $query_password = "SELECT * FROM user WHERE email = '$email' ";
                        $result_password = mysqli_query($conn, $query_password);
                        $row = mysqli_fetch_assoc($result_password);
                        $verify_password = $row['password'];

                        if(password_verify($password, $verify_password) && $row['role']==='user'){ // Check user
                            $_SESSION['user'] = [
                                'userid' => $row['id'], 
                                'role' => $row['role'] 
                            ];
                            header('Location: ../pages/home.php');
                        }else{
                            ?>
                            <script>
                                Swal.fire({
                                    title: 'Wrong password',
                                    text: 'You need to try again',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Try again',
                                    cancelButtonText: 'Cancel'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = './login.php';
                                    }
                                });
                            </script> 
                            <?php
                        }
                        
                        // CHECK ADMINNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
                        $check_role = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' ");
                        if($row_check_role = mysqli_fetch_assoc($check_role)){
                            if($row_check_role['role'] == 'admin' && password_verify($password, $row_check_role['password'])){
                                $_SESSION['role'] = $row_check_role['role'];
                                header('Location: ../admin/admin.php');
                                exit();
                            }
                        }
                        // CHECK ADMINNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
                        mysqli_stmt_close($stmt); // Đóng câu truy vấn chuẩn bị  
                    }
                }else{
                    ?>
                    <script>
                        Swal.fire({
                            title: 'Account is not registered',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Go to register',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = './register.php';
                            }
                        });
                    </script> 
                <?php
                }
            }
        }
        ?>
    <script src="../assets/js/form.js"></script>
</body>
</html>