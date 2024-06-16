<div id="comment">
    <form onsubmit="return validate_comment()" action="" method="POST">
        <h2>Comment</h2>
        <input type="text" name="name-comment" id="name-comment" placeholder="Enter Name">
        <input type="text" name="content-comment" id="content-comment" placeholder="Enter Comment">
        <button name="comment">Comment</button>
    </form>
    <?php
    require '../config/database.php';
    if($_SERVER["REQUEST_METHOD"]==='POST'){
        if(isset($_POST['comment'])){
            if(isset($_SESSION['user']['userid'])){
                $userid = $_SESSION['user']['userid'];
                $name_comment = $_POST['name-comment']; 
                $content_comment = $_POST['content-comment']; 
                $date_comment = date('Y-m-d H:i:s');
                if(!empty($name_comment) && !empty($content_comment)){
                    $stmt = mysqli_prepare($conn, "INSERT INTO comment (`userid`,`username`,`content`,`datecomment`)
                    VALUES(?, ?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "isss", $userid, $name_comment, $content_comment, $date_comment);
                    $push_comment = mysqli_stmt_execute($stmt);
                    if($push_comment){
                        ?>
                            <script>
                                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Thank you for your comments',
                                showConfirmButton: false,
                                timer: 1500
                                });
                            </script>
                        <?php
                    }
                }
            }else{
                ?>
                    <script>
                        Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'You are not logged in?',
                        showConfirmButton: false,
                        timer: 1500
                        });
                    </script>
                <?php
            }
        }
    }
    ?>
</div>
