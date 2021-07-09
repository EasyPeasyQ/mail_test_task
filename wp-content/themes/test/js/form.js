document.querySelector('.btn-close').addEventListener('click', function(event) {
    event.target.parentElement.classList.remove('show');
})

document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
    let form = this;
    let isEmail = validateEmail(this.email.value);
    let alert = document.querySelector('.alert');
    let responseConstainer = alert.querySelector('.submit-response');
    if (!isEmail) {
        this.email.classList.add('is-invalid');
        responseConstainer.innerHTML = '<strong>Attention!</strong> Email is invalid';
        alert.classList.add('show');
    } else {
        var data = jQuery(event.target).serialize();
        console.log(data);
        jQuery.post( "/wp-admin/admin-ajax.php", data, function(response) {
            let resposeEncode = JSON.parse(response);
			responseConstainer.innerHTML = `<strong>${resposeEncode.header}</strong> ${resposeEncode.message}`;
            !resposeEncode.error ? form.reset() : null;
            alert.classList.add('show');
		});
    }
});

function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}