
	    <h1>Hello there! <?php echo $_SESSION['username'];?></h1>

<div style="float: right; width: 185px; height: 50px; margin: -70px" >
    <a class = "btn btn-primary btn-lg" name = "logout" href="<?php say(url('thread/logout'));?>">
    Logout
    </a>
</div>

       <br/> <h2>All threads</h2>
    <ul>
    <?php foreach ($threads as $v): ?>
        <li>
            <a href="<?php say(url('thread/view', array('thread_id' => $v->id))) ?>">
            <?php say($v->title) ?></a>
            
        </li>
        <?php endforeach ?>
    </ul><br/>

    	<a class="btn btn-large btn-primary" href="<?php say(url('thread/create')) ?>">Create</a>
        <br/>

<div style="float: right; width: 200px; height: 50px;" >
    <?php echo $pagination['control'];?>
</div>