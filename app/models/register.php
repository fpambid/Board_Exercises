<?php
class Register Extends AppModel
{

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

    public function UserRegister(array $user_detail) 
    {
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

        $query = 'SELECT username, email, name FROM user_detail WHERE username = ? OR email = ? OR name = ?';
        $param = array($this->username, $this->email, $this->name);

        $exist = $db->row($query, $param);

        if($exist){
            throw new ValidationException(notice('Sorry, that Username, Name or Email is not available', "error"));
        }
        else{
            $insert = 'INSERT INTO user_detail SET name = ?, username = ?, email = ?, password = ?, created = ?';
            $values = array($name, $username, $email , $password, date('Y-m-d H:i:s'));

            $db->query($insert, $values);
                  
        }
    }  
}
