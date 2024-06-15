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
    <title>Add categories</title>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <?php include '../auth-admin.php'; ?>
    <div>
        <h1>Add categories</h1>
        <div class="admin-actions">
            <a href="./admin-categories.php"><i class="fa-solid fa-angles-left"></i> Categories</a>
        </div>

        <form method="POST" action="" class="addoredit" onsubmit="return add_categories_validateForm()">
            <table>
                <tr>
                    <td>Category Name</td>
                    <td><input type="text" name="categoryname" id="categoryname" placeholder="Enter category name"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><input type="text" name="description" id="description" placeholder="Enter description"></td>
                </tr>
                <tr>
                    <td>User Create</td>
                    <td>
                        <select name="userid" id="userid">
                            <?php
                            require '../../../config/database.php';
                            require '../auth-role-admin.php';
                            $query = mysqli_query($conn, "SELECT * FROM user WHERE status = 'active' AND role = 'admin' ");
                            while($row = mysqli_fetch_assoc($query)){
                                ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['email']; ?></option>
                                <?php
                            }
                            ?>
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
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $categoryname = $_POST['categoryname'];
                $createdate = $_POST['createdate'];
                $description = $_POST['description'];
                $createdate = date('Y-m-d H:i:s');
                $userid = $_POST['userid'];

                if(isset($_POST['add'])){ // Kiểm tra đã nhấn nút thêm chưa
                    $query_add = "INSERT INTO categories(`categoryname`, `createdate`, `description`,`userid`)
                                    VALUES('$categoryname','$createdate','$description','$userid')";
                    $query = mysqli_query($conn, $query_add);
                    if($query){
                        header('Location: ./admin-categories.php');    
                        exit();
                    }
                }
            }
            ?>

    </div>
    <script src="../../../assets/js/admin-categories.js"></script>
</body>
</html>