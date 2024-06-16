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
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="shortcut icon" href="../favicon/favicon.png" type="image/x-icon">
    <title>Forgot Password</title>
    <style>button{margin-top: 20px;}</style>
</head>
<body>
    <form method="POST" action="" onsubmit="return validateForm_forgotpassword()">
        <h2>FORGOT PASSWORD</h2>
        <label for="email">Email <i class="fa-solid fa-user"></i> </label>
        <input type="email" name="email" id="email" placeholder="Enter Email">
        <button type="submit" name="sendcode">Send Code</button>
        <div class="more">
            <a href="./login.php">Login</a>
            <a href="./register.php">Regiter</a>
        </div>
        <div class="login-app">
            <a href="" class="fb"><img width="25px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/1200px-Facebook_Logo_%282019%29.png" alt=""></a>
            <a href="" class="gg"><img width="25px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2008px-Google_%22G%22_Logo.svg.png" alt=""></a>
            <a href="" class="pin"><img width="28px" src="https://upload.wikimedia.org/wikipedia/commons/0/08/Pinterest-logo.png" alt=""></a>
        </div>
    </form>
    <?php
        require '../config/database.php';
        if($_SERVER["REQUEST_METHOD"]=='POST'){
            $email = $_POST['email'];  

            $check_email = "SELECT * FROM user WHERE email = '$email' ";
            $query_check_email = mysqli_query($conn, $check_email);
            $row = mysqli_fetch_assoc($query_check_email);
            if(mysqli_num_rows($query_check_email) === 0){
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
                exit();
            }else{
                if(isset($_POST['sendcode'])){
                    $token = $row['token'];
                    $to_Mail = $email;
                    $subject = 'FORGOT PASSWORD';
                    $content = 'Nhấn vào link để tạo mật khẩu mới: http://http://localhost/newstyle/auth/newpassword.php?token='.$token;
                    $headers = 'From: niboss458@gmail.com';
        
                    if(mail($to_Mail, $subject, $content, $headers)){
                        ?>
                            <script>
                                Swal.fire({
                                    title: 'Confirmation has been sent to your email',
                                    text: 'Do you want to redirect to the homepage?',
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
                        ?>
                            <script>
                                Swal.fire({
                                    title: 'Unsuccessful',
                                    text: '',
                                    icon: 'warning',
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
                    }
                }
            }
        }
        ?>
    <script src="../assets/js/form.js"></script>
</body>
</html>