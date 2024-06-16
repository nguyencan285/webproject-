// ===================================== SLIDE ================================
let images = [
    document.getElementById('image-1'),
    document.getElementById('image-2'),
    document.getElementById('image-3'),
    document.getElementById('image-4')
];

let radioButtons = [
    document.getElementById('img1'),
    document.getElementById('img2'),
    document.getElementById('img3'),
    document.getElementById('img4')
];

let currentIndex = 0;

function changeImage() {
    images[currentIndex].style.display = 'none'; // Ẩn hình ảnh hiện tại
    currentIndex = (currentIndex + 1) % images.length; // Chuyển đến hình ảnh tiếp theo
    images[currentIndex].style.display = 'block'; // Hiển thị hình ảnh mới
    radioButtons[currentIndex].checked = true; // Đánh dấu nút radio tương ứng
}

// Tự động chuyển đổi sau mỗi 3 giây (3000ms)
let intervalId = setInterval(changeImage, 3000);

// Thêm sự kiện "change" cho các nút radio để người dùng có thể chuyển đổi slide
radioButtons.forEach(function(radio, index) {
    radio.addEventListener('change', function() {
        clearInterval(intervalId); // Dừng tự động chuyển đổi
        currentIndex = index; // Cập nhật chỉ số hiện tại
        images.forEach(function(img, i) {
            img.style.display = i === currentIndex ? 'block' : 'none'; // Hiển thị slide tương ứng
        });
        intervalId = setInterval(changeImage, 3000); // Bắt đầu tự động chuyển đổi lại
    });
});
// ===================================== SLIDE ================================
// =============================== VALIDATE ==========================
function validate_comment(){
    let name_comment = document.getElementById('name-comment');
    let content_comment = document.getElementById('content-comment');
    let valid = true;

    if(name_comment.value == ''){
        valid = false;
        name_comment.style.borderColor = 'red';
    }
    if(content_comment.value == ''){
        valid = false;
        content_comment.style.borderColor = 'red';
    }
    return valid;
}
function validate_sendmail(){
    let first_name = document.getElementById('first-name');
    let last_name = document.getElementById('last-name');
    let in_email = document.getElementById('in-email');
    let in_type = document.getElementById('in-type');
    let in_content = document.getElementById('in-content');
    let valid = true;

    if(first_name.value.trim() == ''){
        valid = false;
        first_name.style.borderColor = 'red';
    }
    if(last_name.value.trim() == ''){
        valid = false;
        last_name.style.borderColor = 'red';
    }
    if(in_email.value.trim() == ''){
        valid = false;
        in_email.style.borderColor = 'red';
    }
    if(in_type.value.trim() == ''){
        valid = false;
        in_type.style.borderColor = 'red';
    }
    if(in_content.value.trim() == ''){
        valid = false;
        in_content.style.borderColor = 'red';
    }
    return valid;
}
// =============================== VALIDATE ==========================
// =============================== SCROLL ============================
document.getElementById('scrollToTopButton').addEventListener('click', function() {

    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
// =============================== SCROLL ============================
