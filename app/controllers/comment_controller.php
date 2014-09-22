<?php
class CommentController extends AppController 
{
    /**
    *
    *To view comments on each thread
    */
    public function view() 
    {
        confirm_logged_in();

        $thread = array();
        $thread_id = Param::get('thread_id');
        $thread = Comment::getByThreadId($thread_id);

        $total_comment = Comment::count($thread_id);
        $pagination = Pagination::getControls($total_comment); 

        $comments = $thread->getAll($pagination['max'], $thread_id);

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
        $comment = new Comment();
        $page = Param::get('page_next');
        $user_id = $_SESSION['id'];

        switch ($page) {
            case 'write':
                break;
            case 'write_end':
                $comment->username = Param::get('username');
                $comment->body = Param::get('body');
                $comment->user_id = $_SESSION['id'];

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

    public function delete()
    {
        confirm_logged_in();
        
        $comment = Comment::get(Param::get('id'));
        $comment->delete(); 
        redirect($_SERVER['HTTP_REFERER']);

        $this->set(get_defined_vars());
    }
}