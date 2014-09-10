<?php
class CommentController extends AppController 
{
    /**
    *
    *To view comments on each thread
    */
    public function view() 
    {
         
        $thread = Comment::get(Param::get('thread_id'));
        $comments = $thread->getAll();

        $this->set(get_defined_vars());
    }

    /**
    *
    *Enables users to write a comment 
    */

     public function write() 
    {
         
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

    
    
    


}