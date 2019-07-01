<?php

namespace App\Abstracts;

use Core\Database\Connection;
use Core\Database\Schema;
use Core\User\Repository;
use Core\User\Session;

abstract class App
{

    /**
     * Database Connection
     * Responsible for connecting to MySQL database
     * @var Connection
     */
    public static $db_conn;

    /**
     * Database Schema
     * Responsible for database schema in MySQL
     * @var Schema
     */
    public static $db_schema;

    /**
     * User Repository
     * Handles user data
     * @var Repository
     */
    public static $user_repo;

    /**
     * Session
     * Handles login operations
     * @var Session
     */
    public static $session;

    /**
     * Konstruktoriaus paskirtis nustatyti
     * visus klasės property'ies
     */
    abstract public function __construct();

}
