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



	<div id="auth">
		<h2 class="auth__title">Регистрация</h2>
		<form action="register.php" class="auth__form" method="POST">
		<div class="block">
			<label>Имя<span style="color:red">*</span></label>
			<input type="text" name="firstname" id="firstname">
		</div>

		<div class="block">
			<label>Фамилия<span style="color:red">*</span></label>
			<input type="text" name="lastname" id="lastname">
		</div>

		<div class="block">
			<label>E-mail<span style="color:red">*</span></label>
			<input type="email" name="email" id="email">
		</div>

		<div class="block">
			<label>Пароль<span style="color:red">*</span></label>
			<input type="password" name="password" id="password">
		</div>

		<div class="block">
			<label>Подтвердите пароль<span style="color:red">*</span></label>
			<input type="password" name="password_check" id="password_check">
		</div>

		<div class="auth__line">
			<input class="btn-red w-100" type="submit" value="Зарегистрироваться">
			<a href="/scripts/login.php" class="btn-red w-100">Войти</a>
		</div>
		</form>
	</div>
</body>
</html>