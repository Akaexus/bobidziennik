<?php

require_once('ActiveRecord.class.php');

class Student extends ActiveRecord {
	public static $databaseTable = 'uczen';
	public static $idColumn = 'id';
	public static $columnNames = [
		'id',
		'id_konta',
		'id_klasy',
		'imie',
		'nazwisko',
		'pesel',
		'photo',
		'nr_dziennika',
	];

    public function name() {
        return "{$this->imie} {$this->nazwisko}";
    }

	public function __toString() {
		return "{$this->imie} {$this->nazwisko}";
	}

    public static function form($defaultValues = null) {
		$form = new \Nette\Forms\Form();
        $form->addEmail('email', 'E-mail')
        ->setRequired('Podaj e-mail.');
		$form->addText('login', 'Login')
			->setRequired('Wypełnij login.');
        if (!$defaultValues) {
            $form->addPassword('pass', 'Hasło')
            ->setRequired('Wypełnij hasło.');
        }
		$form->addText('imie', 'Imie')
			->setRequired('Wypełnij pole imie.');
		$form->addText('nazwisko', 'Nazwisko')
			->setRequired('Wypełnij pole nazwisko.');
        $form->addText('pesel', 'PESEL')
            ->setRequired('Wypełnij pole PESEL.')
            ->addRule(\Nette\Forms\Form::MAX_LENGTH, 'Pesel musi zawierać 11 cyfr!', 11)
            ->addRule(\Nette\Forms\Form::MIN_LENGTH, 'Pesel musi zawierać 11 cyfr!!', 11);
        if ($defaultValues) {
            $form->setDefaults($defaultValues);
        }
		$form->addSubmit('send', $defaultValues ? 'Edytuj' : 'Dodaj');
		return $form;
	}

	public function getClass()
	{
		$studentClass = StudentClass::load($this->id_klasy);
		return $studentClass;
	}

    public static function getByUserId($userID) {
        $studentData = DB::i()->select([
            'select'=> '*',
            'from'=> static::$databaseTable,
            'where'=> [
                ['id_konta=?', $userID]
            ]
        ]);
        if ($studentData) {
            return new Student($studentData[0]);
        } else {
            return null;
        }
    }

	public function getMarks($subject = NULL) {
		$whereClause = ['id_ucznia = '.$this->getId()];
		if ($subject) {
			if ($subject instanceof Subject) {
				$whereClause[] = 'id_przedmiotu = '.$subject->getId();
			} else {
				$whereClause[] = 'id_przedmiotu = '.$subject;
			}
		}
		$whereClause = implode(' AND ', $whereClause);
		$marks = array_map(function($e) {
            return new Mark($e);
        }, DB::i()->select([
			'select'=> '*',
			'from'=> Mark::$databaseTable,
			'where'=> [
				['id_przedmiotu=?', ($subject instanceof Subject ? $subject->getId() : $subject)]
			]
		]));
		return $marks;
	}
}
