<?php
class Model_Users extends Model_Base
{
    public $id;
    public $login;
    public $first_name;
    public $last_name;
    public $password;
    public $role;
    public function fieldsTable()
    {
        return array(
            'id' => 'id',
            'login' => 'login',
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'password' => 'password',
            'role' => 'role',
        );
    }
}
