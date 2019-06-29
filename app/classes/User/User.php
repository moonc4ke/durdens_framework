<?php

namespace App\User;

/**
 * @property array data
 */
class User {

    public function __construct($data = null) {
        if (!$data) {
            $this->data = [
                'email' => null,
            ];
        } else {
            $this->setData($data);
        }
    }

    public function getEmail(): string {
        return $this->data['email'];
    }

    public function setEmail(string $email) {
        $this->data['email'] = $email;
    }

    public function setData(array $data) {
        $this->setEmail($data['email'] ?? '');
    }

    public function getData() {
        return $this->data;
    }

}
