function validateCheckout(){
    let auth = true;
    let checkout = document.getElementById('checkout');
    let auth_checkout = document.getElementById('auth-checkout');
    if (!auth_checkout.checked) {
        auth = false;
    }else {
        auth = true;
    }
    return auth;
}


