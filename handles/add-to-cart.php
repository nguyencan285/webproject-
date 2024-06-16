<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
    session_start();
    if(isset($_POST['add-to-cart'])){
        if (isset($_POST['product_id']) && !empty($_POST['product_id']) && !empty($_POST['product_image']) && !empty($_POST['product_name']) && !empty($_POST['product_price']) ) {
            $product_id = $_POST['product_id'];
            $product_image = $_POST['product_image'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
        
            // Nếu đã có thì chỉ tăng số lượng
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] += 1;
                header('Location: ../pages/home.php');
                exit();
            } else {
                // Nếu chưa có thì thêm mới
                $_SESSION['cart'][$product_id] = [
                    'name' => $product_name,
                    'image' => $product_image,
                    'price' => $product_price,
                    'quantity' => 1
                ];
                header('Location: ../pages/home.php');
                exit();
            }
        }
    }else{
        header('location: ../pages/home.php');
    }
}
?>