<?php
	require_once 'scripts/functions.php';
	require_once 'connect_db.php';
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$news = get_news_by_id($pdo, $id); //Получаем информацию о новости
		if(!$news){
			echo "Страница не найдена";
			return;
		}
		$title = $news['title'];
		$text = nl2br($news['text']);
		$image = $news['image_large'];
		$date = $news['date'];
	}
	else {
		echo "Ошибка";
		return;
	}


?>
<!DOCTYPE html>
<html>
<head>
	<? include 'templates/links.php'?>
	<title>Главная</title>
</head>
<body>
	<!-- HEADER !-->

		<?php require $_SERVER['DOCUMENT_ROOT'].'/templates/header.php'?>

	<!-- CONTENT !-->

	<div class="container my-5 border p-0">
		<h2 class="text-center bg-light m-0 p-2 shadow" ><?=$title?></h2>
		<img class="w-100" src="<?=$image?>" alt="Фото новости">
		<div class="m-3"><?=$text?></div>
		<div class="row m-1 d-flex justify-content-between">
			<h3 class="align-text-bottom m-0 text-center s"><?=$date?></h3>
			<a class="btn btn-primary text-center" href="/">Назад</a>
		</div>

	</div>



	<!-- FOOTER !-->
	<?php require $_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'?>

</body>
</html>
