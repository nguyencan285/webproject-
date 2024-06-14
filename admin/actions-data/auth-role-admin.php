<?php
require '../../../config/database.php';
$validate = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM validate WHERE id = ')#^^$^!&)$'"));
if($validate['status']==='on'){
    ?>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            title: "Authentication",
            html: '<input type="password" id="password" class="swal2-input" placeholder="Enter your password">',
            showCancelButton: false,
            confirmButtonText: "Submit",
            allowOutsideClick: false,
            preConfirm: () => {
                const password = document.getElementById("password").value;
                // Thực hiện kiểm tra mật khẩu ở đây
                if (password === "!@admin@!") {
                    return true; // Cho phép truy cập
                } else {
                    Swal.showValidationMessage("Incorrect password");
                    return false; // Không cho phép truy cập
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Người dùng đã nhập đúng mật khẩu, cho phép truy cập trang web
                // Điều này có thể được thực hiện bằng cách chuyển người dùng đến trang web chính hoặc bằng cách hiển thị nội dung trang web
                // Ví dụ: window.location.href = "your_main_page.html";
            }else{
                window.location.href = "../../auth/login.php";
            }
        });
    });
</script>
    <?php
}
?>

