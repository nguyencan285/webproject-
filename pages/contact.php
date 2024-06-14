<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins:wght@300&family=Rubik&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon/favicon.png" type="image/x-icon">
    <!-- FONT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="../assets/css/style-header.css">
    <link rel="stylesheet" href="../assets/css/style-footer.css">
    <link rel="stylesheet" href="../assets/css/style-slider.css">
    <link rel="stylesheet" href="../assets/css/style-products.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- CSS -->
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
    <title>Bello - Contact</title>
</head>

<body>
    <div class="container">
        <!-- --------------- HEADER -----------------    -->
        <?php include '../layout/header-component.php'; ?>
        <!-- --------------- HEADER -----------------    -->
        <!-- --------------- SLIDER -----------------    -->
        <span class="title-page-now"><i class="fa-regular fa-id-card"></i> Contact</span>
        <!-- --------------- SLIDER -----------------    -->
        <main>
            <div id="contact">
                <div class="form-contact">
                    <h2>Create Mail</h2>
                    <form onsubmit="return validate_sendmail()" method="POST" action="">
                        <div class="in-name">
                            <div class="first-name">
                                <label for="first-name">First Name*</label>
                                <input type="text" name="first-name" id="first-name" placeholder="First Name">
                            </div>
                            <div class="last-name">
                                <label for="last-name">Last Name*</label>
                                <input type="text" name="last-name" id="last-name" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="in-email">
                            <label for="in-email">Email*</label>
                            <input type="email" name="in-email" id="in-email" placeholder="Enter Your Email">
                        </div>
                        <div class="in-type">
                            <label for="in-type">Type Mail</label>
                            <select name="in-type" id="in-type">
                                <option value="feedback">Feedback</option>
                                <option value="error">Error</option>
                                <option value="support">Support</option>
                            </select>
                        </div>
                        <div class="in-content">
                            <label for="in-content">How can we help?*</label>
                            <textarea name="in-content" id="in-content" cols="30" rows="10" placeholder="Content"></textarea>
                        </div>
                        <div class="on-sub-mail">
                            <button name="on-sub-mail">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- SENDMAILLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL -->
                <?php
                    require '../config/database.php';
                    if($_SERVER["REQUEST_METHOD"]==='POST'){
                        if(isset($_POST['on-sub-mail'])){
                            require '../auth/auth-role-user.php';
                            $first_name = $_POST['first-name']; 
                            $last_name = $_POST['last-name']; 
                            $email = $_POST['in-email']; 
                            $type = $_POST['in-type']; 
                            $content = $_POST['in-content']; 
                            $date_sendmail = date('Y-m-d H:i:s');
                            if(!empty($userid) && !empty($first_name) && !empty($last_name) && !empty($email) && !empty($content) && !empty($type) && !empty($date_sendmail) ){
                                $stmt = mysqli_prepare($conn,"INSERT INTO email (`email`,`firstname`,`lastname`,`typemail`,`content`,`datesendmail`,`userid`)
                                                    VALUES(?,?,?,?,?,?,?)");
                                mysqli_stmt_bind_param($stmt,"sssssss",$email, $first_name, $last_name, $type, $content, $date_sendmail, $userid);
                                $sendmail = mysqli_stmt_execute($stmt);
                                if($sendmail && isset($userid) && !empty($userid)){
                                    ?>
                                        <script>
                                            Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'Complete',
                                            showConfirmButton: false,
                                            timer: 1500
                                            });
                                        </script>
                                    <?php
                                }else{
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
                            }
                        }
                    }
                ?>
                <!-- SENDMAILLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL -->
                <div class="google-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.6075994348175!2d106.7990392752162!3d10.877584792248542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d8a415a9d221%3A0x550c2b41569376f9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBRdeG7kWMgVOG6vyAtIMSQ4bqhaSBo4buNYyBRdeG7kWMgZ2lhIFRQLkhDTQ!5e0!3m2!1svi!2s!4v1701688599995!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                <div class="more-contact">
                    <div class="infor-address">
                        <table>
                            <tr>
                                <td class="img-contact" rowspan="2"><img width="25px" src="../assets/images/ic-map.png" alt="Error photo"></td>
                                <td><span><strong>Address</strong></span></td>
                            </tr>
                            <tr>
                                <td><span>khu phố 6, TP Thủ Đức, Thành phố Hồ Chí Minh, Việt Nam</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="infor-email">
                        <table>
                            <tr>
                                <td class="img-contact" rowspan="2"><img width="30px" src="../assets/images/ic-email.png" alt="Error photo"></td>
                                <td><span><strong>Email</strong></span></td>
                            </tr>
                            <tr>
                                <td><span>support@gmail.com</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="infor-numberphone">
                        <table>
                            <tr>
                                <td class="img-contact" rowspan="2"><img width="30px" src="../assets/images/ic-phone.png" alt="Error photo"></td>
                                <td><span><strong>Phone</strong></span></td>
                            </tr>
                            <tr>
                                <td><span>0999 888 777</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <!-- --------------- FOOTER -----------------    -->
        <?php include '../layout/footer-component.php'; ?>
        <!-- --------------- FOOTER -----------------    -->
    </div>
    <!-- --------------- JAVASCRIPT -----------------    -->
    <script src="../assets/js/index.js"></script>
    <!-- --------------- JAVASCRIPT -----------------    -->
</body>

</html>