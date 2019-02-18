<?php

class Output {
	private $output;
	public $title;
	protected $cssFiles = [];
	protected $jsFiles = [];
	public function redirect($url, $internal = true) {
		$baseUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		if ($internal) {
			$url = $baseUrl;
		}
		header('Location: '.$url, 302);
	}

	public function add($string) {
		$this->output .= $string;
	}

	public function render() {
		$output = '
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="UTF-8">';
				if ($this->title) {
					$output .= "<title>{$this->title}</title>";
				}
				$output .='
			<//head>
			<body>'
			.$this->output.
			'</body>
		</html>';
		echo $output;
	}

	public static $instance;
	static function i() {
		if (self::$instance === null) {
			self::$instance = new Output;
		}
		return self::$instance;
	}
}