<?php

namespace App\User;

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
            ]
        ]);
    }

}
