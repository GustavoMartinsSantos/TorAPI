<?php
    define('TITLE', 'IPs ocultos');
    define('firstEndpoint', '../ips-desocultos/desocultarIP.php');
    define('secndEndpoint', '../');
    define('thirdEndpoint', '../ips-desocultos');

    require_once('../includes/autoloader.php');
    require_once('../includes/views/header.php');

    // array_column transforms the multidimensional array into a single one
    $hiddenIPs = array_column(HiddenIP::SELECT(new Database()), 0);
    $allIPs = $hiddenIPs;

    $firstEndpoint = '../';
    $secndEndpoint = '../ips-desocultos';

    require_once('../includes/views/mainPage.php')
?>