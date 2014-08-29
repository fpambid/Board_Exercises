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
                'validate_between', MIN_NAME,MAX_NAME
                )
            // 'format' => array(
            //     'is_valid_name', "Invalid name"
            //     )
            ),
        'username' => array(
            'length' => array(
                'validate_between', MIN_NAME,MAX_NAME
                )
            // 'for
        	// 'format' => array(
         //        'is_valid_username', "Invalid username"
         //        )
            ),

        'password'=> array(
            'length' => array(
                'validate_between', MIN_PASS,MAX_PASS
                )
            // 'for
        		// 'format' => array(
          //           'is_valid_pass', "Invalid password"
          //       )
        	),

        );

    	public function UserRegister(array $user_detail){
    	    	extract($user_detail);
    	    	$detail = array(
               	          'name' => $name,
               	          'username' => $username,
               	          'email' => $email,
               	          'password' => $password,
               	          'created' => date('Y-m-d H:i:s')
                          );
    	    	// $this->username = $username;
          //       $this->password = $password;
          //       $this->email = $email;
    	    	$this->validate();

                if ($this->hasError()) {

                    throw new ValidationException(notice('Error Found!', "error"));
                    // $status = notice("What???", "error");
                }

                $user = array();
                $db = DB::conn();

                // $query = ("SELECT username, email, name FROM user_detail WHERE username = ? OR email = ? OR name = ?");
                // $com = array($username, $email);
                // $com2 = array($name);

                // $look = $db->row($query,$com);
               
               
                // if($look){
                // 	throw new Exception("Username or Email not available");
                // }

                $db->query('INSERT INTO user_detail SET name = ?, username = ?, email = ?, password = ?, created = ?',
                	array($name, $username, $email , $password, date('Y-m-d H:i:s')));
        }   
    }




