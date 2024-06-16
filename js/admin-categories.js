//----------------------------------------------------------
function add_categories_validateForm(){
    let categoryname = document.getElementById('categoryname');
    let description = document.getElementById('description');
    let isValid = true;

    if(categoryname.value == ''){
        categoryname.style.borderColor = "red";
        isValid = false;
    }
    if(description.value == ''){
        description.style.borderColor = "red";
        isValid = false;
    }
    return isValid;
}

function edit_categories_validateForm(){
    let newid = document.getElementById('newid');
    let newname = document.getElementById('newname');
    let newdescription = document.getElementById('newdescription');
    let isValid = true;

    if(newname.value == ''){
        newname.style.borderColor = "red";
        isValid = false;
    }
    if(newdescription.value == ''){
        newdescription.style.borderColor = "red";
        isValid = false;
    }
    return isValid;
}