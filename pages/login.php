<?php
if (isset($_SESSION['user'])) {
    header("location: index.php?page=profile");
}
Message::get();
?>

<h1>Login Page</h1>
<form action="index.php" method="POST">
    <div class="form-group">
        <label for="emain" class="form-label">Email:</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group mt-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <div>
        <button class="btn btn-primary mt-3" name="action" value="login">Login</button>
    </div>

</form>