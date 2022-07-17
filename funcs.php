<?php

function getUsersList()
{
    return include('users.php');
}

function existsUser($login)
{
    $arrUsers = getUsersList();
    $users = array_keys($arrUsers);

    if (in_array($login, $users)) {
        return true;
    } else {
        return false;
    }
}

function checkPassword($login, $password)
{
    $arrUsers = getUsersList();
    $hash = md5($password);

    if (existsUser($login) && $hash === $arrUsers[$login]['password']) {
        return true;
    } else {
        return false;
    }
}

function getCurrentUser()
{
    return $_SESSION['login'] ?? null;
}

function Timer($time)
{
    $h = intdiv($time, 3600);
    $h = str_pad($h,2 , '0', STR_PAD_LEFT);
    $time = bcmod($time, 3600);
    $m = intdiv($time, 60);
    $m = str_pad($m,2 , '0', STR_PAD_LEFT);
    $s = bcmod($time, 60);
    $s = str_pad($s,2 , '0', STR_PAD_LEFT);
    return "$h:$m:$s";
}

?>
