<?php

namespace Core\User;

use Core\Database\Connection;

class Model extends \Core\Database\Model
{

    public function __construct(Connection $conn)
    {

        parent::__construct($conn, 'users_table', [
            [
                'name' => 'email',
                'type' => self::TEXT_SHORT,
                'flags' => [self::FLAG_NOT_NULL, self::FLAG_PRIMARY]
            ],
            [
                'name' => 'password',
                'type' => self::TEXT_SHORT,
                'flags' => [self::FLAG_NOT_NULL]
            ],
            [
                'name' => 'full_name',
                'type' => self::TEXT_SHORT,
                'flags' => [self::FLAG_NOT_NULL]
            ],
            [
                'name' => 'age',
                'type' => self::NUMBER_MED,
                'flags' => [self::FLAG_NOT_NULL]
            ],
            [
                'name' => 'gender',
                'type' => self::CHAR,
                'flags' => [self::FLAG_NOT_NULL]
            ],
            [
                'name' => 'orientation',
                'type' => self::CHAR,
            ],
            [
                'name' => 'photo',
                'type' => self::TEXT_MED
            ],
            [
                'name' => 'account_type',
                'type' => self::CHAR,
                'flags' => [self::FLAG_NOT_NULL]
            ],
            [
                'name' => 'is_active',
                'type' => self::CHAR,
                'flags' => [self::FLAG_NOT_NULL]
            ],
        ]);
    }

}
