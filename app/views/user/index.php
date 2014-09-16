<!-- nav -->
 <div class = "row-fluid">
   <div class = "span9 offset11"> 
   
    
     <a  name = "logout" href="<?php say(url('thread/index'));?>" > 
     <i class = "icon-home"></i>
    </a>  &nbsp; &nbsp;
    
    <a  name = "update" href="<?php say(url('user/update'));?>"><i class = "icon-cog"></i>
    </a> &nbsp; &nbsp;
    <a  name = "logout" href="<?php say(url('thread/logout'));?>"
    onClick = "return confirm('Are you sure you want to logout?')"><i class = "icon-off"></i>
    </a> 
    
    </div>
</div>
 <!-- nav -->


<body>
<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="input-group">


<form class ="form-signin" id="login-form" action='<?php say(url(''));?>' method="post">
    <table align="center">

        <tr>

            <td align="left">
                <div class="control-group"> 
                    <h1>Sign in </h1>
                    <?php echo $status;?><br/><label class="control-label" for = "inputUsername"> Username </label>
                    <div class="controls">
                    	<input type="text" name="username" maxlength="20" required> 

                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td align="left">
                <div class="control-group">
                    <label class="control-label" for="inputPassword">Password</label>
                        <div class="controls">
                            <input type="password" name="password" maxlength="40" required>
                        </div>
                </div>
            </td>
        </tr>
        <tr>
            <td align="left">
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" name = "submit" id = "submit" class="btn btn-primary">Sign in</button> &nbsp; &nbsp; &nbsp;
                        <a href="<?php say(url('user/register'));?>">Create an account</a>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</form>