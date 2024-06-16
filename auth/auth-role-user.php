<?php
// session start đã có trên header
if(isset($_SESSION['user']) && isset($_SESSION['user']['role'])) {
    $userid = $_SESSION['user']['userid'];
    $role = $_SESSION['user']['role'];
} else {
    ?>
        <script>
        Swal.fire({
            title: 'You are not logged in',
            text: 'Do you want to redirect to the homepage?',
            icon: 'warning',
            showCancelButton: false,
            allowOutsideClick: false,
            confirmButtonText: 'Go to login',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../auth/login.php';
            }
        });
        </script>
    <?php
}
?>