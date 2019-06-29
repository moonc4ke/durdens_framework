<?php

namespace App\Controller;

use App\App;
use Core\Page\View;

class Logout extends Base
{

    /** @var \App\Objects\Form\Logout */
    protected $form;

    public function __construct()
    {
        parent::__construct();

        $this->form = new \App\Objects\Form\Logout();

        switch ($this->form->process()) {
            case \App\Objects\Form\Logout::STATUS_SUCCESS:
                $this->redirect();
                break;
            default:
                $this->page['title'] = 'Logout';

                $view = new View([
                    'title' => 'Are you sure you want to logout?'
                ]);

                $this->page['content'] = $view->render(ROOT_DIR . '/app/views/content.tpl.php');
                $this->page['content'] .= $this->form->render();
        }
    }

    public function redirect()
    {
        if (!App::$session->isLoggedIn() === true) {
            header('Location: login');
            exit();
        }
    }

}
