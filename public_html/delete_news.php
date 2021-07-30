<?php
require_once 'connect_db.php';
require_once 'scripts/functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        delete_news($pdo, $id);
        header('Location: http://'.$_SERVER['HTTP_HOST']);
    }
    else {
        echo 'ошибка';
    }

}
