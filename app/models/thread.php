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
    *
    *Select all threads from database
    */
    public static function getAll($total_thread, $sort) 
    {
        $threads = array();
        $total_thread = self::count();
        $limited = Pagination::setLimit($total_thread);
        $order_by = self::sortThreads($sort);
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

        return new self($row);
    }

    public function write(Comment $comment) 
    {
        $params = array(
            "thread_id" => $this->id,
            "username" => $comment->username,
            "body" => $comment->body,
            "created" => date('Y-m-d H:i:s'));

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
            "created" => date('Y-m-d H:i:s'));

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
        } 
    }

    public static function count() 
    {
        $db= DB::conn();
        $total = $db->value("SELECT COUNT(id) FROM thread");

        return $total;
    }

    public static function sortThreads($sort)
    {
        switch($sort) {
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

    // public static function delete();
    // {
    //     $db = DB::conn();
    //     $delete = $db->
    // }
}