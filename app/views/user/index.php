<form id="login-form" action='<?php eh(url(''));?>' method="post">
        <fieldset>
          <span class="text">
          <input type="text" name="username" value="Username" onFocus="if(this.value=='Username'){this.value=''}" onBlur="if(this.value==''){this.value='Username'}" >
          </span> <span class="text">
          <input type="password" name="password" value="Password" onFocus="if(this.value=='Password'){this.value=''}" onBlur="if(this.value==''){this.value='Password'}"></span> &nbsp;
         <span class="btn btn-mini btn-inverse"> <input type="submit"   value="Log In" > </span>
         &nbsp;
          

          <a href="<?php eh(url('user/register'));?>">Create an account</a>
        </fieldset>
</form>