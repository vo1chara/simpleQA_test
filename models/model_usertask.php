<?php
Class Model_Usertask Extends Model_Base
{
    public $id;   
    public $id_question;
    public $id_user;
    public $answer;
    public function fieldsTable()
    {
        return array(
            'id' => 'id',
            'id_question' => 'id_question',
            'id_user' => 'id_user',
            'answer' => 'answer',
        );
    }
}