<?php
    require_once 'config.php';
    require_once 'scripts/validates.php';
    require_once 'connect_db.php';
    require_once 'scripts/functions.php';

    if(isset($_REQUEST['id'])){
        $id = (int) $_REQUEST['id'];

        //Если передан неккоректный id
        if($id == 0){
            echo "Ошибка(Неверный id)";
            exit();
        }

        //Если переданы все нужные данные, то обрабатываем их
        if(isset($_POST['title'])
        && isset($_POST['anons'])
        && isset($_POST['full_news'])
        && isset($_POST['date'])
        && isset($_POST['old_image'])){
            $title = filter($_POST['title']);
            $e1 = validate_text($title, 10);

            $anons = filter($_POST['anons']);
            $e3 = validate_text($anons,16);

            $full_news = filter($_POST['full_news']);
            $e4 = validate_text($full_news);

            $date = filter($_POST['date']);
            $old_file = $_POST['old_image'];
            $image = $old_file;

            //Загрузка файла на сервер
            if($_FILES['image']['tmp_name']){
                $tmp_name = $_FILES['image']['tmp_name'];
                $extension = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
                $file_name = get_random_file_name($doc_root . $image_dir,$extension);
                $path = $image_dir . '/' . $file_name . '.' . $extension;
                $img = $path;
                $path = $doc_root . $path;
                move_uploaded_file($tmp_name, $path);

                $_POST['file_name'] = $img;

                $path = $doc_root . '/' . $old_file;
                unlink($path);
            } else {
                $_POST['file_name'] = $old_file;
            }
            if(!($e1 || $e3 || $e4)){
                update_news($pdo, $_POST);
                header('Location: http://'.$_SERVER['HTTP_HOST']);
            }
        } 
        //Иначе выводим форму для редактирования
        else {
            $news = get_news_by_id($pdo, $id);
            if(!$news){
                echo "Новость с данным id не найдена";
                exit();
            }
            $id    = $news['id'];
            $title = $news['title'];
            $anons = $news['announcement'];
            $full_news = $news['text'];
            $image = $news['image_large'];
            $date = $news['date'];
            $path = $image_dir . '/' . $image;
        }
    }
    else {
        echo "Ошибка";
        exit();
    }

?>
<!DOCTYPE html>
<html>
<head>
    <? include 'templates/links.php'?>
	<title>Редактировать новость</title>
</head>
<body>
	<!-- HEADER !-->
	<?php include $_SERVER['DOCUMENT_ROOT'].'/templates/header.php'?>

	<!-- CONTENT !-->
    <div class="container my-5">

    		<form class="border px-5 py-2 " enctype="multipart/form-data" action="edit_news.php" method="POST">
    		<h2 class="form-title">Редактирование новости</h2>
    		<div class="block">
    			<label>Заголовок<span style="color:red">*</span></label>
    			<input class="form-control" value="<?=$title?>" type="text" name="title" id="title">
                <div class="text-danger text-center"><?=@$e1?></div>
    		</div>

    		<div class="form-group">
    			<label>Изображение<span style="color:red">*</span></label>
                <img src="<?=$image?>" width="100%" />
                <div class="custom-file">
					<input type="file" name="image" class="custom-file-input" id="customFile">
					<label class="custom-file-label" for="customFile">Выберите файл</label>
				</div>
                <div class="text-danger text-center"><?=@$e2?></div>
    		</div>
            <input type="hidden" name="old_image" value="<?=$image?>">
            <input type="hidden" name="id" value="<?=$id?>"  />

    		<div class="form-group">
    			<label>Текст анонса<span style="color:red">*</span></label>
    			<input  class="form-control" value="<?=$anons?>" type="text" name="anons" id="anons">
                <div class="text-danger text-center"><?=@$e3?></div>
    		</div>
    		<div class="form-group">
    			<label>Текст новости<span style="color:red">*</span></label>
    			<textarea  class="form-control" name="full_news" rows=20><?=$full_news?></textarea>
                <div class="text-danger text-center"><?=@$e4?></div>
    		</div>
    		<div class="form-group">
    			<label>Дата<span style="color:red">*</span></label>
    			<input class="form-control" value="<?=$date?>" type="date" name="date">
                <div class="text-danger text-center"><?=@$e5?></div>
    		</div>
    		
            <input class="btn btn-primary btn-block" type="submit" value="Готово">
    		</form>
    </div>

	<!-- FOOTER !-->
    <?php include $_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'?>
</body>
</html>
