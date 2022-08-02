<?php
class Message
{
    static function set($msg, $type = 'success')
    {
        $_SESSION['message'] = [$msg, $type];
    }

    static function get()
    {
        if (isset($_SESSION['message'])) {
            list($msg, $type) = $_SESSION['message']; //деструктуризация индексированного массива в php
            if (is_array($msg)) {
                $msg = implode("<br>", $msg);
            }
            echo "<div class='alert alert-$type'>$msg</div>";
            unset($_SESSION['message']);
        }
    }
}
