//----------------------------------------------------------
function add_user_validateForm(){
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let role = document.getElementById('role');
    let isValid = true;

    if(email.value == ''){
        email.style.borderColor = "red";
        isValid = false;
    }
    if(password.value == ''){
        password.style.borderColor = "red";
        isValid = false;
    }
    return isValid;
}

function edit_categories_validateForm(){
    let newemail = document.getElementById('newemail');
    let newpassword = document.getElementById('newpassword');
    let isValid = true;

    if(newemail.value == ''){
        newemail.style.borderColor = "red";
        isValid = false;
    }
    if(newpassword.value == ''){
        newpassword.style.borderColor = "red";
        isValid = false;
    }
    return isValid;
}