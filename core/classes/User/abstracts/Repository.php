<?php

namespace Core\User\abstracts;

abstract class Repository
{

    const REGISTER_SUCCESS = 1;
    const REGISTER_ERR_EXISTS = -1;

    /**
     * Patikrinam are user'is su tokiu email'u egzistuoja
     * Jeigu ne, tada įtraukiam jį į duombazę ir
     * returniname REGISTER_SUCCESS
     * Jeigu egzistuoja, returniname REGISTER_ERR_EXISTS
     * @param \Core\User\User $user
     */
    abstract public function register(\Core\User\User $user);

    /**
     * Loads user via $email
     *
     * @return \Core\User\User
     */
    abstract public function load($email);


    /**
     * Loads all users
     *
     * @return \Core\User\User
     */
    abstract public function loadAll();

    /**
     * Inserts user to database
     * @param \Core\User\User $user
     */
    abstract public function insert(\Core\User\User $user);

    /**
     * Updates user in database based on its email
     * @param \Core\User\User $user
     */
    abstract public function update(\Core\User\User $user);


    /**
     * Deletes user from database based on its email
     * @param \Core\User\User $user
     */
    abstract public function delete(\Core\User\User $user);

    /**
     * Deletes all users from database
     */
    abstract public function deleteAll();

}