<?php
class Thread extends AppModel
{
    const MIN_TITLE = 1;
    const MAX_TITLE = 30;
    
    public $validation = array(
        'title' => array(
            'length' => array(
                'validate_between', self::MIN_TITLE, self::MAX_TITLE,
                ),
            ),
        );

    /**
    *Select all threads from database
    */

    public static function getAll($limit) 
    {
        $threads = array();
        $limit = Thread::countThread();
        $limits = new Pagination();
        $limited = $limits::setLimit($limit);
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM thread $limited");
        
        foreach ($rows as $row) {
            $threads[] = new self($row);
        }
    return $threads;
    }
    
    /**
    *Select specific thread
    **@param $id 
    **/

    public static function get($id) 
    {
        $db = DB::conn();

        $query = 'SELECT * FROM thread WHERE id = ?';
        $params = array($id);
        $row = $db->row($query, $params);

        return new self($row);
    }

    /**
    *Select comments on each thread
    **@throws ValidationException
    **/

    public function getComments() 
    {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows('SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC',
            array($this->id));

        foreach ($rows as $row) {
            $comments[] = new Comment($row);
        }
        return $comments;
    }
    
    public function write(Comment $comment) 
    {
        $params = array(
            "thread_id" => $this->id,
            "username" => $comment->username,
            "body" => $comment->body);

        if (!$comment->validate()) {
        throw new ValidationException('invalid comment');
        }

        $db = DB::conn();
        $db->insert('thread_id', $params);
    }

    /**
    ** Insert validated thread/comments 
    ** @param $comment
    **/
    public function create(Comment $comment) 
    {
        $params = array(
            "id" => $_SESSION['id'], 
            "title" => $this->title,
            "created" => date('Y-m-d H:i:s'));

        $db = DB::conn();

        try{
            $db->begin();

            $this->validate();
            $comment->validate();
            if ($this->hasError() || $comment->hasError()) {
                throw new ValidationException('invalid thread or comment');
            }

            $db->insert('thread', $params);

            $this->id = $db->lastInsertId();
            $this->write($comment);

            $db->commit();

        } catch (ValidationException $e) {
            $db->rollback();
            throw $e;
        } 
    }

    public static function countThread() 
    {
        $db= DB::conn();
        $total = $db->value("SELECT COUNT(id) FROM thread");

        return $total;
    }
     //count number of rows
}