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
    <title>Bello - Blogs</title>
</head>

<body>
    <div class="container">
        <!-- --------------- HEADER -----------------    -->
        <?php include '../layout/header-component.php'; ?>
        <!-- --------------- HEADER -----------------    -->
        <!-- --------------- SLIDER -----------------    -->
        <span class="title-page-now"><i class="fa-solid fa-blog"></i> Blogs</span>
        <!-- --------------- SLIDER -----------------    -->
        <main>
            <div id="blogs">
                <div class="all-blogs">
                    <?php
                    require '../config/database.php';
                    if($_SERVER['REQUEST_METHOD']==='POST'){
                        if(isset($_POST['hot-blogs'])){
                            $allblogs = mysqli_query($conn, "SELECT * FROM blogs WHERE categoryblog = 'Hot' ");
                            include '../layout/blogs-component.php';
                            if(mysqli_num_rows($allblogs)==0){
                                ?><span class="mess_no">No blogs.</span><?php
                            }
                        }
                        if(isset($_POST['news-blogs'])){
                            $allblogs = mysqli_query($conn, "SELECT * FROM blogs WHERE categoryblog = 'New' ");
                            include '../layout/blogs-component.php';
                            if(mysqli_num_rows($allblogs)==0){
                                ?><span class="mess_no">No blogs.</span><?php
                            }
                        }
                        if(isset($_POST['trend-blogs'])){
                            $allblogs = mysqli_query($conn, "SELECT * FROM blogs WHERE categoryblog = 'Trending' ");
                            include '../layout/blogs-component.php';
                            if(mysqli_num_rows($allblogs)==0){
                                ?><span class="mess_no">No blogs.</span><?php
                            }
                        }
                        if(isset($_POST['event-blogs'])){
                            $allblogs = mysqli_query($conn, "SELECT * FROM blogs WHERE categoryblog = 'Event' ");
                            include '../layout/blogs-component.php';
                            if(mysqli_num_rows($allblogs)==0){
                                ?><span class="mess_no">No blogs.</span><?php
                            }
                        }
                        if(isset($_POST['design-blogs'])){
                            $allblogs = mysqli_query($conn, "SELECT * FROM blogs WHERE categoryblog = 'Design' ");
                            include '../layout/blogs-component.php';
                            if(mysqli_num_rows($allblogs)==0){
                                ?><span class="mess_no">No blogs.</span><?php
                            }
                        }
                        if(isset($_POST['color-blogs'])){
                            $allblogs = mysqli_query($conn, "SELECT * FROM blogs WHERE categoryblog = 'Color' ");
                            include '../layout/blogs-component.php';
                            if(mysqli_num_rows($allblogs)==0){
                                ?><span class="mess_no">No blogs.</span><?php
                            }
                        }
                    }else{
                        $allblogs = mysqli_query($conn, "SELECT * FROM blogs ");
                        include '../layout/blogs-component.php';
                    }
                    ?>
                </div>
                <div id="filter-blogs">
                    <div class="search-blogs">
                        <form method="POST" action="">
                            <input type="text" placeholder="Search ...">
                            <button name="search-blogs"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                    <form class="filter-blogs" method="POST" action="">
                        <button name="hot-blogs" class="hot-blogs">Hot</button>
                        <button name="news-blogs" class="news-blogs">News</button>
                        <button name="trend-blogs" class="trend-blogs">Trend</button>
                        <button name="event-blogs" class="event-blogs">Event</button>
                        <button name="design-blogs" class="design-blogs">Design</button>
                        <button name="color-blogs" class="color-blogs">Color combination</button>
                    </form>
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