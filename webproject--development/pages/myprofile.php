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
    <link rel="stylesheet" href="../assets/css/myprofile.css">
    <!-- CSS -->
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
    <title>My Profile</title>
</head>

<body>
    <div class="container">
        <!-- --------------- HEADER -----------------    -->
        <?php include '../layout/header-component.php'; ?>
        <!-- --------------- HEADER -----------------    -->
        <!-- --------------- SLIDER -----------------    -->
        <!-- --------------- SLIDER -----------------    -->
        <main>
            <h1 style="text-align:center;padding:10px 0px;">My Profile</h1>
            <?php
            require '../config/database.php';
            require '../auth/auth-role-user.php';
            $avatar = mysqli_query($conn, "SELECT avatar FROM user WHERE id = '$userid' ");
            $getavatar = mysqli_fetch_assoc($avatar);
            $information_user = mysqli_query($conn, "SELECT * FROM information_user WHERE userid = '$userid' ");
            $infor = mysqli_fetch_assoc($information_user);
            ?>
            <div class="my-profile">
                <div class="image-profile">
                    <img src="<?php echo $getavatar['avatar']?>" alt="">
                </div>
                <div class="information-profile">
                    <div>
                        <span>Full Name</span>
                        <input class="default-infor" type="text" value="<?php echo $infor['fullname'];?>" disabled>
                    </div>
                    <div>
                        <span>Number Phone</span>
                        <input class="default-infor" type="text" value="<?php echo $infor['numberphone'];?>" disabled>
                    </div>
                    <div>
                        <span>Country</span>
                        <input class="default-infor" type="text" value="<?php echo $infor['country'];?>" disabled>
                    </div>
                    <div>
                        <span>City</span>
                        <input class="default-infor" type="text" value="<?php echo $infor['city'];?>" disabled>
                    </div>
                    <div>
                        <span>Address</span>
                        <input class="default-infor" type="text" value="<?php echo $infor['address'];?>" disabled>
                    </div>
                    <div>
                        <span>Type Pay Card</span>
                        <input class="default-infor" type="text" value="<?php echo $infor['typepaycard'];?>" disabled>
                    </div>
                    <div>
                        <span>Card Number</span>
                        <input class="default-infor" type="text" value="<?php echo $infor['cardnumber'];?>" disabled>
                    </div>
                    <div>
                        <span>Name Owner</span>
                        <input class="default-infor" type="text" value="<?php echo $infor['nameowner'];?>" disabled>
                    </div>
                    <div class="action-profile">
                        <span style="opacity: 0;"> .</span>
                        <button name="edit-profile"><a href="./editprofile.php">Edit My Profile</a></button>
                    </div>
                </div>
            </div>
            <div class="go-order"><a href="./order.php"><i class="fa-solid fa-bag-shopping"></i> My Orders</a></div>
        <!-- --------------- COMMENT -----------------    -->
        <!-- --------------- COMMENT -----------------    -->
        </main>
        <!-- --------------- FOOTER -----------------    -->
        <?php include '../layout/footer-component.php'; ?>
        <!-- --------------- FOOTER -----------------    -->
    </div>
    <!-- --------------- JAVASCRIPT -----------------    -->
    <!-- <script src="../assets/js/index.js"></script> -->
    <!-- --------------- JAVASCRIPT -----------------    -->
</body>

</html>