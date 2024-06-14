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
    <title>Edit categories</title>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <?php include '../auth-admin.php'; ?>
    <div>
        <h1>Edit categories</h1>
        <div class="admin-actions">
            <a href="./admin-categories.php"><i class="fa-solid fa-angles-left"></i> Categories</a>
        </div>

        <form method="POST" action="" class="addoredit" onsubmit="return edit_categories_validateForm()">
        <?php
        require '../../../config/database.php';
        require '../auth-role-admin.php';
        $id = $_GET['id'];
        $old_data = mysqli_query($conn, "SELECT * FROM categories WHERE id = '$id'");
        $row = mysqli_fetch_array($old_data);
        ?>
            <table>
                <tr>
                    <td>New name</td>
                    <td><input type="text" name="newname" id="newname" placeholder="Enter new name" value="<?php echo $row['categoryname']?>"></td>
                </tr>
                <tr>
                    <td>New description</td>
                    <td><input type="text" name="newdescription" id="newdescription" placeholder="Enter new description" value="<?php echo $row['description']?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button name="edit">Completed Edit</button></td>
                </tr>
            </table>
        </form>

        <?php
            require '../../../config/database.php';
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $newname = $_POST['newname'];
                $newcreatedate = date('Y-m-d H:i:s');
                $newdescription = $_POST['newdescription'];
                $id = $_GET['id'];

                if(isset($_POST['edit'])){
                    $query_update = "UPDATE categories SET categoryname = '$newname', createdate = '$newcreatedate', description = '$newdescription' WHERE id = '$id' ";
                    $query = mysqli_query($conn, $query_update); 
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