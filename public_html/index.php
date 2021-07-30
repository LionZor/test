<?php
	require_once 'connect_db.php';
	require_once 'scripts/functions.php';
	require_once 'config.php';
	$page = 1;								//Страница по умолчанию
	$per_page = 4;							//Кол-во элементов на странице по умолчанию

	if(isset($_GET['count'])){
		$per_page = $_GET['count'];
	}

	$count = get_count_news($pdo);			//Общее количество новостей
	$count_page = ceil($count/$per_page);	//Общее количество страниц

	if(isset($_GET['page'])){
		$page = $_GET['page'];
		if($page < 1 || $page > $count_page){
			echo "Ошибка, данная страница еще не найдена";
			exit();
		}
	}

	$news = get_news($pdo, $page, $per_page);
?>
<!DOCTYPE html>
<html>
<head>
	<? include 'templates/links.php'?>
	<link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css">

	<title>Главная</title>
</head>
<body>
	<!-- HEADER !-->
	<?php require 'templates/header.php'?>
	<!-- CONTENT !-->
	<div class="container-fluid">
		<div class="row px-2">
			<a href="/scripts/add_news.php" class="btn btn-light w-100 my-1 col-12">Добавить новость <i class="fas fa-plus"></i></a>
		</div>

		<?php include "templates/slider.php"?>

		<div class="row">
			<?php foreach ($news as $key => $value) {
				$title = $value['title'];
				$image = $value['image_large'];
				$ann = $value['announcement'];
				$date = $value['date'];
				$id = $key;
				require 'templates/news_block.php';
			}
			?>
		</div>
		<!-- PAGINAION !-->
		<?php if($count_page > 1)require 'templates/pagination.php'; ?>
	</div>
	
	<!-- FOOTER !-->
	<?php require 'templates/footer.php'; ?>
</body>
</html>
