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
    <title>Categories</title>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <?php include '../auth-admin.php'; ?>
    <div>
        <h1><i class="fa-solid fa-list"></i> Categories</h1>
        <div class="admin-actions">
            <a href="../../admin.php"><i class="fa-solid fa-angles-left"></i> Admin</a>
            <a href="./add-categories.php"><i class="fa-solid fa-plus"></i> Add categories</a>
        </div>
        <table class="view">
            <tr class="indent">
                <td>ID</td>
                <td>Categoryname</td>
                <td>Create Date</td>
                <td>Description</td>
                <td>User Id</td>
                <td>Action</td>
            </tr>

            <?php
            require '../../../config/database.php';
            require '../auth-role-admin.php';
            $query = " SELECT * FROM categories"; 
            $results = mysqli_query($conn, $query); 
            while ($row = mysqli_fetch_array($results)){  
                ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['categoryname'] ?></td>
                    <td><?php echo $row['createdate'] ?></td>
                    <td><?php echo $row['description'] ?></td>
                    <td><?php echo $row['userid'] ?></td>
                    <td class="actions">
                        <a href="../categories/edit-categories.php?id=<?php echo $row['id']?>"><button class="edit">Edit <i class="fa-solid fa-pen-to-square"></i> </button></a>
                        <a onclick=" return confirm('Bạn muốn xóa ?') " href="../categories/delete-categories.php?id=<?php echo $row['id']?>"><button class="delete">Delete <i class="fa-solid fa-trash-can"></i></button></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</body>
</html>





