<?php
function validate_between($check, $min, $max) {
    $n = mb_strlen($check);
    return $min <= $n && $n <= $max;
}

function redirect($controller, $view, array $url_query = null) {
    $url = "/$controller/$view";
    if ($url_query) {
        foreach ($url_query as $key => $value) {
            $url .= "?$key=$value";
        }
    }
    header("location: {$url}");
}

function name_valid($string) {
    if(preg_match("/[a-zA-Z]/", $string)) {
        return true;
    }else
        return false;
    // return true;
}

function email_valid($email) {
    if(preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
        return true;
    }else 
        return false;

}

function username_valid($uname) {
    if(preg_match('/[a-zA-Z0-9_-]/', $uname)) {
        return true;
    }else
        return false;
        return true;
}
