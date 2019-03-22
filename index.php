<?php
    /**
     *  PHP version 7.2.15+
     *  @category Registry
     *  @package Bobidziennik
     *  @author Krzysztof <krzysztof@bobidziennik.va>
     *  @license MIT (readme.md)
     *  @link https://github.com/dzban/bobidziennik
     */

    use Nette\Forms\Rule;

    define('BD_ROOT_PATH', __DIR__.'/');
    define('DEV_MODE', true);
    require_once 'autoload.php';
    require_once 'vendor/autoload.php';

    session_start();
    Output::i()->jsFiles[] = 'js/index.js';
    require "controllers/".Request::i()->controller.".php";
    $controller = ucfirst(Request::i()->controller);
    $page = new $controller();

    Output::i()->render();
?>
