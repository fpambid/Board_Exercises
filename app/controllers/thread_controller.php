<?php
class ThreadController extends AppController 
{
    public function index()
    {
    	$title = " ";
        $threads = Thread::getAll();
        //TODO: Get all threads
        $this->set(get_defined_vars());
    }

	/**
	*To view comments on each thread
    **/
    public function view()
    {
        $title = " ";
        $thread = Thread::get(Param::get('thread_id'));
        $comments = $thread->getComments();

        $this->set(get_defined_vars());
    }
    
    /**
    *Enables users to write a comment
    **/
    public function write()
    {
        $title = " ";
        $thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment;
        $page = Param::get('page_next');

        switch ($page) {
		
        case 'write':
            break;

        case 'write_end':
        $comment->username = Param::get('username');
        $comment->body = Param::get('body');
        try{
            $thread->write($comment);
        } catch (ValidationException $e) {
        	$page ='write';
        }    
            break;

        default:
            throw new NotFoundException("{$page} is not found");
            break;
		}

		$this->set(get_defined_vars());
		$this->render($page);
	}

	public function create()
    {
    	
        $title = "";
    	$thread = new Thread;
    	$comment = new Comment;
    	$page = Param::get('page_next', 'create');
    	switch ($page) {
    	case 'create':
    		break;
    	case 'create_end':
    	$thread->title = Param::get('title');
    	$comment->username = Param::get('username');
    	$comment->body = Param::get('body');
    try {
        $thread->create($comment);
    } catch (ValidationException $e) {
        $page = 'create';
      }
      break;
	default:
	throw new NotFoundException("{$page} is not found");
	break;
	}
	$this->set(get_defined_vars());
	$this->render($page);
	}



}
