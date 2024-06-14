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
                <h2>MY ORDER</h2>
            </div>
            <div class="filter-products">
                <form method="POST" action="">
                    <button name="processing">Processing</button>
                    <button name="completed">Completed</button>
                </form>
            </div>
            <?php
            require '../config/database.php';
            require '../auth/auth-role-user.php';
            if (isset($_POST['completed'])) {
                $order_completed = mysqli_query($conn, " SELECT * FROM orders WHERE userid = '$userid' AND status = 'Completed' ORDER BY orderdate DESC");
                ?>
                    <div class="all-cart">
                        <?php
                        if(mysqli_num_rows($order_completed)>0){
                            while($row_completed = mysqli_fetch_assoc($order_completed)){
                                ?>
                                <div id="cart">
                                    <div class="cart-data">
                                        <img width="100px" src="<?php echo $row_completed['image'];?>" alt="">
                                        <span><?php echo $row_completed['productname'];?></span>
                                    </div>
                                    <div class="cart-quanlity">
                                        <span>Quantity: <?php echo $row_completed['quantity'];?></span>
                                        <span>$ <?php echo $row_completed['price'];?></span>
                                        <span style="font-weight: bold; color: green;"><?php echo $row_completed['status']; ?></span>
                                    </div>
                                    <div class="cart-delete">
                                        <span><i style="font-size: 22px; color: green;" class="fa-solid fa-check-double"></i></span>
                                    </div>
                                </div>
                            <?php
                            }
                        }else {
                            ?><div class="empty-cart"><span>Your order is empty</span></div><?php
                        }
                        ?>
                    </div>
                <?php
            }else{
                ?>
                    <div class="all-cart">
                        <?php
                        require '../config/database.php';
                        $order_history = mysqli_query($conn, " SELECT * FROM orders WHERE userid = '$userid' AND (status = 'Sent' OR status = 'Processing' OR status = 'Delivering')  ORDER BY orderdate DESC");
                        if(mysqli_num_rows($order_history)>0){
                            while($row_history = mysqli_fetch_assoc($order_history)){
                                ?>
                                    <div id="cart">
                                        <div class="cart-data">
                                            <img width="100px" src="<?php echo $row_history['image'];?>" alt="">
                                            <span><?php echo $row_history['productname'];?></span>
                                        </div>
                                        <div class="cart-quanlity">
                                            <span>Quantity: <?php echo $row_history['quantity'];?></span>
                                            <span>$ <?php echo $row_history['price'];?></span>
                                            <?php
                                            if($row_history['status']=="Processing"){
                                                ?><span style="font-weight: bold; color: green;">Processing</span><?php
                                            }else if($row_history['status']=="Delivering"){
                                                ?><span style="font-weight: bold; color: green;">Delivering</span><?php
                                            }else{
                                                ?><span style="font-weight: bold; color: gray;"><?php echo $row_history['status'];?></span><?php
                                            }
                                            ?>
                                        </div>
                                        <div class="cart-delete">
                                            <?php
                                            if($row_history['status']=="Processing"){
                                                ?><i style="font-size: 22px; color: green;" class="fa-solid fa-check"></i><?php
                                            }else if($row_history['status']=="Delivering"){
                                                ?><i style="font-size: 22px; color: green;" class="fa-solid fa-truck-fast"></i><?php
                                            }else{
                                                ?>
                                                <div style="color: gray;font-weight: bold;">
                                                    <form method="POST" action="">
                                                        <input name="id_cancel" hidden type="text" value="<?php echo $row_history['id'];?>">
                                                        <button name="cancel"><i class="fa-solid fa-square-xmark" style="color: #ff1100;"></i></button>
                                                    </form>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                            }
                        }else {
                            ?><div class="empty-cart"><span>Your shopping cart is empty</span></div><?php
                        }
                        // HỦY SẢN PHẨM
                        if($_SERVER['REQUEST_METHOD']==='POST'){
                            if(isset($_POST['cancel'])){
                                $id_cancel = $_POST['id_cancel'];
                                $cancel = mysqli_query($conn, "DELETE FROM orders WHERE id = '$id_cancel' ");
                                if($cancel){
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
                                }else{
                                    ?>
                                        <script>
                                            Swal.fire({
                                            position: 'top-end',
                                            icon: 'error',
                                            title: 'Oops',
                                            showConfirmButton: false,
                                            timer: 1500
                                            });
                                        </script>
                                    <?php
                                }
                            }
                        }
                        // HỦY SẢN PHẨM
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