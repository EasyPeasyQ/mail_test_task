    <h1 class="text-center">Mail</h1>
    <form action="/wp-admin/admin-post.php" method="post" id="form" style="max-width: 600px; margin: 0 auto;">
        <input type="hidden" name="action" value="send_email">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" name="firstName" id="firstName">
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Last name</label>
            <input type="text" class="form-control" name="lastName" id="LastName">
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <?php 
            wp_editor( '', 'message', array(
                'wpautop'       => 1,
                'media_buttons' => 1,
                'textarea_name' => '',
                'textarea_rows' => 5,
                'tabindex'      => null,
                'editor_css'    => '',
                'editor_class'  => '',
                'teeny'         => 0,
                'dfw'           => 0,
                'tinymce'       => 1,
                'quicktags'     => 1,
                'drag_drop_upload' => false
            ) );
            ?>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
    <div class="alert alert-info alert-dismissible fade position-absolute bottom-0 end-0" role="alert">
        <div class="submit-response"></div>
        <button type="button" class="btn-close" aria-label="Close"></button>
    </div>
<script>

document.querySelector('.btn-close').addEventListener('click', event => {
    event.target.parentElement.classList.remove('show');
})

document.querySelector('form').addEventListener('submit', event => {
    event.preventDefault();
    let form = event.target;
    let isEmail = validateEmail(form.email.value);
    let alert = document.querySelector('.alert');
    let responseConstainer = alert.querySelector('.submit-response');
    if (!isEmail) {
        form.email.classList.add('is-invalid');
        responseConstainer.innerHTML = '<strong>Attention!</strong> Email is invalid';
        showMessage(alert);
    } else {
        form.email.classList.remove('is-invalid');
        let data = jQuery(event.target).serializeArray();
        data.push({
            name: "message",
            value: window.tinyMCE.get('message').getContent()
        });
        data = jQuery.param(data);
        jQuery.post( "/wp-admin/admin-ajax.php", data, response => {
            let resposeEncode = JSON.parse(response);
			responseConstainer.innerHTML = `<strong>${resposeEncode.header}</strong> ${resposeEncode.message}`;
            !resposeEncode.error ? event.target.reset() : null;
            showMessage(alert);
		})
        .fail(() => {
            responseConstainer.innerHTML = `<strong>Error!</strong>`;
        });
    }
});

const showMessage = alert => {
    alert.classList.add('show');
    setTimeout(() => {
        alert.classList.remove('show');
    }, 4000);
}

const validateEmail = email => {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

</script>