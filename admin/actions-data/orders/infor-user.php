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
    <title>Information User</title>
    <style>
        .viewproduct tr{
            grid-template-columns: 4% repeat(9,1fr);
        }
    </style>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <?php include '../auth-admin.php'; ?>
    <div>
        <h1><i class="fa-regular fa-address-card"></i> Information User</h1>
        <div class="admin-actions">
            <a href="../../admin.php"><i class="fa-solid fa-angles-left"></i> Admin</a>
        </div>
        <table class="view viewproduct">
            <tr class="indent">
                <td>ID</td>
                <td>User ID</td>
                <td>Name</td>
                <td>Phone</td>
                <td>Country</td>
                <td>Address</td>
                <td>City</td>
                <td>Type Pay</td>
                <td>Card Number</td>
                <td>NameOwner</td>
            </tr>

            <?php
            require '../../../config/database.php';
            require '../auth-role-admin.php';
            $query = " SELECT * FROM information_user"; 
            $results = mysqli_query($conn, $query); 
            while ($row = mysqli_fetch_array($results)){  
                ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['userid'] ?></td>
                    <td><?php echo $row['fullname'] ?></td>
                    <td><?php echo $row['numberphone'] ?></td>
                    <td><?php echo $row['country'] ?></td>
                    <td><?php echo $row['address'] ?></td>
                    <td><?php echo $row['city'] ?></td>
                    <td><?php echo $row['typepaycard'] ?></td>
                    <td><?php echo $row['cardnumber'] ?></td>
                    <td><?php echo $row['nameowner'] ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</body>
</html>





