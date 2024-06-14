<?php
    while ($row = mysqli_fetch_assoc($allproducts)) {
        ?>
            <div class="product">
                <div class="image-product">
                    <a href="./product.php?id=<?php echo $row['id'];?>&information"><img src="<?php echo $row['image'];?>" alt="Image New Style"></a>
                    <div class="id-product">
                        <span><a href="./product.php?id=<?php echo $row['id'];?>&information"><?php echo '#'.$row['id']; ?></a></span>
                    </div>
                    <div class="status">
                        <?php
                        if($row['status']==='HOT'){
                            ?><a class="hot" href="./product.php?id=<?php echo $row['id'];?>&information"><span><?php echo $row['status']; ?></span></a><?php
                        }
                        if($row['status']==='NEW'){
                            ?><a class="new" href="./product.php?id=<?php echo $row['id'];?>&information"><span><?php echo $row['status']; ?></span></a><?php
                        }
                        if($row['sales'] > 0){
                            ?><a class="sales" href="./product.php?id=<?php echo $row['id'];?>&information"><span><?php echo $row['sales'].'%'; ?></span></a><?php
                        }
                        ?>
                    </div>
                </div>
                <div class="title-product">
                    <a href="./product.php?id=<?php echo $row['id'];?>&information"><span><?php echo $row['productname']; ?></span> </a> 
                </div>
                <div class="price-product">
                    <a href="./product.php?id=<?php echo $row['id'];?>&information"><span class="price-default"><?php echo '$'.$row['pricesales']; ?></span></a>
                    <?php
                    if($row['pricesales'] < $row['price']){
                        ?><a href="./product.php?id=<?php echo $row['id'];?>&information"><span class="price-sales"><?php echo '$'.$row['price']; ?></span></a><?php
                    }
                    ?>
                </div>
                <form method="POST" action="../handles/shop-add-to-cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['id'];?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['productname'];?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['image'];?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['pricesales'];?>">
                    <button onclick="successAddToCart()" type="submit" name="add-to-cart" class="add-cart"><span><i class="fa-solid fa-cart-plus"></i></span></button>
                    <button onclick="return false" type="submit" name="add-to-love" class="add-love"><span><i class="fa-regular fa-heart"></i></span></button>
                </form>
            </div>
        <?php
    }
?>
<script>
    function successAddToCart(){
        Swal.fire({
            icon: 'success',
            title: 'Success',
            showConfirmButton: false,
            timer: 3000
        });
    }
</script>