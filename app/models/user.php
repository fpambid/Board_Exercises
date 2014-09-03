<?php
class User extends AppModel
    {
    public $validation = array(
        "username" => array(
            "length" => array(
                "validate_between" , MIN_NAME, MAX_NAME
                ),
            "format" => array(
                "username_valid", "Invalid Username"
                ),
            ),
        "password" => array(
            "length" => array(
                "validate_between" , 6, 20
                ),
            ),
        );

    /**
    **Validate if username and password is registered
    **/
    
    public function is_real($username, $password) {
        $this->username = $username;
        $this->password = $password;

        if (!$this->validate()) {
            throw new ValidationException("Invalid Username/Password");
        }

        $db=DB::conn();
        $query = 'SELECT * FROM user_detail WHERE username = ? AND password = ?';
        $param = array($username, $password);

        $user_exist = $db->row($query, $param);

        if (!$user_exist) {
            throw new RecordNotFoundException("Record not found");
        }  
        return new self($user_exist);
    }

    
}
