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

function name_valid($string) 
{
    if(preg_match("/[a-zA-Z]/", $string)) {
        return true;
    }
}

function email_valid($email) 
{
    if(preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
        return true;
    }

}

function username_valid($uname) 
{
    if(preg_match('/[a-zA-Z0-9_-]/', $uname)) {
        return true;
    }
}
