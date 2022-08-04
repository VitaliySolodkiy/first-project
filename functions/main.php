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


function register()
{
    $email = clear($_POST['email'] ?? null);
    $login = clear($_POST['login'] ?? null);
    $password = md5(clear($_POST['password'] ?? null));
    try {
        $conn = new PDO("mysql:host=localhost;dbname=first-project", "root", "");

        $users = "SELECT * FROM Users";
        $result = $conn->query($users);
        while ($row = $result->fetch()) {
            if ($row['email'] === $email) {
                Message::set("User with email: $email - is already exist", "danger");
                redirect('signup');
            }
        }

        $sql = "INSERT INTO Users (login, email, password) VALUES ('$login','$email', '$password' )";

        $affectedRowsNumber = $conn->exec($sql);
        Message::set("User has been created.<br> Was affected  $affectedRowsNumber row(s)<br> Now you can login, using email and password.");
        redirect('login');
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}

function login()
{
    $email = clear($_POST['email'] ?? null);
    $password = md5(clear($_POST['password'] ?? null));
    try {
        $conn = new PDO("mysql:host=localhost;dbname=first-project", "root", "");

        $users = "SELECT * FROM Users WHERE email = '$email' and password = '$password'";
        $result = $conn->query($users);
        $user = $result->fetch();
        if ($user > 0) {
            $_SESSION['user'] = [
                "login" => $user["login"],
                "email" => $user["email"],
            ];
            Message::set("You have been successfully logged in");
            redirect('login');
        } else {
            Message::set("Incorrect email or password", 'danger');
            redirect('login');
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
