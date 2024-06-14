<?php
    require '../config/database.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM blogs WHERE id = ? ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $run = mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $content = mysqli_fetch_assoc($result);
?>
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
    <link rel="stylesheet" href="../assets/css/blogs.css">
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
    <title><?php echo $content['title']; ?></title>
    <style>
        .content p {
            display: block;
            line-height: 25px;
            font-size: 15px;
        }

        .content img {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- --------------- HEADER -----------------    -->
        <?php include '../layout/header-component.php'; ?>
        <!-- --------------- HEADER -----------------    -->
        <!-- --------------- SLIDER -----------------    -->
        <!-- --------------- SLIDER -----------------    -->
        <main>
            <h1 style="text-align: center;padding: 30px 0px 10px 0px;color:black;">
                <?php echo $content['title']; ?> <i class="fa-solid fa-bookmark" style="color: #ffdd00;"></i>
            </h1>
            <div id="content">
                <div class="content">
                    <?php echo htmlspecialchars_decode($content['content']); ?>
                </div>
                <span style="font-weight: bold;font-size: 16px;display:block;padding:10px 0px;">Related posts</span>
                <div class="all-blogs">
                    <?php
                    require '../config/database.php';
                    $allblogs = mysqli_query($conn, "SELECT * FROM blogs ");
                    include '../layout/blogs-component.php';
                    ?>
                </div>
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