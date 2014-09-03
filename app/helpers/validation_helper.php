<?php
function validate_between($check, $min, $max) 
{
    $n = mb_strlen($check);
    return $min <= $n && $n <= $max;
}

function redirect($url) 
{
    header("Location:" .$url);
}

function isNameValid($string) 
{
    if(preg_match("/[a-zA-Z]/", $string)) {
        return true;
    }
    return false;
}

function isEmailValid($email) 
{
    if(preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
        return true;
    }
    return false;
}

function isUsernameValid($uname) 
{
    if(preg_match('/[a-zA-Z0-9_-]/', $uname)) {
        return true;
    }
    return false;
}
