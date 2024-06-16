<?php
$results = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($results)) {
?>
    <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['userid'] ?></td>
        <td><img src="../../<?php echo $row['image'] ?>" alt=""></td>
        <td><?php echo $row['orderdate'] ?></td>
        <td><?php echo $row['productname'] ?></td>
        <td><?php echo $row['price'] ?></td>
        <td><?php echo $row['quantity'] ?></td>
        <td><?php echo $row['status'] ?></td>
        <td class="actions ">
            <a href="../orders/check-order.php?status=Processing&id=<?php echo $row['id'] ?>" onclick=" return confirm('Are you sure ? Processing')"><button style="background-color: #1B6B93;">Processing</button></a>
            <a href="../orders/check-order.php?status=Delivering&id=<?php echo $row['id'] ?>" onclick=" return confirm('Are you sure ? Delivering')"><button style="background-color: #DF2E38;">Delivering</button></a>
            <a href="../orders/check-order.php?status=Completed&id=<?php echo $row['id'] ?>" onclick=" return confirm('Are you sure ? Completed')"><button style="background-color:green;">Completed</button></a>
        </td>
    </tr>
<?php
}
?>