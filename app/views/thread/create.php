
<h1>Create a thread</h1>
    <?php if ($thread->hasError() || $comment->hasError()): ?>
    	<div class="alert alert-block">
    	<h4 class="alert-heading">Validation error!</h4>
    	<?php if (!empty($thread->validation_errors['title']['length'])): ?>
    		<div><em>Title</em> must be between
    		<?php say($thread->validation['title']['length'][1]) ?> and
    		<?php say($thread->validation['title']['length'][2]) ?> characters in length.
    		</div>
    	<?php endif ?>
    	<?php if (!empty($comment->validation_errors['username']['length'])): ?>
    		<div><em>Your name</em> must be between
    		<?php say($comment->validation['username']['length'][1]) ?> and
    		<?php say($comment->validation['username']['length'][2]) ?> characters in length.
    		</div>
    	<?php endif ?>
    	<?php if (!empty($comment->validation_errors['body']['length'])): ?>
    		<div><em>Comment</em> must be between
    		<?php say($comment->validation['body']['length'][1]) ?> and
    		<?php say($comment->validation['body']['length'][2]) ?> characters in length.
    		</div>
    	<?php endif ?>
        <?php if (!empty($comment->validation_errors['title']['format'])): ?>
            <div> Invalid Title!
            </div>
        <?php endif ?>
        
    	</div>
    <?php endif ?>

    <form class="well" method="post" action="<?php say(url('')) ?>">
        <input placeholder = "Title" type="text" class="span2" name="title" value="<?php say(Param::get('title')) ?>"><br/>
        <input type="text" class="span2" name="username" value="<?php echo $_SESSION['username'];?>" readonly><br/>
        <textarea placeholder = "Shout it out!" name="body"><?php say(Param::get('body')) ?></textarea>
        <br />
        <input type="hidden" name="page_next" value="create_end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
