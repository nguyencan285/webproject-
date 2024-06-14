<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins:wght@300&family=Rubik&display=swap"
        rel="stylesheet">
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
    <link rel="stylesheet" href="../assets/css/checkout.css">
    <link rel="stylesheet" href="../assets/css/myprofile.css">
    <!-- CSS -->
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
    <title>Bello - Checkout</title>
</head>

<body>
    <div class="container">
        <!-- --------------- HEADER -----------------    -->
        <?php include '../layout/header-component.php'; ?>
        <!-- --------------- HEADER -----------------    -->
        <main>
            <div class="indent-checkout-cart">
                <h2>CHECKOUT MY CART</h2>
            </div>
            <?php
            require '../config/database.php';
            require '../auth/auth-role-user.php';
            $information_user = mysqli_query($conn, "SELECT * FROM information_user WHERE userid = '$userid' ");
            $infor = mysqli_fetch_assoc($information_user);
            ?>
            <!-- INFORMATION -->
            <div class="information-pay">
                <div class="information-profile">
                    <div>
                        <span>Full Name</span>
                        <input type="text" value="<?php echo $infor['fullname'];?>" disabled>
                    </div>
                    <div>
                        <span>Number Phone</span>
                        <input type="text" value="<?php echo $infor['numberphone'];?>" disabled>
                    </div>
                    <div>
                        <span>Country</span>
                        <input type="text" value="<?php echo $infor['country'];?>" disabled>
                    </div>
                    <div>
                        <span>City</span>
                        <input type="text" value="<?php echo $infor['city'];?>" disabled>
                    </div>
                    <div>
                        <span>Address</span>
                        <input type="text" value="<?php echo $infor['address'];?>" disabled>
                    </div>
                    <div>
                        <span>Type Pay Cart</span>
                        <input type="text" value="<?php echo $infor['typepaycard'];?>" disabled>
                    </div>
                    <div>
                        <span>Card Number</span>
                        <input type="text" value="<?php echo $infor['cardnumber'];?>" disabled>
                    </div>
                    <div>
                        <span>Name Owner</span>
                        <input type="text" value="<?php echo $infor['nameowner'];?>" disabled>
                    </div>
                </div>
                <button><a href="./editprofile.php">Edit Information</a></button>
            </div>
            <!-- INFORMATION -->
            <div class="all-cart">
                <?php
                $total = 0;
                $cart_items = []; // n sản phẩm
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $product_id => $product) { // Duyệt sản phẩm
                        $cart_items[] = [
                            'name' => $product['name'],
                            'image' => $product['image'],
                            'price' => $product['price'],
                            'quantity' => $product['quantity']
                        ];

                        // Dữ liệu cho box cart hiển thị
                        $product_name = $product['name'];
                        $product_image = $product['image'];
                        $product_price = $product['price'];
                        $product_quantity = $product['quantity'];
                        $orderdate = date('Y-m-d H:i:s');
                        $subtotal = (int) $product_price * (int) $product_quantity;
                        $total += $subtotal;
                        // Dữ liệu cho box cart hiển thị

                        ?>
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
                                <button hidden name="checkout" class="checkout" id="checkout"></button>
                            </div>
                        </form>
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
                    <!-- CHECKING -->
                    <?php
                    // CHECKINGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (isset($_POST['checkout']) && !empty($userid) ) {
                            // $cart_items là mảng từng sản phẩm đã duyệt bên trên
                            foreach($cart_items as $item){
                                $product_name = $item['name'];
                                $product_image = $item['image'];
                                $product_price = $item['price'];
                                $product_quantity = $item['quantity'];
                                $orderdate = date('Y-m-d H:i:s');
                                $query_checkout = "INSERT INTO orders(`orderdate`,`userid`,`status`,`productname`,`image`,`price`,`quantity`)
                                                        VALUES ('$orderdate','$userid','Sent','$product_name','$product_image','$product_price','$product_quantity')";
                                $checkout = mysqli_query($conn, $query_checkout);
                            }
                            if($checkout){
                                unset($_SESSION['cart']);// xóa session
                                ?>
                                <script>
                                    Swal.fire({
                                        title: 'Successful',
                                        text: 'Thank you for trusting us. The order will be delivered as soon as possible',
                                        icon: 'success',
                                        showCancelButton: true,
                                        confirmButtonText: 'Continue shopping',
                                        cancelButtonText: 'Order tracking'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = './shop.php';
                                        }else{
                                            window.location.href = './order.php';
                                        }
                                    });
                                </script>
                                <?php
                            }
                        }
                    }
                    // CHECKINGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
                    ?>
                        <div class="auth"><input type="checkbox" name="auth-checkout" id="auth-checkout"><label for="auth-checkout"><strong>Confirm the address. I accept all terms of the shop</strong></label></div>
                        <div class="go-checkout">
                            <label id="checkout" onclick="return validateCheckout()" for="checkout" class="checkout" style="font-weight: bold;">
                                <span><?php echo (isset($total) ? '$'.$total : '$0') ?></span><span> | Checkout</span>
                            </label>
                        </div>
                        <div class="back"><button><a href="./cart.php"><i class="fa-solid fa-angles-left"></i> Back to cart</a></button></div>
                    <?php
                }else{ // IF NO PRODUCT
                    ?>
                    <div class="empty-cart"><span>Your shopping cart is empty</span></div>
                    <div class="back"><button><a href="./shop.php"><i class="fa-solid fa-angles-left"></i> Continue shopping</a></button></div>
                    <?php
                }
                ?>
            </div>
        </main>
        <!-- --------------- FOOTER -----------------    -->
        <?php include '../layout/footer-component.php'; ?>
        <!-- --------------- FOOTER -----------------    -->
    </div>
    <!-- --------------- JAVASCRIPT -----------------    -->
    <script src="../assets/js/checkout.js"></script>
    <script src="../assets/js/index.js"></script>
    <!-- --------------- JAVASCRIPT -----------------    -->
</body>

</html>