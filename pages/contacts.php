<h1>Contacts Page</h1>
<?php Message::get() ?>
<form action="index.php" method="POST">
    <div class="form-group">
        <label for="emain" class="form-label">Email:</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group mt-3">
        <label for="Subject" class="form-label">Subject:</label>
        <input type="text" name="subject" id="subject" class="form-control">
    </div>
    <div class="form-group mt-3">
        <label for="message" class="form-label">Message:</label>
        <textarea name="message" id="message" class="form-control"></textarea>
    </div>
    <div>
        <button class="btn btn-primary mt-3" name="action" value="sendMail">Send</button>
    </div>

</form>