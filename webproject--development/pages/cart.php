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
    <link rel="stylesheet" href="../assets/css/cart.css">
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
    <title>Bello - Cart</title>
</head>

<body>
    <div class="container">
        <!-- --------------- HEADER -----------------    -->
        <?php include '../layout/header-component.php'; ?>
        <!-- --------------- HEADER -----------------    -->
        <main>
            <div class="indent-checkout-cart">
                <h2>MY CART</h2>
            </div>
            <div class="filter-products">
                <form method="POST" action="">
                    <button name="shopping-cart">Shopping Cart</button>
                    <button name="wish-list">Wish List</button>
                </form>
            </div>
            <?php
            require '../config/database.php';
            if (isset($_POST['wish-list'])) {
            ?>
                <form onclick="return false" class="data-cart" method="POST" action="">
                    <h1 style="text-align: center;padding-bottom: 20px;color:green;">UPDATING . . .</h1>
                    <div class="all-cart">
                        <div id="cart">
                            <div class="cart-data">
                                <img width="100px" src="../assets/images/product1.jpg" alt="">
                                <span>Your Wish List</span>
                            </div>
                            <div class="cart-quantity">
                                <span>Quantity: 9999</span>
                                <span>$999999</span>
                            </div>
                            <div class="cart-delete">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <button name="cart-delete"><i class="fa-solid fa-rectangle-xmark"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="go-checkout"><button name="checkout" class="checkout" style="font-weight: bold;"><span>$9999999</span> | Checkout</button></div>
                </form>
            <?php
            }else{
                ?>
                    <div class="all-cart">
                        <?php
                        $total = 0;
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $product_id => $product) {
                                $product_name = $product['name'];
                                $product_image = $product['image'];
                                $product_price = $product['price'];
                                $product_quantity = $product['quantity'];
                                $subtotal = (int)$product_price * (int)$product_quantity;
                                $total += $subtotal;
        
                                ?>
                                <!-- Sản phẩm trong giỏ hàng -->
                                <form class="data-cart" method="POST" action="">
                                    <div id="cart">
                                        <div class="cart-data">
                                            <img width="100px" src="<?php echo $product_image; ?>" alt="">
                                            <span><?php echo $product_name; ?></span>
                                        </div>
                                        <div class="cart-quantity">
                                            <span>Quantity: <?php echo $product_quantity; ?></span>
                                            <span><?php echo '$' . $product_price; ?></span>
                                        </div>
                                        <div class="cart-delete">
                                            <input hidden name="product_id" value="<?php echo $product_id; ?>">
                                            <button name="cart-delete"><i class="fa-solid fa-rectangle-xmark"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Sản phẩm trong giỏ hàng -->
                                <?php
                                    // DELETEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
                                    if (isset($_POST['cart-delete']) && isset($_POST['product_id'])) {
                                        $product_id_to_delete = $_POST['product_id'];
                                        if (isset($_SESSION['cart'][$product_id_to_delete])) {
                                            unset($_SESSION['cart'][$product_id_to_delete]);
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
                                        }
                                    }
                                    // DELETEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
                            }
                            ?>
                                <div class="go-checkout">
                                    <a style="font-weight: bold;" href="./checkout.php"><span><?php echo '$'.$total; ?></span> | Checkout</a>
                                    <a href="./shop.php" style="background-color: #f1f2f4;color:black;"><i class="fa-solid fa-angles-left"></i> Back to shop</a>
                                </div>
                            <?php
                        } else {
                            ?><div class="empty-cart"><span>Your shopping cart is empty</span></div><?php
                        }
                        ?>
                    </div>
                <?php
            }
            ?>
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