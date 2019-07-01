<?php

namespace App;

use Core\Database\Connection;
use Core\Database\Schema;
use Core\Page\Router;
use Core\User\Repository;
use Core\User\Session;

class App extends Abstracts\App
{

    /**
     * Konstruktoriaus paskirtis nustatyti
     * visus klasės property'ies
     */
    public function __construct()
    {
        self::$db_conn = new Connection(DB_CREDENTIALS);
        self::$db_schema = new Schema(self::$db_conn, DB_NAME);
        self::$user_repo = new Repository(self::$db_conn);
        self::$session = new Session(self::$user_repo);
    }

    public function run()
    {
        $controller = Router::getRouteController($_SERVER['REQUEST_URI']);

        if ($controller) {
            print $controller->onRender();
        } else {
            header('Location: /home');
            exit();
        }
    }
}
