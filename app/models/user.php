<?php
class User extends AppModel
    {

    	 public function is_real($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        if (!$this->validate()) {
            throw new ValidationException("Invalid Username/Password");
        }

        $db=DB::conn();
        $row = $db->row("SELECT * FROM user_detail
            WHERE username = ? AND password = ?", array($username, $password));
        if (!$row) {
            throw new RecordNotFoundException("Record not found");
        }  
        return new self($row);
    }

    }