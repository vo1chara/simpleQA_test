<?php
// абстрактый класс контроллера
abstract class Controller_Base
{
    protected $registry;
    protected $template;
    protected $layouts; // шаблон

    public $vars = array();
    // в конструкторе подключаем шаблоны
    function __construct()
    {
        if (session_id() == '') {
            session_start();
        }
        // шаблоны
        $this->template = new Template($this->layouts, get_class($this));
    }
    protected function normalize($postVar)
    {
        if (isset($this->$postVar)) {
            if ($this->$postVar == '') {
                unset($this->$postVar);
            }
        }
        $this->$postVar = stripslashes($postVar);
        $this->$postVar = htmlspecialchars($postVar);
        $this->$postVar = trim($postVar);
        return $this->$postVar;
    }
    abstract function index();
}
