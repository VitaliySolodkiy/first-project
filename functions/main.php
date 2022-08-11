<?php
session_start();

require_once "./functions/helpers.php"; //тут важно написать путь, учитывая что mail.php подключается в index.php. Т.е. путь строим так, как будто мы находимся в нем
require_once "./functions/Message.php";
$page = $_GET['page'] ?? 'home';

$action = $_POST['action'] ?? null; //при отправке формы сюда записывает название функции (из параметра value кнопки отправки) в виде строки - 'sendMail'
if (!empty($action) && function_exists($action)) {
    $action(); //если в переменной находится строка, то ее можно вызвать как функцию просто добавив круглые скобки после нее
}

function sendMail()
{
    $email = clear($_POST['email'] ?? null);
    $subject = clear($_POST['subject'] ?? null);
    $message = clear($_POST['message'] ?? null);

    $errors = [];

    if (empty($email)) {
        $errors[] = "email is required";
    }
    if (empty($subject)) {
        $errors[] = "subject is required";
    }
    if (empty($message)) {
        $errors[] = "message is required";
    }

    if (count($errors) > 0) {
        Message::set($errors, 'danger');
    } else {
        mail("mailto@gmail.com", $subject, "From: $email, Message: $message");
        Message::set("Thank!");
    }
    redirect('contacts');
}

function uploadFile()
{
    $files = $_FILES['file'];
    if (isset($_POST['select'])) {
        $folderName =  'gallery/' . $_POST['select'] . '/' ?? '';
    } else {
        $folderName = "";
    }


    extract($files); // деструктуризация ассоциативного массива - автоматически создаются переменные с именами ключей
    for ($i = 0; $i < count($error); $i++) {
        if ($error[$i] > 0) {
            $isError === true;
            return;
        }
    }
    if ($isError === true) {
        Message::set('Error', 'danger');
        redirect('upload');
    }
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    foreach ($type as $currentFile) {
        if (!in_array($currentFile, $allowed)) {
            Message::set('Not allowed file type. Choose only images', 'danger');
            redirect('upload');
        }
    }

    if (!file_exists('./uploads')) {
        mkdir('uploads');
    }

    foreach ($name as $index => $currentName) {
        $newName = translit_file(microtime() . '_' . $currentName);
        if (!move_uploaded_file($tmp_name[$index], './uploads/' . $folderName . $newName)) { //если произошла ошибка при перемещении файла в локальное хранилище
            Message::set('Error', 'danger');
            redirect('upload');
        }
    }

    Message::set('File(s) uploaded');
    redirect('upload');
}

function createFolder()
{
    $folderName = clear($_POST['folderName']);
    if (!file_exists('./uploads/gallery/' . $folderName)) {
        mkdir("./uploads/gallery/" . $folderName);
        Message::set('Folder Created');
        redirect('upload');
    } else {
        Message::set('Folder already exist!', 'danger');
        redirect('upload');
    }
}

function deleteFolder()
{
    $folderName =  $_POST['select'] . "/";
    delTree($folderName);
    Message::set('Folder Deleted');
    redirect('upload');
}

//функция удаления дерева вложений внутри папки
function delTree($dir)
{
    $files = glob($dir . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (substr($file, -1) == '/')
            delTree($file);
        else
            unlink($file);
    }
    rmdir($dir);
}

function sendReview()
{
    $user = $_POST['user'] ?? null;
    $message = $_POST['message'] ?? null;

    if (!$user || !$message) {
        Message::set('Errors', 'danger');
        redirect('home');
    }

    $f = fopen('reviews.txt', 'a');
    fwrite($f, "$user|$message|" . time() . "\r\n");
    fclose($f);
    Message::set('Thank you! Review has been saved');
    redirect('home');
}

function showReviews()
{
    if (file_exists('reviews.txt')) {
        $lines = file('reviews.txt');
        foreach ($lines as $line) {
            list($user, $message, $time) = explode('|', $line);
?>

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><?= $user ?> <?= date('d.m.Y H:i', $time) ?></h5>
                    <p class="card-text"><?= $message ?></p>
                </div>
            </div>

<?php
        }
    }
}
