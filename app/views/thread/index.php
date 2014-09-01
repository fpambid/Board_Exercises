
	    <h1>Hello there! <?php echo $_SESSION['username'];?></h1>

<div style="float: right; width: 20px; height: 50px; margin: -70px" >
    <a class = "btn btn-primary btn-lg" name = "logout" href="<?php eh(url('thread/logout'));?>">
    Logout
    </a>
</div>

       <br/> <h2>All threads</h2>
    <ul>
    <?php foreach ($threads as $v): ?>
        <li>
            <a href="<?php eh(url('thread/view', array('thread_id' => $v->id))) ?>">
            <?php eh($v->title) ?></a>
            
        </li>
        <?php endforeach ?>
    </ul><br/>

    	<a class="btn btn-large btn-primary" href="<?php eh(url('thread/create')) ?>">Create</a>
        <br/>

<div style="float: right; width: 50px; height: 50px;" >
    <?php echo $pagination['control'];?>
</div>