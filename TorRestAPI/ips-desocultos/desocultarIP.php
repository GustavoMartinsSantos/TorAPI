<?php
    session_start();
    require_once('../includes/autoloader.php');

    if(isset($_POST['AddressIP'])) {
        $db = new Database();

        $IP = new HiddenIP($_POST['AddressIP']);
        $errorMessage = $IP->validateUnhideIP();

        if($errorMessage != 1)
            $_SESSION['message'] = "<div class='p-3 alert alert-danger'>$errorMessage</div>";
        else {
            $_SESSION['message'] = "<div class='p-3 alert alert-success'>IP desocultado com sucesso!!</div>";
            $IP->DELETE($db);
        }

        header("location: ../ips-desocultos/");
    }
?>