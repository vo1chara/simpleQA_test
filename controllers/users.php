<?php
// контролер
class Controller_Users extends Controller_Base
{
    // шаблон
    public $layouts = "first_layouts";
    // экшен
    function index()
    {
        $this->template->view('index');
    }
    private function checkPassword($login, $pass)
    {
        $row = $this->getRowByLogin($login);
        $passFromBase = $row['password'];
        if ($pass == $passFromBase) {
            return true;
        } else {
            return false;
        }
    }
    private function getRowByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = '$email'"; //sql запрос к бд
        $model = new Model_Users($sql); // создаем объект модели
        $rows = $model->getOneRow(); // получаем все строки
        return $rows;
    }
    private function getRowByLogin($login)
    {
        $sql = "SELECT * FROM users WHERE login = '$login'"; //sql запрос к бд
        $model = new Model_Users($sql); // создаем объект модели
        $rows = $model->getOneRow(); // получаем все строки
        return $rows;
    }
    private function reg($Login = NULL, $First_name = NULL, $Last_name = NULL, $Password = NULL, $RepeatRassword = NULL)
    {
        if ($Password === $RepeatRassword) {
            $check = $this->getRowByLogin($Login);
            if ($check['login'] == $Login) {
                $error = ['error' => 'Этот login уже заригестрирован'];
                return $error;
            };
            $sql = "INSERT INTO users (login,first_name,last_name,password) VALUES('$Login','$First_name','$Last_name','$Password')";
            $reg = Model_Base::connect()->prepare($sql);
            $reg->execute();
            $userData = $this->getRowByLogin($Login);
            $_SESSION['id'] = $userData['id'];
            $_SESSION['login'] = $userData['login'];
            $_SESSION['first_name'] = $userData['first_name'];
            $_SESSION['last_name'] = $userData['last_name'];
            $_SESSION['role'] = $userData['role'];
        } else {
            $error = ["error" => "Ошибка регистрации"];
            return $error;
        }
    }
    function login()
    {
        if (isset($_POST['login'])) {
            $login = $this->normalize($_POST['login']);
        } else {
            $errors[] = json_encode(["error" => "Вы не ввели login"]);
        }
        if (isset($_POST['password'])) {
            $password = $this->normalize($_POST['password']);
        } else {
            $errors[] = json_encode(["error" => "Вы не ввели пароль"]);
        }
        if (empty($errors)) {
            if ($this->checkPassword($login, $password)) {
                $userData = $this->getRowByLogin($login);
                $_SESSION['id'] = $userData['id'];
                $_SESSION['login'] = $userData['login'];
                $_SESSION['first_name'] = $userData['first_name'];
                $_SESSION['last_name'] = $userData['last_name'];
                $_SESSION['role'] = $userData['role'];
                header('location: http://localhost/simpleQA/');
            } else {
                echo 'Неверый пароль';
            }
        }
        $this->template->view('login');
    }
    function registration()
    {
        $error = [];
        $succes = [];
        if (isset($_POST['login'])) {
            $login = $this->normalize($_POST['login']);
        } else {
            $errors[] = json_encode(["error" => "Вы не ввели login"]);
        }
        if (isset($_POST['firstname'])) {
            $firstname = $this->normalize($_POST['firstname']);
        } else {
            $errors[] = json_encode(["error" => "Вы не ввели имя"]);
        }
        if (isset($_POST['lastname'])) {
            $lastname = $this->normalize($_POST['lastname']);
        } else {
            $errors[] = json_encode(["error" => "Вы не ввели фамиллию"]);
        }
        if (isset($_POST['password'])) {
            $password = $this->normalize($_POST['password']);
        } else {
            $errors[] = json_encode(["error" => "Вы не ввели password"]);
        }
        if (isset($_POST['repeatPassword'])) {
            $repeatPassword = $this->normalize($_POST['repeatPassword']);
        } else {
            $errors[] = json_encode(["error" => "Вы не ввели repeatPassword"]);
        }
        if (empty($errors)) {
            $succes = [
                "login" => $login,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "password" => $password
            ];
            if (!empty($succes)) {
                $this->reg($login, $firstname, $lastname, $password, $repeatPassword);
            }
            $result = $succes;
        } else {
            $result = $error;
        }
        $this->template->vars('result', $result);
        $this->template->view('registration');
    }
    function logOut()
    {
        unset($_SESSION);
        session_destroy();
        header('location: http://localhost/simpleQA/');
    }
}
