<?php

use Core\Page\Router;

Router::addRoute('/home', '\App\Controller\Home');
Router::addRoute('/about', '\App\Controller\About');
Router::addRoute('/list', '\App\Controller\UserList');
Router::addRoute('/register', '\App\Controller\Register');
Router::addRoute('/login', '\App\Controller\Login');
Router::addRoute('/logout', '\App\Controller\Logout');
