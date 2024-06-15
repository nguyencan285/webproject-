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
    <title>Edit product</title>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <?php include '../auth-admin.php'; ?>
    <div>
        <h1>Edit product</h1>
        <div class="admin-actions">
            <a href="./admin-product.php"><i class="fa-solid fa-angles-left"></i> Product</a>
        </div>

        <form method="POST" action="" class="addoredit" enctype="multipart/form-data" onsubmit="return edit_products_validateForm()">
            <?php 
                require '../../../config/database.php';
                require '../auth-role-admin.php';
                $id = $_GET['id'];
                $old = "select * from products where id = '$id'";
                $results = mysqli_query($conn,$old);
                $row = mysqli_fetch_array($results); 
            ?>
            <table>
                <tr>
                    <td>New product name</td>
                    <td><input type="text" name="newproductname" id="newproductname" placeholder="Enter New product name" value="<?php echo $row['productname'];?>"></td>
                </tr>
                <tr>
                    <td>New image</td>
                    <td><input type="file" name="newimage" id="newimage" value="<?php echo $row['image'];?>"></td>
                </tr>
                <tr>
                    <td>New price</td>
                    <td><input type="number" name="newprice" id="newprice" placeholder="Enter price" value="<?php echo $row['price'];?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="date" name="newcreatedate" id="createdate" hidden value="<?php echo $row['createdate'];?>"></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td class="radios">
                        <input type="radio" hidden name="newstatus" checked value="<?php echo $row['status'];?>">
                        <input type="radio" name="newstatus" id="hot" value="HOT"><label for="hot">HOT</label>
                        <input type="radio" name="newstatus" id="new" value="NEW"><label for="new">NEW</label>
                    </td>
                </tr>
                <tr>
                    <td>Sales</td>
                    <td><input type="number" name="newsales" id="newsales" placeholder="%" value="<?php echo $row['sales'];?>"></td>
                </tr>
                <tr>
                    <td>New description</td>
                    <td><input type="text" name="newdescription" id="newdescription" placeholder="Enter description" value="<?php echo $row['description'];?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button name="edit">Completed Edit</button></td>
                </tr>
            </table>
        </form>

        <?php
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $newproductname = $_POST['newproductname'];
                $newsales = $_POST['newsales'];
                $newprice = $_POST['newprice'];
                $newpricesales = $newprice - (($newsales/100)*$newprice);
                $newcreatedate = $_POST['newcreatedate'];
                $newdescription = $_POST['newdescription'];
                $newstatus = $_POST['newstatus'];

                $uploadDir = '../assets/images/';
                $imageName = $_FILES['newimage']['name'];
                $targetPath = $uploadDir . $imageName;

                if(isset($_POST['edit'])){
                    $query_edit = "UPDATE products SET productname = '$newproductname', image = '$targetPath', price = '$newprice', createdate = '$newcreatedate', description = '$newdescription', status = '$newstatus', sales = '$newsales', pricesales = '$newpricesales'  WHERE id = '$id' ";
                    $query = mysqli_query($conn, $query_edit); 
                    if($query){
                        header('Location: ./admin-product.php?token='.$token);
                    }   
                }
            }
        ?>

    </div>
    <script src="../../../assets/js/admin-products.js"></script>
</body>
</html>