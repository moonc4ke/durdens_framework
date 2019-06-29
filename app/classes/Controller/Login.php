<?php

namespace App\Controller;

use App\App;

class Login extends Base
{

    /** @var \App\Objects\Form\Login */
    protected $form;

    public function __construct()
    {
        if (App::$session->isLoggedIn() === true) {
            header('Location: /home');
            exit();
        }

        parent::__construct();

        $this->form = new \App\Objects\Form\Login();

        switch ($this->form->process()) {
            case \App\Objects\Form\Login::STATUS_SUCCESS:
                header('Location: /list');
                exit();
                break;
            default:
                $this->page['title'] = 'Login';
                $this->page['content'] = $this->form->render();
        }
    }

}
