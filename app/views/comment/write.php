<h2><?php say($thread->title) ?></h2>
    <?php if ($comment->hasError()): ?>
        <div class="alert alert-block">
            <h4 class="alert-heading">Validation error!</h4>
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

            <?php if (!empty($comment->validation_errors['body']['format'])): ?>
                <div> That's invalid! Say something!
                </div>
            <?php endif ?>


        </div>
    <?php endif ?>

<form class="well" method="post" action="<?php say(url('comment/write')) ?>">
    <input type="text" class="span2" name="username" value="<?php echo $_SESSION['username'];?>" readonly>
    <label>Comment</label>
    <textarea name="body"><?php say(Param::get('body')) ?></textarea><br />
    <input type="hidden" name="thread_id" value="<?php say($thread->id) ?>">
    <input type="hidden" name="page_next" value="write_end">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
