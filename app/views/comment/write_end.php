<!DOCTYPE html>
<html>
<body>

    <h2><?php say($thread->title) ?></h2>
    <p class="alert alert-success">You successfully wrote this comment.</p>
    <a href="<?php say(url('comment/view', array('thread_id' => $thread->id))) ?>">
    &larr; Back to thread</a>

</body>
</html>>

