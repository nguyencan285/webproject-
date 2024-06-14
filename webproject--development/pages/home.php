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
    <link rel="stylesheet" href="../assets/css/style-slider.css">
    <link rel="stylesheet" href="../assets/css/style-products.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- CSS -->
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
    <title>Bello</title>
</head>

<body>
    <div class="container">
        <!-- --------------- HEADER -----------------    -->
        <?php include '../layout/header-component.php'; ?>
        <!-- --------------- HEADER -----------------    -->
        <!-- --------------- SLIDER -----------------    -->
        <?php include '../layout/slider-component.php'; ?>
        <!-- --------------- SLIDER -----------------    -->
        <main>
            <div class="filter-products">
                <form method="POST" action="">
                    <button name="best-sellers">Best Sellers</button>
                    <button name="new-products">New Products</button>
                    <button name="sales-products">Sales Products</button>
                </form>
            </div>
            <div class="all-products">
                <?php
                require '../config/database.php';
                if($_SERVER['REQUEST_METHOD']==='POST'){
                    if(isset($_POST['best-sellers'])){
                        $allproducts = mysqli_query($conn, "SELECT * FROM products WHERE status = 'HOT' ");
                        ?>
                            <script>
                                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Complete',
                                showConfirmButton: false,
                                timer: 1500
                                });
                            </script>
                        <?php
                        include '../layout/products-component.php';
                        include '../handles/no-products.php';
                    }
                    if(isset($_POST['new-products'])){
                        $allproducts = mysqli_query($conn, "SELECT * FROM products WHERE status = 'NEW' ");
                        include '../layout/products-component.php';
                        include '../handles/no-products.php';
                    }
                    if(isset($_POST['sales-products'])){
                        $allproducts = mysqli_query($conn, "SELECT * FROM products WHERE sales > 1 ");
                        include '../layout/products-component.php';
                        include '../handles/no-products.php';
                    }
                }else{
                    $allproducts = mysqli_query($conn, "SELECT * FROM products limit 14");
                    include '../layout/products-component.php';
                    include '../handles/no-products.php';
                    ?>
                    <form hidden method="POST" action="">
                    <button id="load-more" name="load-more"></button>
                    </form>
                    <div class="load-more-all"><label for="load-more">Load More</label></div>
                    <?php
                }
                if(isset($_POST['load-more'])){
                    $allproducts = mysqli_query($conn, "SELECT * FROM products limit 99 ");
                    include '../handles/no-products.php';
                    include '../layout/products-component.php';
                }
                ?>
            </div>
            <div class="load-more">
                <a href="./shop.php">All Products</a>
            </div>
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
