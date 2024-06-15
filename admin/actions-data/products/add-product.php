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
    <title>Add product</title>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <?php include '../auth-admin.php'; ?>
    <div>
        <h1>Add product</h1>
        <div class="admin-actions">
            <a href="./admin-product.php"><i class="fa-solid fa-angles-left"></i> Products</a>
        </div>

        <form method="POST" action="" class="addoredit" enctype="multipart/form-data" onsubmit="return add_products_validateForm()">
            <table>
                <tr>
                    <td>Product name</td>
                    <td><input type="text" name="productname" id="productname" placeholder="Enter product name"></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td><input type="file" name="image" id="image"></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price" id="price" placeholder="Enter price"></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td class="radios">
                        <input type="radio" name="status" id="hot" value="HOT"><label for="hot">HOT</label>
                        <input type="radio" name="status" id="new" value="NEW"><label for="new">NEW</label>
                    </td>
                </tr>
                <tr>
                    <td>Sales</td>
                    <td><input type="number" name="sales" id="sales" placeholder="%" value="0"></td>
                </tr>
                <tr>
                    <td><input type="date" name="createdate" id="createdate" hidden></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="categoryid" id="category-id">
                            <?php
                            require '../../../config/database.php';
                            require '../auth-role-admin.php';
                            $query = mysqli_query($conn, "SELECT * FROM categories");
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['categoryname']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><input type="text" name="description" id="description" placeholder="Enter description"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button name="add">Completed Add</button></td>
                </tr>
            </table>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productname = $_POST['productname'];
            $sales = $_POST['sales'];
            $price = $_POST['price'];
            $pricesales = $price - (($sales/100)*$price);
            $createdate = $_POST['createdate'];
            $categoryid = $_POST['categoryid'];
            $description = $_POST['description'];
            $status = $_POST['status'];

            $uploadDir = '../assets/images/';
            $imageName = $_FILES['image']['name']; // Tên gốc của ảnh
            $targetPath = $uploadDir . $imageName;

            if (isset($_POST['add'])) {
                $query_add = "INSERT INTO products(`productname`, `image`, `price`, `createdate`, `description`,`categoryid`,`status`,`sales`,`pricesales`)
                                    VALUES('$productname','$targetPath','$price', '$createdate','$description', '$categoryid','$status','$sales','$pricesales')";
                $query = mysqli_query($conn, $query_add);
                if($query) {
                    ?><span style="color: greenyellow;">SUCCESS</span><?php
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