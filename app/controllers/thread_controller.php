<?php
class ThreadController extends AppController 
{
    public function index() 
    {
        $total_thread = Thread::count();
        $pagination = Pagination::setControls($total_thread);
        $sort = Param::get('sort_by');

        $threads = Thread::getAll($pagination['max'], $sort);
        $this->set(get_defined_vars());
    }

    
    
    public function create() 
    {
         
        $uname = $_SESSION['username'];
        $thread = new Thread;
        $comment = new Comment;
        $page = Param::get('page_next', 'create');

        switch ($page) {
        case 'create':
            break;
        case 'create_end':
            $thread->title = Param::get('title');
            $comment->username = $uname;
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

    function logout() 
    {
        session_destroy();
        redirect('../');
    }
}
