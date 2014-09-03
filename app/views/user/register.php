<?php if ($register->hasError()): ?>
    <div class="alert alert-block">
        <h4 class="alert-heading">Validation error!</h4>

         <?php if (!empty($user->validation_errors['name']['format'])): ?>
            <div>That name is INVALID! Alphanumerics only!
            </div>
        <?php endif ?>  

        <?php if (!empty($user->validation_errors['username']['format'])): ?>
            <div>That username is INVALID!
            </div>
        <?php endif ?>     

        <?php if (!empty($user->validation_errors['email']['format'])): ?>
            <div>That Email is INVALID!
            </div>
        <?php endif ?>          
        
        <?php if (!empty($register->validation_errors['name']['length'])): ?>
            <div><em>Comment</em> must be between
                <?php say($register->validation['name']['length'][1]) ?> and
                <?php say($register->validation['name']['length'][2]) ?> characters in length.
            </div>
        <?php endif ?>

        <?php if (!empty($register->validation_errors['username']['length'])|| !empty($user->validation_errors['username']['format'])): ?>
                
            <div><em>Your name</em> must be between
                <?php say($register->validation['username']['length'][1]) ?> and
                <?php say($register->validation['username']['length'][2]) ?> characters in length.
            </div>
        <?php endif ?>

        <?php if (!empty($register->validation_errors['password']['length'])): ?>
                
            <div><em>Your password</em> must be between
                <?php say($register->validation['password']['length'][1]) ?> and
                <?php say($register->validation['password']['length'][2]) ?> characters in length.
            </div>
        <?php endif ?>
 <?php endif ?>
        </div>

<div class="container">
    <div class="row">
        <form role="form" action = "<?php say(url(''))?>" method = "post" onSubmit = "register()">
            <div class="col-lg-6">
                <div class="well well-sm"><strong><span class="icon-asterisk"></span>Required Field</strong></div>
                <div class="form-group">
                    <label for="InputName">Full Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Full Name">
                        <span class="input-group-addon"><span class="icon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputUsername">Username</label>
                     <div class="input-group">
                        <input type="username" class="form-control" id="username" name="username">
                        <span class="input-group-addon"><span class="icon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputEmail">Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="email" name="email">
                        <span class="input-group-addon"><span class="icon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputPassword">Password</label>
                    <div class="input-group">
                        <input type ="Password" name="password" id="password" class="form-control" rows="5">
                        <span class="input-group-addon"><span class="icon-asterisk"></span></span>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
            </div>
        </form>
    </div>
</div>

<?php echo $status;?>