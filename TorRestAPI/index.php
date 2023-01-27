<?php 
    define('TITLE', 'Tor REST API');
    define('firstEndpoint', 'ocultar-ip/index.php');
    define('secndEndpoint', 'ips-ocultos');
    define('thirdEndpoint', 'ips-desocultos');

    require_once('includes/autoloader.php');
    require_once('includes/views/header.php');

    $onionIPs = API::getOnionIPs();
    $danMeIPs = API::getDanMeIPs();
    $allIPs = array_merge($onionIPs, $danMeIPs->Addresses);
    // join onion IPs and dan me IPs

    // IP search
    $limit = isset($_GET['limit']) && filter_var($_GET['limit'], FILTER_VALIDATE_INT) && $_GET['limit'] >= 1 ? $_GET['limit'] : 54;
    $search = filter_input(INPUT_GET, 'AddressIP', FILTER_SANITIZE_STRING);
    $allIPs = preg_grep('/^'.preg_quote($search, '/').'/', $allIPs);
    // preg_quote adds a backslash in chars
    // preg_grep gets the array searched from the given pattern

    require_once('includes/views/mainPage.php');
?>