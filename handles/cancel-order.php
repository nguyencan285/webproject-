<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cancel'])) {
        $id_cancel = $_POST['id_cancel'];
        $cancel = mysqli_query($conn, "DELETE FROM orders WHERE id = '$id_cancel' ");
    }
}
