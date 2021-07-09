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
<?php wp_enqueue_script('formscript', get_template_directory_uri() . '/js/form.js'); ?>