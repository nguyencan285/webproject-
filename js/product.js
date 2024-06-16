function next_image(index){
    let image_display = document.getElementById('image_display');
    let image_more1 = document.getElementById('image-more1');
    let image_more2 = document.getElementById('image-more2');
    let image_more3 = document.getElementById('image-more3');

    if(index == 1){
        image_display.src = image_more1.src;
    }if(index == 2){
        image_display.src = image_more2.src;
    }
    if(index==3){
        image_display.src = image_more3.src;
    }
}



function changeQuantity(delta) {
    const inputQuantity = document.getElementById('infor-quantity');
    let currentValue = parseInt(inputQuantity.value);

    // Kiểm tra nếu giá trị hiện tại là NaN hoặc không hợp lệ, thì gán lại giá trị mặc định là 1.
    if (isNaN(currentValue) || currentValue < 1) {
        currentValue = 1;
    }

    // Tăng hoặc giảm giá trị dựa vào delta và cập nhật giá trị của input.
    currentValue += delta;
    inputQuantity.value = currentValue;

    // Gán giá trị vào input ẩn trong form
    const formQuantity = document.querySelector('input[name="product_quantity"]');
    formQuantity.value = currentValue;
}



