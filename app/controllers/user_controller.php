<?php
class UserController Extends AppController
{	
    /**
    *
    *Get and Validate entered values in log in form
    */
    public function index()
    {    
        confirm_logged_out();

        $status = NULL;

        $user = new User();

        $user->username = Param::get('username');
        $user->password = sha1(Param::get('password'));        

        if($_POST) {     
            try {
                $user_detail = $user->authenticate();
                $_SESSION['username'] = $user_detail->username;
                $_SESSION['password'] = $user_detail->password;
                $_SESSION['id'] = $user_detail->id;

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
        confirm_logged_out();

        $status = NULL;
        $empty_field = NULL;

        $user = new User();
 
        $user->username = Param::get('username');
        $user->name = Param::get('name');
        $user->email = Param::get('email');
        $user->password = Param::get('password');
        
        $user_detail = array(
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password
        );

       	if($_POST) {
            foreach ($user_detail as $key => $value) {
                if (!$value) {
                    $empty_field++;
                } else {
                    $user_detail['$key'] = $value;
                }
            }

            if (!$empty_field) {

                try {
                    $user->register($user_detail);
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

    public function update()
    {
        confirm_logged_in();

        $status = NULL;
        $empty_field = NULL;

        $user = new User();

        $user->username = Param::get('username');
        $user->name = Param::get('name');
        $user->email = Param::get('email');
        $user->password = Param::get('password');
        $user->id = $_SESSION['id'];

        $user_detail = array(
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password
        );

        if($_POST) {
            foreach ($user_detail as $key => $value) {
                if (!$value) {
                    $empty_field++;
                } else {
                    $user_detail['$key'] = $value;
                }
            }

            if (!$empty_field) {

                try {
                    $user->update($user_detail);
                    $status = notice("Your Account is updated! Thank You!");
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