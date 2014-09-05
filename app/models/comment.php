<?php
/**
*Adds validation rule
*
*/
class Comment extends AppModel
{
    const MIN_USERNAME_LENGTH = 1;
    const MAX_USERNAME_LENGTH = 16;
    const MIN_BODY_LENGTH = 1;
    const MAX_BODY_LENGTH = 200;

    public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', self::MIN_USERNAME_LENGTH, self::MAX_USERNAME_LENGTH,
            ),
        ),
        'body' => array(
            'length' => array(
                'validate_between', self::MIN_BODY_LENGTH, self::MAX_BODY_LENGTH,
            ),
        ),
    );

    /**
    *Select comments on each thread
    */
    public function getComments() 
    {
        $comments = array();
        $db = DB::conn();

        $rows = $db->search('comment', 'thread_id = ?', array($this->id), 'created ASC' );

        foreach ($rows as $row) {
            $comments[] = new Comment($row);
        }
        return $comments;
    }

    public static function get($id) 
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM thread WHERE id = ?', array($id));

        return new self($row);
    }
}
