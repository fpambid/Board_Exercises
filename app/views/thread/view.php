<html>
<h1><?php say($thread->title) ?></h1>

	<?php foreach ($comments as $k => $v): ?>

	<div class="comment">
	    <div class="meta">
	        <span class=""></span>
	        <?php say($k + 1) ?>: <strong><?php say($v->username) ?></strong>
	        <div style="float: right; width: 700px; height: 25px;" ><font color="#005C8A"><em>
	            <?php say($v->created) ?></em></font>
	        </div>
	    </div> 

	<div> 
	<ul>
    <?php echo readable_text($v->body); ?>
    </ul>
    </div>

    <?php endforeach ?>


	<!-- To enable user to write a comment on a thread -->

	<hr>
	<form class="well" method="post" action="<?php say(url('thread/write')) ?>">
	    <label>Your name</label>
	    <input type="text" class="span2" name="username" value="<?php say(Param::get('username')) ?>">
	    <label>Comment</label>
	    <textarea name="body"><?php say(Param::get('body')) ?></textarea> <br />
	    <input type="hidden" name="thread_id" value="<?php say($thread->id) ?>">
	    <input type="hidden" name="page_next" value="write_end">
	    <button type="submit" class="btn btn-primary">Submit</button> 
	</form>
    </hr>

    <button type="button" onclick="window.location.href='index'">
	&larr; All threads
	</button>

</html>
