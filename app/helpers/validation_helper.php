<?php
function validate_between($check, $min, $max) 
{
    $n = mb_strlen($check);
    return $min <= $n && $n <= $max;
}

function redirect($url) 
{
    header("Location:$url");
}

function is_name_valid($string) 
{
    return preg_match('/[a-zA-Z0-9\s]/', $string); 
}

function is_email_valid($email) 
{
    return preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email);
}

function is_username_valid($uname) 
{
    return preg_match('/[a-zA-Z0-9_-]/', $uname); 
}

function is_logged_out()
{
    if (!isset($_SESSION['id'])) {
        redirect('../');
    }
}
