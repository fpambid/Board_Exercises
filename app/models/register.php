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
                'validate_between', self::MIN_NAME, self::MAX_NAME,
                ),
            "format" => array(
                'isNameValid', "Invalid Name"
            )
        ),
        'username' => array(
            'length' => array(
                'validate_between', self::MIN_NAME, self::MAX_NAME
                ),
            "format" => array(
                'isUsernameValid', "Invalid Username"
            )
        ),

        'password'=> array(
            'length' => array(
                'validate_between', self::MIN_PASS, self::MAX_PASS
                ),
            ),
         'email'=> array(
            "format" => array(
                'isEmailValid', "Invalid Email"
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
