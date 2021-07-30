<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<link rel="stylesheet" type="text/css" href="../styles/auth.css">
	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title>Регистрация</title>
</head>
<body>

	<header>
		<a href="/index.php"><h1 class="header__title">Новости</h1></a>

	</header>


	<div class="form ">
		<form action="login.php" method="POST">
		
		<h2 class="form-title">Авторизация</h2>
		<hr/>
		<div class="block">
			<label>E-mail<span style="color:red">*</span></label>
			<input  type="email" name="email" id="email">
		</div>

		<div class="block">
			<label>Пароль<span style="color:red">*</span></label>
			<input type="password" name="password" id="pawssword">
		</div>
		<hr>
		<div class="auth__line">
			<input class="btn-red w-100" type="submit" value="Вход">
		</div>
		</form>
	</div>
</body>
</html>