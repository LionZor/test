<?php
	function get_all_news($db){
		$q = "SELECT * FROM news ORDER BY date DESC LIMIT 10";	// Извлекаем все данные из БД
		$stmt = $db->query($q);
		$news =  $stmt->fetchAll(PDO::FETCH_UNIQUE);
		return $news;
    }
    
    function get_news($db, $page = null, $count = 3){
        $start = ($page - 1) * $count;  //Высчитываем позицию первой новости для страницы
        $q = "SELECT * FROM news ORDER BY date DESC LIMIT ?, ?";
        $stmt = $db->prepare($q);
        $stmt->execute(array($start, $count));
        $news = $stmt->fetchAll(PDO::FETCH_UNIQUE);
        return $news;
    }

    function get_count_news($db){
        $q = "SELECT COUNT(*) as count FROM news";
        $members=$db->query($q)->fetchColumn();
        return $members;
    }

	function get_news_by_id($db, $id){
		$q = "SELECT * FROM news WHERE id=? ORDER BY date DESC LIMIT 10";
		$stmt = $db->prepare($q);
		$stmt->execute(array($id));
		$news = $stmt->fetch(PDO::FETCH_LAZY);
		return $news;
	}

    function add_news_in_db($db, $news){
        $title = $news['title'];
        $anons = $news['anons'];
        $date  = $news['date'];
        $full_news = $news['full_news'];
        $file_name = $news['file_name'];
        $q = 'INSERT INTO news
        (title, image_large, announcement, text, date, image_small)
        VALUES (?,?,?,?,?,?)';
        $stmt = $db->prepare($q);
        $stmt->execute(array($title, $file_name, $anons, $full_news, $date, $file_name));

    }

    function get_random_file_name($path, $extension = ''){
        $extension = $extension ? '.' . $extension : '';
        $path ? $path . '/' : '';

        do {
            $name = uniqid();
            $file = $path . $name . $extension;
        } while (file_exists($file));

        return $name;
    }

    function delete_news($db, $id){
        $q = "DELETE FROM news WHERE id=?";
        $stmt = $db->prepare($q);
        $stmt->execute(array($id));
    }

    function update_news($db, $news){
        $title = $news['title'];
        $anons = $news['anons'];
        $date  = $news['date'];
        $full_news = $news['full_news'];
        $file_name = $news['file_name'];
        $id = $news['id'];
        $q = "UPDATE news
        SET title=?,image_large=?,image_small=?,announcement=?,text=?,date=?
        WHERE id=?";
        $stmt = $db->prepare($q);
        $stmt->execute(array($title, $file_name, $file_name,
                            $anons, $full_news, $date, $id));
    }

    function filter($str){
        $str = trim($str);
        $str = strip_tags($str);
        $str = htmlspecialchars($str);
        $str = stripcslashes($str);
        return $str;
    }