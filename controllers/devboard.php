<?php

class Devboard {
	public function render() {
		$output = '
			<h1>USER</h1>
			<pre>'.print_r(User::loggedIn(), 1).'</pre>
			<h1>$_GET</h1>
			<pre>'.print_r($_GET, 1).'</pre>
			<h1>$_POST</h1>
			<pre>'.print_r($_POST, 1).'</pre>
			<h1>$_SESSION</h1>
			<pre>'.print_r($_SESSION, 1).'</pre>
			<h1>$_SERVER</h1>
			<pre>'.print_r($_SERVER, 1).'</pre>
		';
		Output::i()->add($output);
	}
}