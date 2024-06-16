<?php
$results = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($results)) {
?>
    <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['productname'] ?></td>
        <td><img width="100px" src="../../<?php echo $row['image'] ?>" alt=""></td>
        <td><?php echo $row['price'] ?></td>
        <td><?php echo $row['createdate'] ?></td>
        <td><?php echo $row['description'] ?></td>
        <td><?php echo $row['categoryid'] ?></td>
        <td><?php echo $row['status'] ?></td>
        <td><?php echo $row['sales'] ?></td>
        <td><?php echo $row['pricesales'] ?></td>
        <td class="actions">
            <a href="../products/edit-product.php?id=<?php echo $row['id'] ?>"><button class="edit">Edit <i class="fa-solid fa-pen-to-square"></i> </button></a>
            <a href="../products/add-image-more.php?id=<?php echo $row['id'] ?>"><button class="edit">Image <i class="fa-solid fa-pen-to-square"></i> </button></a>
            <a onclick=" return confirm('Bạn muốn xóa ?') " href="../products/delete-product.php?id=<?php echo $row['id'] ?>"><button class="delete">Delete <i class="fa-solid fa-trash-can"></i></button></a>
        </td>
    </tr>
<?php
}
?>