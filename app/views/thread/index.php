	    <h1>Hello there! <?php echo $_SESSION['username'];?><h1>

        <h2>All threads</h2>
    <ul>
    <!--<li>TODO: Link to thread</li>
    <li>TODO: Link to thread</li> -->

    <?php foreach ($threads as $v): ?>
        <li>
            <a href="<?php eh(url('thread/view', array('thread_id' => $v->id))) ?>">
            <?php eh($v->title) ?></a>
            
        </li>
        <?php endforeach ?>
    </ul><br/>

    	<a class="btn btn-large btn-primary" href="<?php eh(url('thread/create')) ?>">Create</a>
        <br/>

        <?php echo $pagination['control'];?>