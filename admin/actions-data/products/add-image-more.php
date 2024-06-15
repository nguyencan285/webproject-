<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/management.css">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/128/2206/2206368.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <title>Add Image</title>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <?php include '../auth-admin.php'; ?>
    <div>
        <h1>Add Image</h1>
        <div class="admin-actions">
            <a href="./admin-product.php"><i class="fa-solid fa-angles-left"></i> Image</a>
        </div>

        <form method="POST" action="" class="addoredit" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Image more 1</td>
                    <td><input type="file" name="imagemore1" id="image"></td>
                </tr>
                <tr>
                    <td>Image more 2</td>
                    <td><input type="file" name="imagemore2" id="image"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button name="add">Completed Add</button></td>
                </tr>
            </table>
        </form>

        <?php
        require '../../../config/database.php';
        require '../auth-role-admin.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageid = $_GET['id'];

            $uploadDir = '../assets/images/';
            $imageName1 = $_FILES['imagemore1']['name']; // Tên gốc của ảnh
            $imageName2 = $_FILES['imagemore2']['name']; // Tên gốc của ảnh
            $targetPathImage1 = $uploadDir . $imageName1;
            $targetPathImage2 = $uploadDir . $imageName2;

            if (isset($_POST['add'])) {
                $query_add = "INSERT INTO moreimage(`imageid`, `image1`, `image2`)
                                    VALUES('$imageid','$targetPathImage1','$targetPathImage2')";
                $query = mysqli_query($conn, $query_add);
                if ($query) {
                    header('Location: ./admin-product.php?');
                    exit();
                } else {
                    echo "Không thành công";
                }
            }
        }
        ?>

    </div>
    <script src="../../../assets/js/admin-products.js"></script>
</body>

</html>