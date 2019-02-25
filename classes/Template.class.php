<?php

class Template {
	public $controller;
	public $templateName;
	public function __constructor($controller, $templateName) {
		$this->controller = $controller;
		$this->templateName = $templateName;
	}
	public function render(...$params) {
		extract($params);
		ob_start();
		require BD_ROOT_PATH . "templates/{$this->controller}/{$templateName}.phtml";
		return ob_get_clean();
	}	
}