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
    <title>Products</title>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <?php include '../auth-admin.php'; ?>
    <div>
        <h1><i class="fa-solid fa-cart-shopping"></i> Products</h1>
        <form class="button-filter" action="" method="POST">
            <button name="hot" style="background-color: red;">Hot <i class="fa-solid fa-fire"></i></button>
            <button name="new" style="background-color:green;">New <i class="fa-regular fa-star"></i></button>
            <button name="sales" style="background-color: black;">Sales <i class="fa-solid fa-percent"></i></button>
        </form>
        <div class="admin-actions">
            <a href="../../admin.php"><i class="fa-solid fa-angles-left"></i> Admin</a>
            <a href="./add-product.php"><i class="fa-solid fa-plus"></i> Add product</a>
        </div>
        <table class="view viewproduct">
            <tr class="indent">
                <td>ID</td>
                <td>Productname</td>
                <td>Image</td>
                <td>Price</td>
                <td>Create Date</td>
                <td>Description</td>
                <td>Category ID</td>
                <td>Status</td>
                <td>Sales</td>
                <td>Price Sales</td>
                <td>Action</td>
            </tr>

            <?php
            require '../../../config/database.php';
            require '../auth-role-admin.php';
            if(isset($_POST['hot'])){
                $query = " SELECT * FROM products WHERE status = 'hot' "; 
                include './products-layout.php';
            }else if(isset($_POST['new'])){
                $query = " SELECT * FROM products WHERE status = 'new' "; 
                include './products-layout.php';
            }else if(isset($_POST['sales'])){
                $query = " SELECT * FROM products WHERE sales > 0 "; 
                include './products-layout.php';
            }else if(isset($_POST['jacket'])){
                $query = " SELECT * FROM products WHERE categoryid = 8 "; 
                include './products-layout.php';
            }else if(isset($_POST['shirt'])){
                $query = " SELECT * FROM products WHERE categoryid = 9 "; 
                include './products-layout.php';
            }else if(isset($_POST['hat'])){
                $query = " SELECT * FROM products WHERE categoryid = 10 "; 
                include './products-layout.php';
            }else if(isset($_POST['shoes'])){
                $query = " SELECT * FROM products WHERE categoryid = 11 "; 
                include './products-layout.php';
            }else if(isset($_POST['trousers'])){
                $query = " SELECT * FROM products WHERE categoryid = 12 "; 
                include './products-layout.php';
            }else if(isset($_POST['glasses'])){
                $query = " SELECT * FROM products WHERE categoryid = 13 "; 
                include './products-layout.php';
            }else if(isset($_POST['bag'])){
                $query = " SELECT * FROM products WHERE categoryid = 14 "; 
                include './products-layout.php';
            }else if(isset($_POST['dress'])){
                $query = " SELECT * FROM products WHERE categoryid = 15 "; 
                include './products-layout.php';
            }else if(isset($_POST['earphone'])){
                $query = " SELECT * FROM products WHERE categoryid = 16 "; 
                include './products-layout.php';
            }else{
                $query = " SELECT * FROM products"; 
                include './products-layout.php';
            }
            ?>
        </table>
    </div>
</body>
</html>





