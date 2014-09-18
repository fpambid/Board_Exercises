<?php
class ThreadController extends AppController 
{
    public function index() 
    {
        confirm_logged_in();

        $user = new User();
        $values = $user->updateSession();
        $_SESSION['username'] = $values['username'];

        $total_thread = Thread::count();
        $pagination = Pagination::setControls($total_thread);
        $sort = Param::get('sort_by');

        $threads = Thread::getAll($pagination['max'], $sort);
        $this->set(get_defined_vars());
    }

    /**
    *
    *Enables users to write a comment
    */
    public function write() 
    {
        confirm_logged_in();

        $thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment;
        $page = Param::get('page_next');
        $user_id = $_SESSION['id'];

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
        confirm_logged_in();

        $uname = $_SESSION['username'];
        $user_id = $_SESSION['id'];
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

    public function logout() 
    {
        session_destroy();
        redirect('../');
    }

    public function delete()
    {
        confirm_logged_in();

        $user_id = $_SESSION['id'];
        $thread = Thread::get(Param::get('id'));

        $thread->delete();
        redirect('index');

        $this->set(get_defined_vars());
    }
}
