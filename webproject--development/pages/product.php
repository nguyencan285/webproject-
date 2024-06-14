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
    <link rel="stylesheet" href="../assets/css/product.css">
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
    <title>Bello - Product</title>
</head>

<body>
    <div class="container">
        <!-- --------------- HEADER -----------------    -->
        <?php include '../layout/header-component.php'; ?>
        <!-- --------------- HEADER -----------------    -->
        <main>
            <?php
            require '../config/database.php';
                $id = $_GET['id'];
                $query_infor_product = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id' ");
                $rows = mysqli_fetch_assoc($query_infor_product);
                $categoryid = $rows['categoryid'];

                $query_infor_category = mysqli_query($conn, "SELECT categoryname FROM categories WHERE id = '$categoryid' ");
                $rowscategory = mysqli_fetch_assoc($query_infor_category);

                $query_infor_moreimage = mysqli_query($conn, "SELECT * FROM moreimage WHERE imageid = '$id' ");
                $rowsmoreimage = mysqli_fetch_assoc($query_infor_moreimage);
            ?>
            <div class="information-product-now">
                <div class="image-product-now">
                    <img id="image_display" src="<?php echo $rows['image']; ?>" alt="New Style">
                </div>
                <div class="infor-product-now">
                    <span class="infor-name-product"><?php echo $rows['productname'];?></span>
                    <span class="description"><?php echo $rows['description'];?></span>
                    <div class="evaluate"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <span class="customer-reviews">(+99 customer reviews)</span>
                    <span class="infor-price"><?php echo '$'.$rows['price'];?></span>
                    <div class="select-actions">
                        <div class="up-quantity">
                            <button onclick="changeQuantity(-1)"><i class="fa-solid fa-minus"></i></button>
                            <input type="number" id="infor-quantity" value="1" min="1">
                            <button onclick="changeQuantity(1)"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <button class="add-to-cart"><label for="add-to-cart"><i class="fa-solid fa-cart-plus"></i> Add to cart</label></button>
                        <button class="add-to-love"><label for="add-to-love"><i class="fa-regular fa-heart"></i></label></button>
                    </div>
                    <form hidden method="POST" action="">
                        <input type="hidden" name="product_id" value="<?php echo $rows['id'];?>">
                        <input type="hidden" name="product_name" value="<?php echo $rows['productname'];?>">
                        <input type="hidden" name="product_image" value="<?php echo $rows['image'];?>">
                        <input type="hidden" name="product_quantity" value="1">
                        <input type="hidden" name="product_price" value="<?php echo $rows['pricesales'];?>">
                        <button name="adds-to-cart" id="add-to-cart"></button>
                        <button name="add-to-love" id="add-to-love"></button>
                    </form>
                    <div class="next-image">
                        <img id="image-more1" onmouseover="next_image(1)" src="<?php echo $rows['image']; ?>" alt="New Style">
                        <img id="image-more2" onmouseover="next_image(2)" src="<?php echo $rowsmoreimage['image1'];?>" alt="New Style">
                        <img id="image-more3" onmouseover="next_image(3)" src="<?php echo $rowsmoreimage['image2'];?>" alt="New Style">
                    </div>
                    <span class="infor-category">CATEGORY: <?php echo $rowscategory['categoryname'];?></span>
                </div>
            </div>
        <!-- --------------- PRODUCTS -----------------    -->
        <div class="all-products">
            <?php
                if(isset($_POST['load-more'])){
                    $allproducts = mysqli_query($conn, "SELECT * FROM products WHERE categoryid = '$categoryid'  limit 99");
                    include '../handles/no-products.php';
                    include '../layout/products-component.php';
                }else{
                    $allproducts = mysqli_query($conn, "SELECT * FROM products WHERE categoryid = '$categoryid'  limit 9"); 
                    include '../handles/no-products.php';
                    include '../layout/products-component.php';
                    ?>
                    <form hidden method="POST" action="">
                        <button id="load-more" name="load-more"></button>
                    </form>
                    <div class="load-more-all"><label for="load-more">Load More</label></div>
                    <?php
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
    <script src="../assets/js/product.js"></script>
    <!-- --------------- JAVASCRIPT -----------------    -->
</body>

</html>
<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['adds-to-cart'])){
        if(!empty($_POST['product_id']) && !empty($_POST['product_image']) && !empty($_POST['product_name']) && !empty($_POST['product_price']) && !empty($_POST['product_quantity']) ){
            if (isset($_POST['product_id'])) {
                $product_id = $_POST['product_id'];
                $product_image = $_POST['product_image'];
                $product_name = $_POST['product_name'];
                $product_price = $_POST['product_price'];
                $product_quantity = $_POST['product_quantity'];
            
                // Nếu đã có thì chỉ tăng số lượng
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['quantity'] += 1;
                    ?>
                        <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        </script>
                    <?php
                } else {
                    // Nếu chưa có thì thêm mới
                    $_SESSION['cart'][$product_id] = [
                        'name' => $product_name,
                        'image' => $product_image,
                        'price' => $product_price,
                        'quantity' => $product_quantity
                    ];
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        </script>
                    <?php
                }
            }
        }else{
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops',
                    showConfirmButton: false,
                    timer: 3000
                });
            </script>
        <?php
        }
    }
}
?>