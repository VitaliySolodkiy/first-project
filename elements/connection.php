<?php
function getConnection()
{
    return new PDO("mysql:host=localhost;dbname=first-project", "root", "");
}
