<?php

namespace App\Objects\Form;

use Core\Page\Objects\Form;

class Login extends Form
{

    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'user_email' => [
                    'label' => 'Email',
                    'type' => 'text',
                    'placeholder' => 'Your email',
                    'validate' => [
                        'validate_not_empty',
                        'validate_email'
                    ]
                ],
                'user_password' => [
                    'label' => 'Password',
                    'type' => 'password',
                    'placeholder' => 'Your password',
                    'validate' => [
                        'validate_not_empty'
                    ]
                ],
            ],
            'pre_validate' => [],
            'validate' => [
                'validate_login'
            ],
            'buttons' => [
                'submit' => [
                    'text' => 'Login'
                ]
            ],
            'callbacks' => [
                'success' => [],
                'fail' => []
            ]
        ]);
    }

}
