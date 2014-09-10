<html>
<h1><?php say($thread->title) ?></h1>

	<?php foreach ($comments as $k => $v): ?>

	<div class="comment">
	    <div class="meta">
	        <span class=""></span>
	        <strong><?php say($v->username) ?></strong>
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
	<form class="well" method="post" action="<?php say(url('comment/write')) ?>">
	    <label>Your name</label>
	    <input type="text" class="span2" name="username" value="<?php echo $_SESSION['username'];?>" readonly>
	    <label>Comment</label>
	    <textarea name="body"><?php say(Param::get('body')) ?></textarea> <br />
	    <input type="hidden" name="thread_id" value="<?php say($thread->id) ?>">
	    <input type="hidden" name="page_next" value="write_end">
	    <button type="submit" class="btn btn-primary">Submit</button> 
	</form>
    </hr>

     <a  name = "logout" href="<?php say(url('thread/index'));?>">
    <-- All threads
    </a>

    <div style="float: right; width: 100px; height: 50px;" >
    <?php echo $pagination['control'];?>
</div>

<!--     <button type="button" onclick="<?php say(url('thread/index')) ?>">
	&larr; All threads
	</button>
 -->
</html>
