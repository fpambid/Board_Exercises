<?php
class UserController Extends AppController
{	
    /**
    **Get and Validate entered values in log in form
    **/
    public function index()
    {
    	$title = ' ';
    	$status = ' ';

    	$username = Param::get('username');
    	$password = Param::get('password');

    	$user = new User();

    	if (!isset($username) || !isset($password)) {
            $status = ' ';
        } elseif (!($username || $password)) {
            $status = notice("All fields are required", "error");
        } else {            
            try {
                $log_detail = $user->is_real($username, $password);   
                $_SESSION['username'] = $log_detail->username;
                $_SESSION['password'] = $log_detail->password;

                echo $log_detail->username;
                redirect('thread/index');

            } catch (ValidationException $e) {
                $status = notice($e->getMessage(),"error");
            } catch (RecordNotFoundException $e) {
                $status = notice($e->getMessage(),"error");
            }
        }

        $this->set(get_defined_vars());           
    }

    /**
    **Get and Validate entered values in registration form
    **/
    public function register()
    {
    	$title = ' ';
    	$status = ' ';

    	$reg_username = Param::get('username');
    	$reg_name = Param::get('name');
    	$reg_email = Param::get('email');
    	$reg_password= Param::get('password');
    	$empty_field = 0;

    	$user_detail = array(
               	          'name' => $reg_name,
               	          'username' => $reg_username,
               	          'email' => $reg_email,
               	          'password' => $reg_password
                          );

    	$register = new User();
 
		$status = ' ';
        $register->username = Param::get('username');
        $register->name = Param::get('name');
        $register->email = Param::get('email');
        $register->password = Param::get('password');

        if (!isset($reg_name) || !isset($reg_password) || !isset($reg_email) ||!isset($reg_username)) {
            $status = ' ';
        } elseif (!($reg_username) || !($reg_password) || !($reg_email) || !($reg_name)) {
            $status = notice("All fields are required", "error");
        }
       	
        foreach ($user_detail as $key => $value) {
    		if (!$value) {
    			$empty_field++;
    		} else {
                $user_detail['$key'] = $value;
            }
        }

       if ($empty_field === 0)
       {
            try{
                $a = $register->UserRegister($user_detail);
	            $status = notice("Registration Done! Thank You!");
	        } catch (ExistingUserException $e) {
                $status = notice($e->getMessage(), "error");
            
            } catch (ValidationException $e) {
        	    $status = notice($e->getMessage(), "error");
            }  
        }  

        //TODO: Get all threads
        $this->set(get_defined_vars());
    }
}