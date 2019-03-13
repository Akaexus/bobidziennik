<?php

class Output {
	private $output;
	public $title;
	public $cssFiles = [];
	public $jsFiles = [];
	protected $templatingEngine;

	public function __construct() {
		$this->templatingEngine = new Latte\Engine();
		if (defined('DEV_MODE') && DEV_MODE) {
			$this->templatingEngine->setAutoRefresh(false);
		}
	}

	public function redirect($url, $internal = true) {
		$baseUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		if ($internal) {
			$url = $baseUrl.$url;
		}
		header('Location: '.$url, 302);
	}

	public function add($string) {
		$this->output .= $string;
	}

	public function render() {
        echo $this->renderTemplate('core', 'core', [
            'title'=> $this->title,
            'output'=> $this->output,
            'jsFiles'=> $this->jsFiles
        ]);
	}

	public function renderTemplate($controller, $template, $params = []) {
		$output = $this->templatingEngine->renderToString(BD_ROOT_PATH."templates/{$controller}/{$template}.phtml", $params);
		return $output;
	}

	public static $instance;
	static function i() {
		if (self::$instance === null) {
			self::$instance = new Output;
		}
		return self::$instance;
	}
}
