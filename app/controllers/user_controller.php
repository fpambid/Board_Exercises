<?php
class UserController Extends AppController
{	
    /**
    *
    *Get and Validate entered values in log in form
    */
    public function index()
    {
        $title = NULL;
        $status = NULL;

        $user = new User();

        $user->username = Param::get('username');
        $user->password = sha1(Param::get('password'));        

        if($_POST) {     
            try {
                $user_detail = $user->authenticate($user->username, $user->password);
                $_SESSION['username'] = $user_detail->username;
                $_SESSION['password'] = $user_detail->password;

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
    *
    *Get and Validate entered values in registration form
    */
    public function register()
    {
        $title = NULL;
        $status = NULL;

        $reg_username = Param::get('username');
        $reg_name = Param::get('name');
        $reg_email = Param::get('email');
        $reg_password = Param::get('password');
        $empty_field = 0;

        $user_detail = array(
                          'name' => $reg_name,
               	          'username' => $reg_username,
               	          'email' => $reg_email,
               	          'password' => $reg_password
                          );

        $user = new User();
 
        $user->username = Param::get('username');
        $user->name = Param::get('name');
        $user->email = Param::get('email');
        $user->password = Param::get('password');

       	if($_POST) {
            foreach ($user_detail as $key => $value) {
                if (!$value) {
                    $empty_field++;
                } else {
                    $user_detail['$key'] = $value;
                }
            }

            if ($empty_field === 0)
            {
                try {
                    $a = $user->register($user_detail);
                    $status = notice("Registration Done! Thank You!");
                } catch (UserExistsException $e) {
                    $status = notice($e->getMessage(), "error");
            
                } catch (ValidationException $e) {
                    $status = notice($e->getMessage(), "error");
                }  
            }  
        }

        //TODO: Get all threads
        $this->set(get_defined_vars());
    }
}