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
    <title>Comments</title>
    <style>
        .viewproduct tr{
            display: grid;
            grid-template-columns: 5% repeat(5,1fr);
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
        <h1><i class="fa-regular fa-comments"></i> Comments</h1>
        <div class="admin-actions">
            <a href="../../admin.php"><i class="fa-solid fa-angles-left"></i> Admin</a>
        </div>
        <table class="view viewproduct">
            <tr class="indent">
                <td>ID</td>
                <td>User ID</td>
                <td>UserName</td>
                <td>Content</td>
                <td>Date Comment</td>
                <td>Action</td>
            </tr>
            <?php
            require '../../../config/database.php';
            $all_comment = $conn->prepare("SELECT * FROM comment");
            $all_comment->execute();
            $result_all_comment = $all_comment->get_result();
            while($row_comment = $result_all_comment->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $row_comment['id'];?></td>
                    <td><?php echo $row_comment['userid'];?></td>
                    <td><?php echo $row_comment['username'];?></td>
                    <td><?php echo $row_comment['content'];?></td>
                    <td><?php echo $row_comment['datecomment'];?></td>
                    <td class="actions">
                        <a onclick="return confirm('Are you sure??');" href="./delete-comment.php?id=<?php echo $row_comment['id']?>"><button class="delete">Delete</button></a>
                    </td>
                </tr>
                <?php // HTML
            }
            ?>
        </table>
    </div>
</body>
</html>





