<?php 
session_start();
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cartKeys = array_keys($_SESSION['cart']);
    $quantity = 0;
    while(!empty($cartKeys)) {
        $product_id = array_shift($cartKeys);
        $product = $_SESSION['cart'][$product_id];
        $quantity++;
    }
}
?>
<header>
    <nav>
        <ul>
            <li><a class="no-active-page" href="./shop.php"><i class="fa-brands fa-shopify"></i> SHOP</a></li>
            <li><a class="no-active-page" href="./blogs.php"><i class="fa-solid fa-blog"></i> BLOG</a></li>
            <li><a class="no-active-page" href="./contact.php"><i class="fa-regular fa-id-card"></i> CONTACT</a></li>
            <li><a class="no-active-page" href="./reviews.php"><i class="fa-regular fa-eye"></i> REVIEWS</a></li>
        </ul>
    </nav>
    <section class="menu-mobile">
        <input style="display: none;" type="checkbox" name="" id="check-menu-mobile">
        <label for="check-menu-mobile"><img width="20px" src="../assets/images/menu-bar.png" alt=""></label>
        <label class="close" for="check-menu-mobile"><img width="40px" src="../assets/images/close.png" alt=""></label>
        <div class="menu">
            <a href="./home.php"><img width="100px" src="../assets/images/logo.png" alt=""></a>
            <a href="./myprofile.php"><i class="fa-regular fa-address-card"></i> MY PROFILE</a>
            <a href="./order.php"><i class="fa-solid fa-bag-shopping"></i> ORDER</a>
            <a href="./shop.php"><i class="fa-brands fa-shopify"></i> SHOP</a>
            <a href="./blogs.php"><i class="fa-solid fa-blog"></i> BLOG</a>
            <a href="./contact.php"><i class="fa-regular fa-id-card"></i> CONTACT</a>
            <a href="./reviews.php"><i class="fa-regular fa-eye"></i> REVIEWS</a>
            <a href="./cart.php"><i class="fa-solid fa-cart-shopping"></i> CART</a>
            <a href="../auth/logout.php"><i class="fa-regular fa-user"></i> LOGOUT</a>
        </div>
    </section>
    <div class="logo">
        <a href="../pages/home.php"><img width="120px" src="../assets/images/logo.png" alt=""></a>
    </div>
    <div class="user-actions">
        <?php
            if(isset($_SESSION['user'])){
                ?><a href="../pages/myprofile.php"><img width="20px" src="../assets/images/user-ic.png" alt=""></a><?php
                ?><a class="icon-profile" href="../auth/logout.php"><img width="20px" src="../assets/images/ic-logout.png" alt=""></a><?php
            }else{
                ?><a href="../auth/login.php"><img width="20px" src="../assets/images/user-ic.png" alt=""></a><?php
            }
        ?>
        <div class="icon-cart">
            <a href="./cart.php"><img width="20px" src="../assets/images/ic-cart.png" alt=""></a>
            <a class="quanlity-cart" href="./cart.php"><?php echo isset($quantity) ? $quantity : 0 ?></a>
        </div>
    </div>
</header>

