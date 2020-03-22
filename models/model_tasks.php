<?php
Class Model_Tasks Extends Model_Base
{
    public $id;   
    public $question;
    public $answer;
    public function fieldsTable()
    {
        return array(
            'id' => 'id',
            'question' => 'question',
            'answer' => 'answer',
        );
    }
}