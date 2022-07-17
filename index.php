<?php

session_start();

require_once 'funcs.php';
$auth = $_SESSION['auth'] ?? null;
$users = getUsersList();
$login = getCurrentUser();

if (isset($_POST['born'])) {
    setcookie('born', $_POST['born'], time() + 3600 * 24 * 365);
}

$born = $_COOKIE['born'] ?? null;

if ($born) {
    $bd = explode('-', $born);
    $bd = mktime(0, 0, 0, $bd[1], $bd[2], date('Y') + ($bd[1] . $bd[2] <= date('md')));
    $days_until = ceil(($bd - time()) / 86400);
}

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

<?php if ($auth): ?>
    <?php
    $_SESSION['startTime'] = time();
    ?>
    <section class="news">
        <h4><a href="logout.php">Выйти</a></h4>
        <h3>Добрый день <?= $login ?></h3>
        <p>Ваша персональная скидка заканчивается через: <?= Timer($_SESSION['endTime'] - $_SESSION['startTime']) ?></p>
    </section>

    <?php if (isset($days_until) and $days_until == 365): ?>
        <section class="news">
            <h4>Поздравляем с Днем Рождения</h4>
            <h3>Дарим вам персональную скидку 5% на все услуги салона</h3>
        </section>
    <?php elseif ($born): ?>
        <section class="news">
            <h4>Дата вашего рождения <?= $born ?></h4>
            <h3>Осталось дней: <?= $days_until ?></h3>
        </section>
    <?php else: ?>
        <section class="news">
            <h4>Введите вашу дату рождения:</h4>
            <form action="" method="post">
                <p>Дата Рождения: <input type="date" name="born"></p>
                <p><input type="submit" value="Сохранить"></p>
            </form>
        </section>
    <?php endif; ?>

<?php else: ?>
    <section class="news">
        <h4><a href="login.php">Войти</a></h4>
    </section>
<?php endif; ?>

<section class="news">
    <article>
        <a href="#">
            <h2>МАССАЖ ЛИЦА - СВЯЩЕННАЯ ПРИРОДА, ОМОЛОЖЕНИЕ И ЭКО-ПИТАНИЕ</h2>
        </a>
        <div class="article-meta">
            Мастер <a href="#">Василий Абоба</a>
            Продолжительность: 60 мин.
        </div>
        <img src="https://thumb.tildacdn.com/tild6638-6234-4236-a564-613965306138/-/format/webp/photo.png">
        <p>Прекрасная возможность совместить полнеценный массаж лица и восстанавливающий уход.
            Идеальное восстановление для всех возрастов и типов кожи. Особенно рекомендуется после загара и в зимнее время года.
            Наполненная нежная кожа, барьеры восстановлены, кожа увлажнена, подтянута, защищена и сияет.</p>
    </article>
</section>

<section class="news">
    <article>
        <a href="#">
            <h2>ВОССТАНОВЛЕНИЕ И АНТИОКСИДАНТНАЯ ЗАЩИТА</h2>
        </a>
        <div class="article-meta">
            Мастер <a href="#">Жмышенко Валерий</a>
            Продолжительность: 60 мин.
        </div>
        <img src="https://www.dobrograd-hotel.ru/upload/iblock/d55/d5549be8f7b3fd8662ee1b4e1769f9d6.jpg">
        <p>Антиоксидантная защита ягод годжи и смеси роскошных масел восстанавливает, улучшает оксигенацию тканей кожи,
            придает здоровое сияние и защищает от вредного действия свободных радикалов.</p>
    </article>
</section>

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