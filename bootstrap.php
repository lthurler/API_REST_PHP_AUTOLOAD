<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

define('HOST', 'localhost');
define('USER', 'root');
define('SENHA', '');
define('PORT', '3306');
define('BANCO', 'api');
define('DRIVE', "mysql");

define('DS', DIRECTORY_SEPARATOR);
define('DIR_APP', __DIR__);
define('DIR_PROJETO', 'api_rest_php' );

if (file_exists( filename: 'autoload.php'))
{
    include 'autoload.php';

}else 
{
    echo 'Erro ao incluir bootstrap';exit;
}

?>
