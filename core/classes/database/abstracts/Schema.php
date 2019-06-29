<?php

namespace Core\database\abstracts;

use Core\database\SQLBuilder;
use Exception;
use PDO;
use PDOException;

abstract class Schema
{

    /** @var string Schema name */
    protected $name;

    /** @var  PDO objektas iš Connection klasės */
    protected $pdo;

    /** @var  \Core\Database\Connection */
    protected $connection;

    /**
     * #1 nusetinti $name
     * #3 nusetinti $pdo (su getPdo() iš Connection)
     * @param Connection $c
     * @param $name
     */
    abstract function __construct(Connection $c, $name);

    /**
     * Initializes Schema
     *
     * @return void
     * @throws Exception
     */
    public function init()
    {
        try {
            $sql_check = strtr('SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA '
                . 'WHERE SCHEMA_NAME = @schema', [
                '@schema' => SQLBuilder::value($this->name)
            ]);
            $query = $this->pdo->query($sql_check);

            // Check if schema exists. If we can query one column, it means yes
            if (!(bool)$query->fetchColumn()) {
                $this->create();
            }

            // USE `schema`. This SQL lets all subsequent requests specify table only
            $sql_use = strtr('USE @schema', [
                '@schema' => SQLBuilder::schema($this->name)
            ]);
            $this->pdo->exec($sql_use);
        } catch (PDOException $e) {
            throw new Exception("Database Error: " . $e->getMessage());
        }
    }

    /**
     * Creates Schema
     *
     * @throws PDOException
     */
    abstract public function create();
}
