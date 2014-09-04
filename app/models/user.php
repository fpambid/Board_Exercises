<?php
class User extends AppModel
{
    const MIN_NAME = 3;
    const MAX_NAME = 20;
    const MIN_PASS = 6;
    const MAX_PASS = 40;

    public $validation = array(
        'name' => array(
            'length' => array(
                'validateBetween', self::MIN_NAME, self::MAX_NAME,
            ),
            "format" => array(
                'isNameValid', "Invalid Name"
            )
        ),
        'username' => array(
            'length' => array(
                'validateBetween', self::MIN_NAME, self::MAX_NAME
            ),
            "format" => array(
                'isUsernameValid', "Invalid Username"
            )
        ),

        'password'=> array(
            'length' => array(
                'validateBetween', self::MIN_PASS, self::MAX_PASS
            ),
        ),
        'email'=> array(
            "format" => array(
                'isEmailValid', "Invalid Email"
            ),
        ),
        'password' => array(
            "length" => array(
                "validateBetween" , self::MIN_PASS, self::MAX_PASS
            ),
        ),

    );

    /**
    **Authenticate values entered in log in form 
    **@param $username, $password
    **@throws RecordNotFoundException
    **/
    public function authenticate($username, $password) 
    {
        $this->username = $username;
        $this->password = $password;

        if (!$this->validate()) {
            throw new ValidationException("Invalid Username/Password");
        }

        $db=DB::conn();
        $query = 'SELECT * FROM user_detail WHERE username = ? AND password = ?';
        $param = array($username, $password);

        $row = $db->row($query, $param);

        if (!$row) {
            throw new RecordNotFoundException("Record not found");
        }  
        return new self($row);
    }

    /**
    **Insert validated values to table user_detail
    **/ 
    public function register(array $user_detail) 
    {
        extract($user_detail);
        $values = array(
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => sha1($password),
            'created' => date('Y-m-d H:i:s')
        );
                          
        if (!$this->validate()) {
            throw new ValidationException(notice('Error Found!', "error"));
        }

        $user = array();
        $db = DB::conn();

        $query = 'SELECT username, email, name FROM user_detail WHERE username = ? OR email = ? OR name = ?';
        $param = array($this->username, $this->email, $this->name);

        $row = $db->row($query, $param);

        if($row) {
            throw new UserExistsException(notice('Sorry, that Username, Name or Email is not available', "error"));
        }
        else { 
            $db->insert('user_detail', $values);      
        }
    }  
}
