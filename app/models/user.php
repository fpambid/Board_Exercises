<?php
class User extends AppModel
    {
public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', MIN_NAME,MAX_NAME
                )
            // 'format' => array(
            //     'is_valid_username', "Invalid username"
            //     )
            ),

        'password'=> array(
            'length' => array(
                'validate_between', MIN_PASS,MAX_PASS
                )
                // 'format' => array(
                //     'is_valid_pass', "Invalid password"
            )
        );
    	 public function is_real($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

            $this->validate();

                if (!$this->validate()) {

                    throw new ValidationException(notice('Username/Password not Valid!', "error"));
                }

        $db=DB::conn();
        $db->begin();
        $row = $db->row("SELECT * FROM user_detail
            WHERE username = ? AND password = ?", array($username, $password));
        if (!$row) {
            throw new RecordNotFoundException("Record not found!");
        }  
        return new self($row);
    }

    } 