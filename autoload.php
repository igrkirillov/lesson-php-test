<?php

function autoload($rawClass)
{
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $rawClass);
    $file = $class . ".php";
    if (file_exists($file)) {
        require_once $file;
    }
}