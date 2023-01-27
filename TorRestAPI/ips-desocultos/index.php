<?php 
    define('TITLE', 'IPs não ocultos');
    define('firstEndpoint', '../ocultar-ip/index.php');
    define('secndEndpoint', '../');
    define('thirdEndpoint', '../ips-ocultos');

    require_once('../includes/autoloader.php');
    require_once('../includes/views/header.php');

    $onionIPs = API::getOnionIPs();
    $danMeIPs = API::getDanMeIPs("../");
    $hiddenIPs = array_column(HiddenIP::SELECT(new Database()), 0);

    $allIPs = array_merge($onionIPs, $danMeIPs->Addresses);
    $allIPs = array_diff($allIPs, $hiddenIPs);
    // all IPs receives the difference between the hidden IPs and 
    // those who came from external sources

    require_once('../includes/views/mainPage.php')
?>