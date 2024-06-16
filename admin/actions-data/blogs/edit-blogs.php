<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/128/2206/2206368.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <title>Edit Blogs</title>
    <script src="https://cdn.tiny.cloud/1/oth0k27zuueqbrz7zs1z7lamu5s9xplqnoge8ev5ewlgsr4f/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        *{
            padding: 0;
            margin: 0;
            font-family: calibri;
        }
        form input{
            padding: 10px;
            width: calc(100% - 24px);
            border: 2px solid #eeeeee;
            outline: none;
            margin: 5px 0px;
            border-radius: 10px;
        }
        select{
            padding: 10px;
            border: 2px solid #eeeeee;
            border-radius: 10px;
            cursor: pointer;
            outline: none;
        }
        button{
            background-color: #279eff;
            border: 2px solid #279eff;
            font-weight: bold;
            color: white;
            cursor: pointer;
            padding: 10px 30px;
            border-radius: 5px;
            text-transform: uppercase;
        }
        button:hover{
            opacity: 0.9;
        }
        button:active{
            opacity: 0.7;
        }
        span{
            padding: 5px 0px 0px 5px;
        }
        a{
            text-decoration: none;
            color: white;
        }
    </style>
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
</head>
<body>
    <?php include '../auth-admin.php'; ?>
    <?php
    require '../../../config/database.php';
    require '../auth-role-admin.php';
    $id = $_GET['id'];
    $stmt = mysqli_prepare($conn, "SELECT * FROM blogs WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $run = mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_fetch_assoc($result);
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <textarea name="content" id="content"><?php echo $rows['content'];?></textarea>
        <input type="text" name="title" placeholder="Title" id="title" value="<?php echo $rows['title'];?>">
        <input type="text" name="description" placeholder="Description" id="description" value="<?php echo $rows['description'];?>">
        <span style="display: block;">Main Image</span>
        <input type="file" name="image" id="image">
        <select name="categoryblog" id="categoryblog">
            <option value="<?php echo $rows['categoryblog'];?>"><?php echo $rows['categoryblog'];?></option>
            <option value="Hot">Hot</option>
            <option value="New">New</option>
            <option value="Trending">Trending</option>
            <option value="Event">Event</option>
            <option value="Design">Design</option>
            <option value="Colorcombination">Color Combination</option>
        </select>
        <button name="add-blogs">Submit</button>
        <button type="button"><a href="./admin-blogs.php">Back</a></button>
    </form>
    <!-- ======================================================================================================= -->
    <?php
    if($_SERVER['REQUEST_METHOD']==='POST'){
        if(isset($_POST['add-blogs']) && !empty($_POST['content']) && !empty($_FILES['image']) && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['categoryblog'])){
            $sql = "UPDATE blogs SET content = ?, image = ?, title = ?, description = ?, categoryblog = ?, createdate = ? WHERE id = ? ";// Tạo câu lệnh và gán giá trị ẩn
            if($stmt = mysqli_prepare($conn, $sql)){ // Tạo câu lệnh chuẩn bị
                $id = $_GET['id'];
                $categoryblog = $_POST['categoryblog'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $content = $_POST['content'];
                $createdate = date('Y-m-d H:i:s');

                $src = $_FILES['image']['name'];
                $folder = '../assets/images/';
                $image = $folder . $src;

                mysqli_stmt_bind_param($stmt,"sssssss", $content, $image, $title, $description, $categoryblog, $createdate, $id);// gán giá trị vào
                if(mysqli_stmt_execute($stmt)){ // Chạy câu lệnh
                    header('Location: ./admin-blogs.php');
                }else{
                    echo "Thất bại";
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
        }
    }
    ?>
    <!-- ======================================================================================================= -->
    <!-- ======================================================================================================= -->
    <script>
        tinymce.init({
            selector: "textarea",
            plugins:
            "ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss",
            toolbar:
            "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat",
            tinycomments_mode: "embedded",
            tinycomments_author: "Author name",
                mergetags_list: [
                { value: "First.Name", title: "First Name" },
                { value: "Email", title: "Email" },
            ],
            ai_request: (request, respondWith) =>
                respondWith.string(() =>
                Promise.reject("See docs to implement AI Assistant")
            ),
        });
    </script>
        <!-- ======================================================================================================= -->
</body>
</html>
