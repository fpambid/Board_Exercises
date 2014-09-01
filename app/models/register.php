<?php
class Register Extends AppModel
{
    const MIN_NAME = 3;
    const MAX_NAME = 20;
    const MIN_PASS = 6;
    const MAX_PASS = 20;

    public $validation = array(
        'name' => array(
            'length' => array(
                'validate_between', MIN_NAME, MAX_NAME,
                ),
            "format" => array(
                'name_valid', "Invalid Name"
            )
        ),
        'username' => array(
            'length' => array(
                'validate_between', MIN_NAME, MAX_NAME
                ),
            "format" => array(
                'username_valid', "Invalid Username"
            )
        ),

        'password'=> array(
            'length' => array(
                'validate_between', MIN_PASS, MAX_PASS
                ),
            ),
         'email'=> array(
            "format" => array(
                'email_valid', "Invalid Email"
            )
        )
    );

    public function UserRegister(array $user_detail) {
        extract($user_detail);
        $detail = array(
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'created' => date('Y-m-d H:i:s')
        );
                          
        $this->validate();

                if ($this->hasError()) {

                    throw new ValidationException(notice('Error Found!', "error"));
                }

        
        $user = array();
        $db = DB::conn();

        $exist = $db->row("SELECT username, email, name FROM user_detail WHERE username = ? OR email = ? OR name = ?",
            array($this->username, $this->email, $this->name));

        if($exist){
            throw new ValidationException(notice('Sorry, that Username, Name or Email is not available', "error"));
        }
        else{
            $db->query("INSERT INTO user_detail SET name = ?, username = ?, email = ?, password = ?, created = ?",
                    array($name, $username, $email , $password, date('Y-m-d H:i:s')));
        }
    }  
}
