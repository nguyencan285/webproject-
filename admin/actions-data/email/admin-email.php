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
    <title>Email</title>
    <style>
        .viewproduct tr{
            display: grid;
            grid-template-columns: 5% repeat(8,1fr);
        }
        .admin-actions{
            background-color: #16161c;
        }
        tr.indent td{
            background-color: black;
        }
        table.view{
            border-color: black;
        }
        td a button{
            background-color: green;
            color: white;
            border-radius: 2px;
        }
        img{
            width: 70%;
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
        <h1><i class="fa-solid fa-envelope-open-text"></i> Email</h1>
        <div class="admin-actions">
            <a href="../../admin.php"><i class="fa-solid fa-angles-left"></i> Admin</a>
        </div>
        <table class="view viewproduct">
            <tr class="indent">
                <td>ID</td>
                <td>Email </td>
                <td>Firt Name</td>
                <td>Last Name</td>
                <td>Type Email</td>
                <td>Content</td>
                <td>Date </td>
                <td>User ID</td>
                <td>Action</td>
            </tr>
            <?php
            require '../../../config/database.php';
            $all_email = $conn->prepare("SELECT * FROM email");
            $all_email->execute();
            $result_all_email = $all_email->get_result();
            while($row_email = $result_all_email->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $row_email['id'];?></td>
                    <td><?php echo $row_email['email'];?></td>
                    <td><?php echo $row_email['firstname'];?></td>
                    <td><?php echo $row_email['lastname'];?></td>
                    <td><?php echo $row_email['typemail'];?></td>
                    <td><?php echo $row_email['content'];?></td>
                    <td><?php echo $row_email['datesendmail'];?></td>
                    <td><?php echo $row_email['userid'];?></td>
                    <td class="actions">
                        <a onclick="return confirm('Are you sure??');" href="./delete-email.php?id=<?php echo $row_email['id']?>"><button class="delete">Delete</button></a>
                    </td>
                </tr>
                <?php // HTML
            }
            ?>
        </table>
    </div>
</body>
</html>





