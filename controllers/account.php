<?php

class Account extends Controller
{
    public function execute()
    {
        //some code
    }

    public function manage()
    {
        Output::i()->title = 'Moje konto';
        $template = Output::i()->renderTemplate(
            'account',
            'account',
            [
                'user'=> User::loggedIn(),
                'entity'=> User::loggedIn()->isUczen() ? Student::load(User::loggedIn()->isUczen()) : Teacher::load(User::loggedIn()->isNauczyciel()),
            ]
        );
        Output::i()->add($template);
    }
}
