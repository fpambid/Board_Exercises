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
    return preg_match('/^([a-zA-Z]+[\s\.]?){1,5}$/', $string);
}

function is_email_valid($email) 
{
    return preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email);
}

function is_username_valid($uname) 
{
    return preg_match('/^([a-zA-Z_-\d]+)$/', $uname);
}

function is_title_valid($string)
{
    return !(preg_match('/^\s+$/', $string));
}

function confirm_logged_in()
{
    if (!isset($_SESSION['id'])) {
        redirect('../');
    }
}

function confirm_logged_out()
{
    if (isset($_SESSION['id'])) {
        
        $logout = "Please logout first";
        redirect(url("thread/index", array("m"=>$logout)));
    }
}
