// --------------------------------- REGISTER --------------------------------- 
function validateForm_register(){
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let confirmpassword = document.getElementById('confirm-password');
    let error_pass = document.getElementById('error_pass');
    let isValid = true;

    if(email.value == ""){
        email.style.border = " 1px solid red";
        isValid = false;
    }
    if(password.value == ""){
        password.style.borderColor = "red";
        isValid = false;
    }
    if(confirmpassword.value == ""){
        confirmpassword.style.borderColor = "red";
        isValid = false;
    }
    if(confirmpassword.value !== password.value){
        error_pass.innerHTML = "Password incorrect";
        isValid = false;
    }
    return isValid;
}
function validateForm_newpassword(){
    let password = document.getElementById('password');
    let confirmpassword = document.getElementById('confirm-password');
    let isValid = true;

    if(password.value == ""){
        password.style.borderColor = "red";
        isValid = false;
    }
    if(confirmpassword.value == ""){
        confirmpassword.style.borderColor = "red";
        isValid = false;
    }
    return isValid;
}
// --------------------------------- REGISTER --------------------------------- 
// --------------------------------- LOGIN --------------------------------- 
function validateForm_login(){
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let isValid = true;

    if(email.value == ""){
        email.style.border = " 1px solid red";
        isValid = false;
    }
    if(password.value == ""){
        password.style.borderColor = "red";
        isValid = false;
    }
    return isValid;
}

function validateForm_forgotpassword(){
    let email = document.getElementById('email');
    let isValid = true;

    if(email.value == ""){
        email.style.borderColor = "red";
        isValid = false;
    }
    return isValid;
}
// --------------------------------- LOGIN --------------------------------- 
let dp_pass = document.getElementById('dp-pass');
let password = document.getElementById('password');
let confirmpassword = document.getElementById('confirm-password');
dp_pass.addEventListener('change', function(){
    if(dp_pass.checked){
        password.type = "text";
        confirmpassword.type = "tẽxt";
    }else{
        password.type = "password";
        confirmpassword.type = "password";
    }
}); 