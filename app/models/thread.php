<?php
class Thread extends AppModel
{
    const MIN_TITLE_LENGTH = 1;
    const MAX_TITLE_LENGTH = 30;
    
    public $validation = array(
        'title' => array(
            'length' => array(
                'validate_between', self::MIN_TITLE_LENGTH, self::MAX_TITLE_LENGTH,
            ),
        ),
    );

    /**
    *Select all threads from database
    */
    public static function getAll($total_thread, $category) 
    {
        $threads = array();
        $total_thread = self::count();
        $limited = Pagination::setLimit($total_thread);
        $order_by = self::sortThreads($category);

        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM thread $order_by LIMIT $limited");
        
        foreach ($rows as $row) {
            $threads[] = new self($row);
        }
        return $threads;
    }
    
    /**
    *Select specific thread
    *@param $id 
    */
    public static function get($id) 
    {
        $thread_id = Param::get('thread_id');

        $db = DB::conn();
        $row = $db->row('SELECT * FROM thread WHERE id = ?', array($id));

        if(!$row) {
            throw new ValidationException("Please fill out field!");
        }

        return new self($row);
    }

    public function write(Comment $comment) 
    {
        $params = array(
            "thread_id" => $this->id,
            "username" => $comment->username,
            "body" => $comment->body,
            "created" => date('Y-m-d H:i:s'),
            "user_id" => $_SESSION['id']);

        if (!$comment->validate()) {
            throw new ValidationException('invalid comment');
        }

        $db = DB::conn();
        $db->insert('comment', $params);
    }

    /**
    *Insert validated thread/comments 
    * @param $comment
    */
    public function create(Comment $comment) 
    {
        $params = array(
            "id" => $this->id, 
            "title" => $this->title,
            "created" => date('Y-m-d H:i:s'),
            "user_id" => $_SESSION['id'],
            "username" => $_SESSION['username']);

        $db = DB::conn();

        try{
            $db->begin();

            if (!$this->validate() || !$comment->validate()) {
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

    public static function count() 
    {
        $db= DB::conn();
        $total = $db->value("SELECT COUNT(id) FROM thread");

        return $total;
    }

    public static function sortThreads($category)
    {
        switch($category) {
            case 'title':
                $order_by = 'ORDER BY title';
                break;
            case 'created':
                $order_by = 'ORDER BY created';
                break;
            default:
                $order_by = 'ORDER BY created';
                break;
        }

        return $order_by;
    } 

    public function delete()
    {
        $db = DB::conn();

        $thread = 'DELETE FROM thread WHERE id = ? and user_id = ?';
        $comment = 'DELETE FROM comment WHERE thread_id = ? and user_id = ?';
        $where_params = array($this->id, $_SESSION['id']);
        
        $db->query($thread, $where_params);
        $db->query($comment, $where_params);   
    }
}