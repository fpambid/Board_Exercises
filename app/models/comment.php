<?php
/**
*Adds validation rule
*/
class Comment extends AppModel
{

    const MIN_BODY_LENGTH = 1;
    const MAX_BODY_LENGTH = 200;

    public $validation = array(
        'body' => array(
            'length' => array(
                'validate_between', self::MIN_BODY_LENGTH, self::MAX_BODY_LENGTH
            ),
        ),
    );

    /**
    *Select comments on each thread
    */
    public function getAll($total_comment, $thread_id) 
    {
        $total_comment = $this->count($thread_id);
        $limited = Pagination::setLimit($total_comment);

        $comments = array();
        $db = DB::conn();
        $where = "thread_id = ?";
        $where_params = array($this->id);
        $order = "created ASC";

        $rows = $db->search('comment', $where, $where_params, $order, $limited);

        foreach ($rows as $row) {
            $comments[] = new Comment($row);
        }
        return $comments;
    }

    public static function getByThreadId($id) 
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM thread WHERE id = ?', array($id));

        if(!$row) {
            throw new ValidationException("Please fill out fields!");
        }

        return new self($row);
    }

    public static function getComment($id) 
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM comment WHERE id = ?', array($id));

        if(!$row) {
            throw new ValidationException("Please fill out fields!");
        }

        return new self($row);
    }

    public static function count($thread_id)
    {
        $db = DB::conn();
        $query = 'SELECT COUNT(id) from comment WHERE thread_id = ?';
        $where_params = array($thread_id);

        $count = $db->value($query, $where_params);

        return $count;
    }

    public function delete()
    {
        $db = DB::conn();
        $query = 'DELETE FROM comment WHERE id = ?';
        $where_params = array($this->id);
        $db->query($query, $where_params);  
    }
}
