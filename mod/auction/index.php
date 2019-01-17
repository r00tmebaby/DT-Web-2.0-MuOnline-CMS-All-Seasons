<?php
session_start();

include 'config.php';
include 'includes.php';

if(isset($_POST['updateBet'])){
    Modules::getInstance()->loadView("lastbets");
    exit;
}

if(isset($_POST['bet'])){
    Auction::$inst->betRenas((int) $_POST['count']);
    exit;
}

if (!isset($_SESSION[$config->getWebConfig("user_session_name")]) && !isset($_SESSION[$config->getWebConfig("user_session_name")]) && isset($_POST['login'])) {
    User::getInstance()->login(Modules::getInstance()->filter($_POST['user']), Modules::getInstance()->filter($_POST['pass']));
    exit;
}

include "./template/header.php";

if (!isset($_SESSION[$config->getWebConfig("user_session_name")]) && !isset($_SESSION[$config->getWebConfig("user_session_name")])) {
    Modules::getInstance()->loadView("home");
} else {
    Modules::getInstance()->loadView("home");
}

include "./template/footer.php";
