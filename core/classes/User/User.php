<?php

namespace Core\User;

Class User extends abstracts\User
{

    const ACCOUNT_TYPE_USER = 1;
    const ACCOUNT_TYPE_ADMIN = 0;

    public function __construct($data = null)
    {
        if (!$data) {
            $this->data = [
                'email' => null,
                'full_name' => null,
                'age' => null,
                'gender' => null,
                'orientation' => null,
                'photo' => null,
                'account_type' => null,
                'is_active' => null,
                'password' => null
            ];
        } else {
            $this->setData($data);
        }
    }

    public function getAccountType(): int
    {
        return $this->data['account_type'];
    }

    public function getIsActive(): bool
    {
        return $this->data['is_active'];
    }

    public function getPassword(): string
    {
        return $this->data['password'];
    }

    public function setAccountType(int $type)
    {
        if (in_array($type, [self::ACCOUNT_TYPE_ADMIN, self::ACCOUNT_TYPE_USER])) {
            $this->data['account_type'] = $type;

            return true;
        }
    }

    public static function getAccountTypeOptions()
    {
        return [
            self::ACCOUNT_TYPE_USER => 'User',
            self::ACCOUNT_TYPE_ADMIN => 'Admin'
        ];
    }

    public function setIsActive(bool $active)
    {
        $this->data['is_active'] = $active;
    }

    public function setPassword(string $password)
    {
        $this->data['password'] = $password;
    }

    public function setData(array $data)
    {
        parent::setData($data);
        $this->setIsActive($data['is_active'] ?? null);
        $this->setAccountType($data['account_type'] ?? null);
        $this->setPassword($data['password'] ?? '');
    }

}
