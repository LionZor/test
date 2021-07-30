<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/validates.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/connect_db.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$error_flag = false;

    //Получение текстовых данных из формы
	$title = filter($_POST['title']);
	$e1 = validate_text($title,5);

	$anons = filter($_POST['anons']);
	$e3 = validate_text($anons,5);

	$full_news = filter($_POST['full_news']);
	$e4 = validate_text($full_news, 5);

	$date = filter($_POST['date']);

    //Загрузка файла на сервер
    $tmp_name = $_FILES['image']['tmp_name'];
    if($tmp_name){
        $extension = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
        $file_name = get_random_file_name($doc_root . $image_dir,$extension);
		$path = $image_dir . '/' . $file_name . '.' . $extension;
		$img = $path;
		$path = $doc_root . $path;

		//Перемещаем временный файл в нужную дирректорию
		move_uploaded_file($tmp_name, $path);
		$_POST['file_name'] = $img;
		$file_flag = true;
	}
	else if($_POST['img'] ?? ''){
		$img = $_POST['img'];
		$_POST['file_name'] = $img;
	}
	else {
		$e2 = "Выберите изображение для новости";
	}

	if($e1 || $e2 || $e3 || $e4){
		$error_flag = true;
	}


	if(!$error_flag){
		echo $omg;
		add_news_in_db($pdo, $_POST);
		header('Location: http://'.$_SERVER['HTTP_HOST']);
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<? include '../templates/links.php'?>
	<title>Добавить новость</title>
</head>
<body>
	<!-- HEADER !-->
	<?php include $_SERVER['DOCUMENT_ROOT'].'/templates/header.php'?>

	<!-- CONTENT !-->
    <div class="container my-5">
    		<form class="border px-5 py-2" enctype="multipart/form-data" action="add_news.php" method="POST">
    		<h2 class="text-center">Добавить новость</h2>
    		<div class="form-group">
    			<label>Заголовок<span style="color:red">*</span></label>
    			<input  class="form-control" type="text" name="title" id="title" value="<?=@$title?>">
				<div class="text-danger text-center"><?=@$e1?></div>
    		</div>

    		<div class="form-group">
			<label>Изображение<span style="color:red">*</span></label>
				<div class="custom-file">
					<input type="file" name="image" class="custom-file-input" id="customFile">
					<label class="custom-file-label" for="customFile">Выберите файл</label>
				</div>
				<img src="<?=@$img?>" width="70%">
				<div class="text-danger text-center"><?=@$e2?></div>
				<input type="hidden" name="img" value="<?=@$img?>">
    		</div>


    		<div class="form-group">
    			<label>Текст анонса<span style="color:red">*</span></label>
    			<input  class="form-control" type="text" name="anons" id="anons" value="<?=@$anons?>">
				<div class="text-danger text-center"><?=@$e3?></div>
    		</div>
    		<div class="form-group">
    			<label>Текст новости<span style="color:red">*</span></label>
    			<textarea class="form-control" name="full_news" rows=10><?=@$full_news?></textarea>
				<div class="text-danger text-center"><?=@$e4?></div>
    		</div>
    		<div class="form-group">
    			<label>Дата<span style="color:red">*</span></label>
    			<input class="form-control" type="date" name="date" value="<?=@$date?>">
				<div class="error"><?=@$e5?></div>
    		</div>
    		<input class="btn btn-primary btn-block" type="submit" value="Добавить">
    		</form>
    </div>

	<!-- FOOTER !-->
    <?php include $_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'?>
</body>
</html>
