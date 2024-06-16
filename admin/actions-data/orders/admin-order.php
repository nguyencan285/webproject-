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
    <title>Orders</title>
    <style>
        .viewproduct tr{
            display: grid;
            grid-template-columns: 5% repeat(7,1fr) 10%;
        }
        .admin-actions{
            background-color: #16161c;
        }
        tr.indent td{
            background-color: black;
        }
        table.view{
            border-color: black;
        }
        td a button{
            background-color: green;
            color: white;
            border-radius: 2px;
        }
        img{
            width: 70%;
        }
    </style>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <?php include '../auth-admin.php'; ?>
    <div>
        <h1><i class="fa-solid fa-bag-shopping fa-bounce"></i> Orders</h1>
        <form class="button-filter" action="" method="POST">
            <button name="sent" style="background-color: red;">Sent <i class="fa-regular fa-paper-plane"></i></button>
            <button name="processing" style="background-color: #1B6B93;">Processing <i class="fa-solid fa-check"></i></button>
            <button name="delivering" style="background-color: #DF2E38;">Delivering <i class="fa-solid fa-truck-fast"></i></button>
            <button name="completed" style="background-color:green;">Completed <i class="fa-solid fa-check-double"></i></button>
        </form>
        <div class="admin-actions">
            <a href="../../admin.php"><i class="fa-solid fa-angles-left"></i> Admin</a>
        </div>
        <table class="view viewproduct">
            <tr class="indent">
                <td>ID</td>
                <td>User ID</td>
                <td>Image</td>
                <td>OrderDate</td>
                <td>Product</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Status</td>
                <td>Action</td>
            </tr>

            <?php
            require '../../../config/database.php';
            require '../auth-role-admin.php';
            if($_SERVER['REQUEST_METHOD']==='POST'){
                if(isset($_POST['completed'])){
                    $query = " SELECT * FROM orders WHERE status = 'Completed' ";
                    include './component-order.php'; 
                }
                if(isset($_POST['delivering'])){
                    $query = " SELECT * FROM orders WHERE status = 'Delivering' ";
                    include './component-order.php'; 
                }
                if(isset($_POST['processing'])){
                    $query = " SELECT * FROM orders WHERE status = 'Processing' ";
                    include './component-order.php'; 
                }
                if(isset($_POST['sent'])){
                    $query = " SELECT * FROM orders WHERE status = 'Sent' ";
                    include './component-order.php'; 
                }
            }else{
                $query = " SELECT * FROM orders WHERE status = 'Sent' ";
                include './component-order.php';
            }
            ?>
        </table>
    </div>
</body>
</html>





