<?php

namespace App\User;

use Core\Database\Connection;

/**
 * @property Model model
 */
class Repository
{

    const REGISTER_SUCCESS = 1;
    const REGISTER_ERR_EXISTS = -1;

    public function __construct(Connection $c)
    {
        $this->model = new Model($c);
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

    public function loadAll()
    {
        $rows = $this->model->load();
        $users = [];

        foreach ($rows as $row) {
            $users[] = new User($row);
        }

        return $users;
    }

    public function exists($email)
    {
        return $this->model->exists([
            'email' => $email
        ]);
    }

}
