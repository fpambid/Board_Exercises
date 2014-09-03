<?php
//Adds validation rule
class Comment extends AppModel
{
    const MIN_USERNAME = 1;
    const MAX_USERNAME = 16;
    const MIN_BODY = 1;
    const MAX_BODY = 200;

    public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', self::MIN_USERNAME, self::MAX_USERNAME,
            ),
        ),
        'body' => array(
            'length' => array(
                'validate_between', self::MIN_BODY, self::MAX_BODY,
                ),
            ),
        );
}
