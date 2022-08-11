<h1>Home Page</h1>
<?php Message::get() ?>
<form action="index.php" method="POST">

    <div class="form-group mt-3">
        <label for="user" class="form-label">User:</label>
        <input type="text" name="user" id="user" class="form-control">
    </div>
    <div class="form-group mt-3">
        <label for="message" class="form-label">Message:</label>
        <textarea name="message" id="message" class="form-control"></textarea>
    </div>
    <div>
        <button class="btn btn-primary mt-3" name="action" value="sendReview">Send</button>
    </div>

</form>

<?php

showReviews();

?>

<?php
// $f = fopen('test.txt', 'r+'); //open file. if choose 'r+' and file doesn't exist, return false. if choose 'w' or 'w+' not existing file will be created
// fwrite($f, '89'); //write text in file
// fclose($f); //close file

// $text = file_get_contents('test.txt');
// $text = str_replace("\r\n", "<br>", $text);
// echo $text;

// $lines = file('test.txt'); //move lines of txt file into array
// dump($lines);


?>