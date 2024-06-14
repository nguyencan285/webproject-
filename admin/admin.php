<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/management.css">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/128/2206/2206368.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <title>Admin</title>
</head>
<body>
    <?php   
        require '../config/database.php';
        session_start();
        if(isset($_SESSION['role'])){
            if($_SESSION['role']==='admin'){
                // Xác nhận đó là admin
            }else{
                header('Location: ../error/401.php');
            }
        }else{
            header('Location: ../error/401.php');
        }
        // ON - OFF VALIDATEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(isset($_POST['on'])){
                $query = mysqli_query($conn,"UPDATE validate SET status = 'on' WHERE id = ')#^^$^!&)$' ");
                if($query){
                    header('location: ./admin.php');
                }
            }else{
                $query = mysqli_query($conn,"UPDATE validate SET status = 'off' WHERE id = ')#^^$^!&)$' ");
                if($query){
                    header('location: ./admin.php');
                }
            }
        }
        // <!-- Auth when status validate off - Phần này phòng trường hợp truy cập bằng link -->
        $validate = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM validate WHERE id = ')#^^$^!&)$'"));
        if($validate['status']==='on'){
            ?>
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    title: "Authentication",
                    html: '<input type="password" id="password" class="swal2-input" placeholder="Enter your password">',
                    showCancelButton: false,
                    confirmButtonText: "Submit",
                    allowOutsideClick: false,
                    preConfirm: () => {
                        const password = document.getElementById("password").value;
                        // Thực hiện kiểm tra mật khẩu ở đây
                        if (password === "admin") {
                            return true; // Cho phép truy cập
                        } else {
                            Swal.showValidationMessage("Incorrect password");
                            return false; // Không cho phép truy cập
                        }
                    }
                }).then((result) => {
                    if (!result.isConfirmed) {
                        window.location.href = "../../auth/login.php";
                    }
                });
            });
        </script>
            <?php
        }
    ?>
    <!-- Auth when status validate off - Phần này phòng trường hợp truy cập bằng link   -->
    <!-- ====================================================================================================================== -->
    <div>
        <h1><i class="fa-solid fa-user"></i> Admin</h1>
        <?php
        $statusValidate = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM validate WHERE id = ')#^^$^!&)$'"));
        ?>
        <form action="" method="POST">
            <?php
            if($statusValidate['status']==='on'){
                ?><button style="background-color: #3EC70B;padding: 7px 9px;border-radius:100%;" name="off"><i class="fa-solid fa-lock"></i></button><?php
            }else{
                ?><button style="background-color: red;padding: 7px 7.2px;border-radius:100%;" name="on"><i class="fa-solid fa-lock-open fa-fade"></i></button><?php
            }
            ?>
        </form>
        <div class="admin-page">
            <a href="../pages/home.php"><i class="fa-solid fa-earth-americas fa-spin fa-spin-reverse"></i> Website</a>
            <a href="./actions-data/user/admin-user.php"><i class="fa-solid fa-users"></i> Users</a>
            <a href="./actions-data/categories/admin-categories.php"><i class="fa-solid fa-list"></i> Categories</a>
            <a href="./actions-data/products/admin-product.php"><i class="fa-solid fa-store"></i> Product</a>
            <a href="./actions-data/orders/infor-user.php"><i class="fa-regular fa-address-card"></i> InforUser</a>
            <a href="./actions-data/orders/admin-order.php"><i class="fa-solid fa-bag-shopping"></i> Orders</a>
            <a href="./actions-data/blogs/admin-blogs.php"><i class="fa-solid fa-blog"></i> Blogs</a>
            <a href="./actions-data/comments/admin-comment.php"><i class="fa-regular fa-comments"></i> Comments</a>
            <a href="./actions-data/email/admin-email.php"><i class="fa-solid fa-envelope-open-text"></i> Email</a>
            <a href="./statistical.php"><i class="fa-solid fa-chart-line"></i> Statistical</a>
            <a href="../auth/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>
    <!-- -----------  -->
</body>
</html>