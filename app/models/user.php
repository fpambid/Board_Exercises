<?php
class User extends AppModel
{
    const MIN_NAME_LENGTH = 3;
    const MAX_NAME_LENGTH = 30;
    const MIN_PASS_LENGTH = 6;
    const MAX_PASS_LENGTH = 40;

    public $validation = array(
        'name' => array(
            'length' => array(
                'validate_between', self::MIN_NAME_LENGTH, self::MAX_NAME_LENGTH,
            ),
            "format" => array(
                'is_name_valid', "Invalid Name"
            )
        ),
        'username' => array(
            'length' => array(
                'validate_between', self::MIN_NAME_LENGTH, self::MAX_NAME_LENGTH
            ),
            "format" => array(
                'is_username_valid', "Invalid Username"
            )
        ),

        'password'=> array(
            'length' => array(
                'validate_between', self::MIN_PASS_LENGTH, self::MAX_PASS_LENGTH
            ),
        ),
        'email'=> array(
            "format" => array(
                'is_email_valid', "Invalid Email"
            ),
        ),
    );

    /**
    *Authenticate values entered in log in form 
    *@param $username, $password
    *@throws RecordNotFoundException
    */
    public function authenticate($username, $password) 
    {
        if (!$this->validate()) {
            throw new ValidationException("Invalid Username/Password");
        }

        $db=DB::conn();
        $query = 'SELECT * FROM user WHERE username = ? AND password = ?';
        $param = array($username, $password);

        $row = $db->row($query, $param);

        if (!$row) {
            throw new RecordNotFoundException("Record not found");
        }  
        return new self($row);
    }

    /**
    *Insert validated values to table user
    */ 
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

        $db = DB::conn();

        $query = 'SELECT username, email, name FROM user WHERE username = ? OR email = ? OR name = ?';
        $param = array($this->username, $this->email, $this->name);

        $row = $db->row($query, $param);

        if($row) {
            throw new UserExistsException(notice('Sorry, that Username, Name or Email is not available', "error"));
        }
        else { 
            $db->insert('user', $values);      
        }
    }  

    public function update()
    {   
        $values = array(
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => sha1($this->password),
            'updated' => date('Y-m-d H:i:s')
        );

        if (!$this->validate()) {
            throw new ValidationException(notice('Error Found!', "error"));
        }

        $db = DB::conn();

        $query = 'SELECT username, email, name, id FROM user WHERE (username = ? OR email = ? OR name = ?) AND id != ?';
        $param = array($this->username, $this->email, $this->name, $_SESSION['id']);
        $where_params = array('id' => $this->id);

        $row = $db->row($query, $param);

        if($row) {
            throw new UserExistsException(notice('Sorry, that Username, Name or Email is not available', "error"));
        } else { 
            $db->update('user', $values, $where_params);   
        }
    }

    public function updateSession()
    {
        $db = DB::conn();

        $query = "SELECT * FROM user WHERE id = ?";
        $param = array($_SESSION['id']);

        $values = $db->row($query, $param);

        return $values;
    }

}
