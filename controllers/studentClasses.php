<?php


class StudentClasses extends Controller {

	public function _createTable($classes) {
		$output = '<table>
			<thead>
				<tr>
					<th>Nazwa</th>
					<th>Rok</th>
					<th>Symbol</th>
					<th>Wychowawca</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
		';
		foreach ($classes as $class) {
			$leadingTeacher = 
			$output .= "<tr>
				<td>{$class->nazwa}</td>
				<td>{$class->rok}</td>
				<td>{$class->symbol}</td>
				<td>{$class->leadingTeacher()}</td>
				<td>
					<a href=\"\">Zarządzaj klasą</a>
					<a href=\"\">Zobacz uczniów</a>
				</td>

			";
		}
		$output .= "</tbody></table>";
		return $output;
	}

	public function classesList() {
		$classes = array_map(function($student) {
			return new StudentClass($student);
		}, DB::i()->select('select * from '.StudentClass::$databaseTable));
		$template = Output::i()->getTemplate('studentClasses', 'list');
		Output::i()->add($template->render([
			'classes'=> $classes
		]));
	}

	public function execute() {
		$this->classesList();
	}
}