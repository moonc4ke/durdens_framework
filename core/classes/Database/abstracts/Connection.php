<?php

namespace Core\Database\abstracts;

use Exception;
use PDO;

abstract class Connection
{

    protected $host;
    protected $pass;
    protected $user;

    /**
     * Database Controller PDO instance
     * @var PDO
     */
    protected $pdo;

    abstract function __construct($creds);

    /**
     * Connect To Database
     * #1 Reikia patikrinti ar $this->pdo nera null (jeigu null, vadinasi jau priconnectinom)
     * #2 Jei ne, sukurti $this->pdo = new PDO ...
     * #3 Jeigu globaline konstanta DEBUG yra nustatyta, executinti šias dvi eilutes
     *  $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     *  $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
     * Jeigu nepavyko sukurti PDO instancijos, throw'inti exceptioną panaudojant try, catch
     * @throws Exception
     */
    abstract public function connect();

    public function disconnect()
    {
        $this->pdo = null;
    }

    public function getPDO()
    {
        if (!$this->pdo) {
            $this->connect();
        }

        return $this->pdo;
    }


    public function setCredentialHost($cred_host)
    {
        $this->host = $cred_host;
    }

    public function getCredentialHost()
    {
        return $this->host;
    }

    public function setCredentialUser($cred_user)
    {
        $this->user = $cred_user;
    }

    public function getCredentialUser()
    {
        return $this->user;
    }

    public function setCredentialPass($cred_pass)
    {
        $this->pass = $cred_pass;
    }

    public function getCredentialPass()
    {
        return $this->pass;
    }

    public function setCredentials($creds)
    {
        $this->setCredentialHost($creds['host']);
        $this->setCredentialUser($creds['user']);
        $this->setCredentialPass($creds['password']);
    }

}
