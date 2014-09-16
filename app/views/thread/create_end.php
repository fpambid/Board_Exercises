<!-- nav -->
 <div class = "row-fluid">
   <div class = "span9 offset11"> 
   
    
     <a  name = "logout" href="<?php say(url('thread/index'));?>" > 
     <i class = "icon-home"></i>
    </a>  &nbsp; &nbsp;
    
    <a  name = "update" href="<?php say(url('user/update'));?>"><i class = "icon-cog"></i>
    </a> &nbsp; &nbsp;
    <a  name = "logout" href="<?php say(url('thread/logout'));?>"
    onClick = "return confirm('Are you sure you want to logout?')"><i class = "icon-off"></i>
    </a> 
    
    </div>
</div>
 <!-- nav -->

<h2><?php say($thread->title) ?></h2>
<p class="alert alert-success">
You successfully created.
</p>
<a href="<?php say(url('comment/view', array('thread_id' => $thread->id))) ?>">
&larr; Go to thread
</a>
