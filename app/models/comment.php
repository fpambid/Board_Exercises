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
            'format' => array(
                'is_title_valid', "Invalid Title",
            ),
        ),
    );

    /**
    *Select comments on each thread
    */
    public function getAll($total_comment, $thread_id) 
    {
        $limited = Pagination::getLimit($total_comment);

        $comments = array();
        $db = DB::conn();

        $rows = $db->search('comment', 'thread_id = ?', array($this->id), 
            'created DESC', $limited);

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
            throw new ValidationException("Thread id not found");
        }

        return new self($row);
    }

    public static function get($id) 
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM comment WHERE id = ?', array($id));

        if(!$row) {
            throw new ValidationException("Comment Not Found");
        }

        return new self($row);
    }

    public static function count($thread_id)
    {
        $db = DB::conn();

        return $db->value('SELECT count(id) FROM comment WHERE thread_id = ?', array($thread_id));
    }

    public function delete()
    {
        $db = DB::conn();
        $db->query('DELETE FROM comment WHERE id = ?', array($this->id));
    }
}
