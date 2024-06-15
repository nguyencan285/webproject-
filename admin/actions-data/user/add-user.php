<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/management.css">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/128/2206/2206368.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <title>Add User</title>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <?php include '../auth-admin.php'; ?>
    <div>
        <h1>Add User</h1>
        <div class="admin-actions">
            <a href="./admin-user.php"><i class="fa-solid fa-angles-left"></i> User</a>
        </div>

        <form method="POST" action="" class="addoredit" onsubmit="return add_user_validateForm()">
            <table>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" id="email" placeholder="Enter Email"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password" id="password" placeholder="Enter Password"></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>
                        <select name="role" id="role">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button name="add">Completed Add</button></td>
                </tr>
            </table>
        </form>

        <?php
            require '../../../config/database.php';
            require '../auth-role-admin.php';
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $email = $_POST['email'];
                $token = password_hash($email, PASSWORD_BCRYPT);
                $password = $_POST['password'];
                $hashpassword = password_hash($password, PASSWORD_BCRYPT);
                $createdate = date('Y-m-d H:i:s');
                $role = $_POST['role'];

                if(isset($_POST['add'])){ // Kiểm tra đã nhấn nút thêm chưa
                    $sql = "INSERT INTO user(`email`,`token`,`password`,`role`,`createdate`,`status`)
                                    VALUES(?,?,?,?,?,'active')";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt,"sssss", $email, $token,$hashpassword, $role, $createdate);
                    $run = mysqli_stmt_execute($stmt);
                    if($run){
                        header('Location: ./admin-user.php');
                        exit();    
                    }
                }
            }
            ?>

    </div>
    <script src="../../../assets/js/admin-user.js"></script>
</body>
</html>