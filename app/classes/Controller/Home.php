<?php

namespace App\Controller;

use App\App;

class Home extends Base
{

    protected $view;

    public function __construct()
    {
        parent::__construct();

        if (!App::$session->isLoggedIn() === true) {
            header('Location: /login');
            exit();
        } else {
            header('Location: /list');
            exit();
        }
    }

}
