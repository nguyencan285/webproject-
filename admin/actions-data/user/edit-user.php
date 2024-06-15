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
    <title>Edit User</title>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <?php include '../auth-admin.php'; ?>
    <div>
        <h1>Edit User</h1>
        <div class="admin-actions">
            <a href="./admin-user.php"><i class="fa-solid fa-angles-left"></i> User</a>
        </div>

        <form method="POST" action="" class="addoredit" onsubmit="return edit_categories_validateForm()">
        <?php
        require '../../../config/database.php';
        require '../auth-role-admin.php';
        $id = $_GET['id'];
        $old_data = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
        $row = mysqli_fetch_array($old_data);
        ?>
            <table>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="newemail" id="newemail" placeholder="Enter new email" value="<?php echo $row['email']?>"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="newpassword" id="newpassword" placeholder="Enter new description" value="<?php echo $row['password']?>"></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>
                        <select name="newrole" id="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="newstatus" id="status">
                            <option value="active">Active</option>
                            <option value="no actiive">No actiive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button name="edit">Completed Edit</button></td>
                </tr>
            </table>
        </form>

        <?php
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $newemail = $_POST['newemail'];
                $newcreatedate = date('Y-m-d H:i:s');
                $newpassword = $_POST['newpassword'];
                $newrole = $_POST['newrole'];
                $newstatus = $_POST['newstatus'];
                $id = $_GET['id'];

                if(isset($_POST['edit'])){
                    $query_security = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
                    $row_security = mysqli_fetch_array($query_security);
                    $newpasshash = password_hash($newpassword, PASSWORD_DEFAULT);
                    $query_update = "UPDATE user SET email = '$newemail', createdate = '$newcreatedate', password = '$newpasshash', role = '$newrole', status = '$newstatus' WHERE id = '$id' ";
                    $query = mysqli_query($conn, $query_update); 
                    if($query){
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