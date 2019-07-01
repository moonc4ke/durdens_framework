<?php

namespace Core\User;

use Core\Database\Connection;

class Repository extends abstracts\Repository
{

    protected $model;

    public function __construct(Connection $c)
    {
        $this->model = new Model($c);
    }

    public function register(User $user)
    {
        if (!$this->exists($user)) {
            $this->insert($user);

            return self::REGISTER_SUCCESS;
        }

        return self::REGISTER_ERR_EXISTS;
    }

    public function insert(User $user)
    {
        return $this->model->insertIfNotExists(
            $user->getData(), ['email']
        );
    }

    public function load($email)
    {
        $rows = $this->model->load([
            'email' => $email
        ]);

        foreach ($rows as $row) {
            return new User($row);
        }
    }


    public function loadAll()
    {
        $rows = $this->model->load();
        $users = [];

        foreach ($rows as $row) {
            $users[] = new User($row);
        }

        return $users;
    }

    public function update(User $user)
    {
        return $this->model->update($user->getData(), [
            'email' => $user->getEmail()
        ]);
    }

    public function delete(User $user)
    {
        return $this->model->delete([
            'email' => $user->getEmail()
        ]);
    }

    public function deleteAll()
    {
        return $this->model->delete();
    }

    public function exists($email)
    {
        return $this->model->exists([
            'email' => $email
        ]);
    }
}
