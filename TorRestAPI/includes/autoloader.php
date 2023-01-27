<?php
    spl_autoload_register('autoloadClasses');

    function autoloadClasses ($class) {
        $path = "../includes/Classes/"; // you are at some endpoint
        $extension = ".class.php";
        $fullPath = $path . $class . $extension;

        if(!file_exists($fullPath)) { // you are at the website index page
            $path = "includes/Classes/";
            $fullPath = $path . $class . $extension;

            if(!file_exists($fullPath))
                return false;
        }

        require_once $fullPath;
    }
?>