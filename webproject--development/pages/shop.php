<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins:wght@300&family=Rubik&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon/favicon.png" type="image/x-icon">
    <!-- FONT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style-header.css">
    <link rel="stylesheet" href="../assets/css/style-footer.css">
    <link rel="stylesheet" href="../assets/css/shop.css">
    <link rel="stylesheet" href="../assets/css/style-slider.css">
    <link rel="stylesheet" href="../assets/css/style-products.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- CSS -->
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
    <title>Bello - Shop</title>
</head>

<body>
    <div class="container">
        <!-- --------------- HEADER -----------------    -->
        <?php include '../layout/header-component.php'; ?>
        <!-- --------------- HEADER -----------------    -->
        <!-- --------------- SLIDER -----------------    -->
        <span class="title-page-now"><i class="fa-brands fa-shopify"></i> Shop</span>
        <!-- --------------- SLIDER -----------------    -->
        <main>
            <div class="shop-filter-products">
                <form method="POST" action="">
                    <div class="status-product">
                        <button name="best-sellers">Best Sellers</button>
                        <button name="new-products">New Products</button>
                        <button name="sales-products">Sales Products</button>
                    </div>
                    <div class="select-product-to-infor">
                        <div class="select-product">
                            <select name="category" id="">
                                <option value="all">All</option>
                                <?php
                                require '../config/database.php';
                                $query = mysqli_query($conn, "SELECT * FROM categories");
                                while($row_category = mysqli_fetch_assoc($query)){
                                    ?>
                                    <option value="<?php echo $row_category['id'];?>"><?php echo $row_category['categoryname'];?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select name="price" id="">
                                <option value="9999"> Price</option>
                                <option value="1000"> < $1000</option>
                                <option value="900"> < $900</option>
                                <option value="800"> < $800</option>
                                <option value="700"> < $700</option>
                                <option value="600"> < $600</option>
                                <option value="500"> < $500</option>
                                <option value="400"> < $400</option>
                                <option value="300"> < $300</option>
                                <option value="200"> < $200</option>
                                <option value="100"> < $100</option>
                            </select>
                            <button name="select-product"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                        <div class="search-product">
                            <input type="text" name="infor-search" placeholder="Enter shirt name">
                            <button name="search-product"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        <!-- --------------- PRODUCTS -----------------    -->
        <div class="all-products">
                <?php
                if($_SERVER['REQUEST_METHOD']==='POST'){
                    if(isset($_POST['best-sellers'])){
                        $allproducts = mysqli_query($conn, "SELECT * FROM products WHERE status = 'HOT' ");
                        include '../layout/products-shop-component.php';
                        include '../handles/no-products.php';
                    }
                    if(isset($_POST['new-products'])){
                        $allproducts = mysqli_query($conn, "SELECT * FROM products WHERE status = 'NEW' ");
                        include '../layout/products-shop-component.php';
                        include '../handles/no-products.php';
                    }
                    if(isset($_POST['sales-products'])){
                        $allproducts = mysqli_query($conn, "SELECT * FROM products WHERE sales > 1 ");
                        include '../layout/products-shop-component.php';
                        include '../handles/no-products.php';
                    }
                    if(isset($_POST['select-product'])){
                        $category = $_POST['category'];
                        $price = $_POST['price'];
                        $allproducts = mysqli_query($conn, "SELECT * FROM products WHERE price < '$price' AND categoryid = '$category' OR '$category' = 'all' AND price < '$price' ");
                        include '../layout/products-shop-component.php';
                        include '../handles/no-products.php';
                    }
                    if(isset($_POST['search-product'])){
                        $infor_search = '%' . $_POST['infor-search'] . '%'; // Giá trị
                        $infor_search = mysqli_real_escape_string($conn, $infor_search); // Tránh SQL Injection
                    
                        $query = "SELECT * FROM products WHERE productname LIKE ?";
                        $stmt = mysqli_prepare($conn, $query); // Chuẩn bị truy vấn
                    
                        if ($stmt) {
                            mysqli_stmt_bind_param($stmt, "s", $infor_search); // Ràng buộc giá trị vào truy vấn
                            mysqli_stmt_execute($stmt); // Thực thì câu truy vấn đã chuẩn bị trước
                            $allproducts = mysqli_stmt_get_result($stmt); // Nhận kết quả từ truy vấn mã chuẩn bị
                            include '../layout/products-shop-component.php';
                            if (mysqli_num_rows($allproducts) == 0) {
                                ?><span style="color: red;">No product</span><?php
                            }
                            mysqli_stmt_close($stmt);
                        }
                        mysqli_close($conn);
                    }
                    
                }else{
                    $allproducts = mysqli_query($conn, "SELECT * FROM products limit 999");
                    include '../layout/products-shop-component.php';
                    include '../handles/no-products.php';
                }
                ?>
            </div>
        <!-- --------------- PRODUCTS -----------------    -->
        </main>
        <!-- --------------- FOOTER -----------------    -->
        <?php include '../layout/footer-component.php'; ?>
        <!-- --------------- FOOTER -----------------    -->
    </div>
    <!-- --------------- JAVASCRIPT -----------------    -->
    <script src="../assets/js/index.js"></script>
    <!-- --------------- JAVASCRIPT -----------------    -->
</body>
</html>

