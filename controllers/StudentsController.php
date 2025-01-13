<?php
require_once 'models/StudentsModel.php';

class StudentsController {
    private $model;

    public function __construct() {
        $this->model = new StudentsModel();
    }

    public function index() {
        $students = $this->model->getStudentsFromDB();
        require 'views/default.php';
    }

   public function addStudent()
{
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $group_id = $_POST['group_id'] ?? 0;

            if (!$name || !$group_id) {
                throw new Exception("Некорректные данные: Имя или группа отсутствуют.");
            }

            if ($this->model->addStudent($name, $group_id)) {
                header('Location: /college/students');
                exit();
            } else {
                throw new Exception("Ошибка при добавлении студента в базу данных.");
            }
        }
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}

    public function actions() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete'])) {
                $id = intval($_POST['id']);
                $this->model->deleteStudentFromDB($id);
            }

            header('Location: /college/');
            exit;
        }
    }
}
?>
