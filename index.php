<?php
use Nette\Forms\Rule;

	define('BD_ROOT_PATH', __DIR__.'/');
	define('DEV_MODE', true);
	require_once('autoload.php');
	require_once('vendor/autoload.php');

	session_start();

    require "controllers/".Request::i()->controller.".php";
    $controller = ucfirst(Request::i()->controller);
    $page = new $controller();

	Output::i()->render();
?>
