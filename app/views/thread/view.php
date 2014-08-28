<html>
<h1><?php eh($thread->title) ?></h1>

	<?php foreach ($comments as $k => $v): ?>

	<div class="comment">
	    <div class="meta">
	        <span class=""></span>
	        <?php eh($k + 1) ?>: <strong><?php eh($v->username) ?></strong>
	        <div style="float: right; width: 700px; height: 25px;" ><font color="#005C8A"><em>
	            <?php eh($v->created) ?></em></font>
	        </div>
	    </div> 

	<div> <ul>
    <?php echo readable_text($v->body); ?></ul>
    </div>

    <?php endforeach ?>


	<!-- To enable user to write a comment on a thread -->

	<hr>
	<form class="well" method="post" action="<?php eh(url('thread/write')) ?>">
	    <label>Your name</label>
	    <input type="text" class="span2" name="username" value="<?php eh(Param::get('username')) ?>">
	    <label>Comment</label>
	    <textarea name="body"><?php eh(Param::get('body')) ?></textarea> <br />
	    <input type="hidden" name="thread_id" value="<?php eh($thread->id) ?>">
	    <input type="hidden" name="page_next" value="write_end">
	    <button type="submit" class="btn btn-primary">Submit</button> 
	</form>
    </hr>

    <button type="button" onclick="window.location.href='index'">
	&larr; All threads
	</button>

</html>
