

<h2><?php say($thread->title) ?></h2>
<p class="alert alert-success">
You successfully created.
</p>
<a href="<?php say(url('comment/view', array('thread_id' => $thread->id))) ?>">
&larr; Go to thread
</a>
