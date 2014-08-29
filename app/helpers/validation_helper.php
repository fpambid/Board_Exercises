<?php
function validate_between($check, $min, $max)
{
    $n = mb_strlen($check);
    return $min <= $n && $n <= $max;
}

function redirect($controller, $view, array $url_query = null)
{
    $url = "/$controller/$view";
    if ($url_query) {
        foreach ($url_query as $key => $value) {
            $url .= "?$key=$value";
        }
    }
    header("location: {$url}");
}

function is_email($email)
{
	return (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $email));
}

function is_valid_username($username)
{
	return (preg_match('/^[a-z0-9_-]$/', $username));//|| !(preg_match('/^\s$/', $string)));
}

function is_valid_pass($password)
{
	return (preg_match('/^[a-z0-9_-]$/', $password)); //|| !(preg_match('/^\s$/', $string)));
}

function is_valid_name($name)
{
	return (preg_match('/^[[A-za-z]\s?]$/', $name)); //|| !(preg_match('/^\s$/', $string)));

}
