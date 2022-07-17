<?php

session_start();
require_once 'funcs.php';

$_SESSION['error'] = $_SESSION['error'] ?? null;
$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;

if (!empty($login) and !empty($password)) {
    if (checkPassword($login, $password)) {
        $_SESSION['auth'] = true;
        $_SESSION['login'] = $login;
        $_SESSION['enterTime'] = time();
        $_SESSION['endTime'] = time() + 86400;
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Неверный логин или пароль';
    }
}

$auth = $_SESSION['auth'] ?? null;
$login = getCurrentUser();
$form = <<<EOT
<section class="news">
<form action="" method="POST">
    Логин: <input name="login"><br>
    Пароль: <input name="password" type="password"><br>
    <input type="submit" value="Войти"><br>
    {$_SESSION['error']}
</form>
</section>
EOT;

$_SESSION['error'] = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPA-салон Абоба</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>SPA-салон Абоба</h1>
</header>

<?php
if ($auth) {
    header('Location: index.php');
    exit;
} else {
    echo $form;
}

?>

<footer>
    <div class="links">
        <a href="#">Вакансии</a>
        <a href="#">Контакты</a>
        <a href="#">О нас</a>
        <a href="#">Реклама</a>
    </div>

    <div class="copyright">
        &#9773;Права рабочих защищены&#9773; 2022
    </div>
</footer>
</body>
</html>