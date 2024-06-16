// Cài đặt ngày mặc định
var currentDate = new Date();
var formattedDate = currentDate.toISOString().slice(0,10);
document.getElementById('createdate').value = formattedDate;
//----------------------------------------------------------
function add_products_validateForm(){
    let productname = document.getElementById('productname');
    let image = document.getElementById('image');
    let price = document.getElementById('price');
    let description = document.getElementById('description');
    let isValid = true;

    if(productname.value == ''){
        productname.style.borderColor = "red";
        isValid = false;
    }
    if(image.value == ''){
        image.style.borderColor = "red";
        isValid = false;
    }
    if(price.value == ''){
        price.style.borderColor = "red";
        isValid = false;
    }
    if(description.value == ''){
        description.style.borderColor = "red";
        isValid = false;
    }
    return isValid;
}

function edit_products_validateForm(){
    let newproductname = document.getElementById('newproductname');
    let newimage = document.getElementById('newimage');
    let newprice = document.getElementById('newprice');
    let newdescription = document.getElementById('newdescription');
    let isValid = true;

    if(newproductname.value == ''){
        newproductname.style.borderColor = "red";
        isValid = false;
    }
    if(newimage.value == ''){
        newimage.style.borderColor = "red";
        isValid = false;
    }
    if(newprice.value == ''){
        newprice.style.borderColor = "red";
        isValid = false;
    }
    if(newdescription.value == ''){
        newdescription.style.borderColor = "red";
        isValid = false;
    }
    return isValid;
}