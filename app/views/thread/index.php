<div class="container">
    <div class="row">
        <div class="col-lg-6">

	    <div class="well well-sm"><span><strong><font size = "6">Hello there! <?php echo $_SESSION['username'];?>
        </font></strong></span>
        </div>
    </div>

<div style="float: right; width: 185px; height: 200px; margin: -70px" >
    <a  name = "logout" href="<?php say(url('thread/logout'));?>">
    Logout
    </a>
</div>

<form class = "form-search" method = "GET">
<div style="float: right; width: 195px; height: 50px;" >
 <select name="sort_by" class="span2">
    <option value="" class="invisible" selected disabled>Sort by</option>
    <option value="title">Title</option>
    <option value="created">Date Created</option>
  </select>
    <button type="submit" name="btnSort" class="btn">Go</button>
</div>
</form>


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