<?php

namespace App\Controller;

use App\App;
use Core\Page\View;

class UserList extends Base
{
    protected $users;

    public function __construct()
    {
        if (!App::$session->isLoggedIn() === true) {
            header('Location: /home');
            exit();
        }

        parent::__construct();

        $this->users = App::$user_repo->loadAll();

        $view = new View([
            'users' => $this->users
        ]);

        $this->page['title'] = 'User List';

        $this->page['content'] = $view->render(ROOT_DIR . '/app/views/userList.tpl.php');
    }

}