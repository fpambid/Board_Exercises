<html>

<div class="container">
    <div class="row">
        <div class="col-lg-6">

            <div style="float: right; width: 600px; height: 25px;">
                <?php if ($thread->user_id == $_SESSION['id']):?>
        	        <a href="<?php say(url('thread/delete', array('id' => $thread->id)));?>" 
                    onClick = "return confirm('Are you sure you want to delete this thread?')">
                    <i class="icon-trash"></i></a>
                <?php endif ?>
            </div>
        <h1><?php say($thread->title) ?></h1>

        <em>author: <?php say($thread->username)?></em> <br/> <br/>

        <!-- To enable user to write a comment on a thread -->

        <form class="well" method="post" action="<?php say(url('comment/write')) ?>">
            <input placeholder = "Your name" type="text" class="span2" name="username" value="<?php echo $_SESSION['username'];?>" readonly> 
            <div class=”col-lg-4 col-md-4 col-sm-5″>
            <textarea class="form-control" name="body" placeholder = "Join the discussion.."><?php say(Param::get('body')) ?></textarea> <br />
            <input type="hidden" name="thread_id" value="<?php say($thread->id) ?>">
            <input type="hidden" name="page_next" value="write_end">
            <button type="submit" class="btn btn-primary">Submit</button> 
            </div>
        </form>

    	<?php foreach ($comments as $k => $v): ?>
	        
            <div class="container">
	        <span class=""></span>
            <table style="width:30%">
            <tr>
            <td>

	            <font color="#008AB8"><strong><?php say($v->username) ?> </strong></font> &nbsp; <i class = "icon-time"></i>
	            <font color="#808080" size="1px"><?php say($v->created) ?></font> 
                <div>
                <?php echo readable_text($v->body); ?>
                </div>
            </td>
            <td>
                <?php if ($v->username == $_SESSION['username']): ?> 

                    <a href="<?php say(url('comment/delete', array('id' => $v->id)));?>" 
                    onClick = "return confirm('Are you sure you want to delete this comment?')">
                    <i class="icon-trash"></i></a><br/>

                <?php endif ?>
	        </div> 
            </td>
            </tr>
            </table>   
	    </div> <br/>

        <?php endforeach ?>

            <div style="float: right; width: 100px; height: 50px;" >
                <?php echo $pagination['control'];?>
            </div>
        </div>
     </div>
</div>

