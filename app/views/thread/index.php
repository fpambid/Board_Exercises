<div class="container">
    <div class="row">
        <div class="col-lg-6">

	    <div class="well well-sm"><span><strong><font size = "6">Hello there! <?php echo $_SESSION['username'];?>
        </font></strong></span>
        </div>
    </div>

<div style="float: right; width: 185px; height: 50px; margin: -70px" >
    <a  name = "logout" href="<?php say(url('thread/logout'));?>">
    Logout
    </a>
</div>



       <br/> <h2>All threads</h2>
    <ul>
    <?php foreach ($threads as $v): ?>
        <li>
            <a href="<?php say(url('comment/view', array('thread_id' => $v->id))) ?>">
            <?php say($v->title) ?></a>
            
        </li>
        <?php endforeach ?>
    </ul><br/>

    	<a class="btn btn-large btn-primary" href="<?php say(url('thread/create')) ?>">Create</a>
        <br/>

<div style="float: right; width: 100px; height: 50px;" >
    <?php echo $pagination['control'];?>
</div>
</div>