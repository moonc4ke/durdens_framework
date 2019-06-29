<?php

namespace App\Objects\Form;

use Core\Page\Objects\Form;
use Core\User\User;

class Register extends Form
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
                        'validate_email',
                        'validate_email_exists'
                    ]
                ],
                'user_password_first' => [
                    'label' => 'Password',
                    'type' => 'password',
                    'placeholder' => 'Your password',
                    'validate' => [
                        'validate_not_empty',
                        'validate_password'
                    ]
                ],
                'user_password' => [
                    'label' => 'Type Password Again',
                    'type' => 'password',
                    'placeholder' => 'Your password',
                    'validate' => [
                        'validate_not_empty'
                    ]
                ],
                'user_full_name' => [
                    'label' => 'Full name',
                    'type' => 'text',
                    'placeholder' => 'Your full name',
                    'validate' => [
                        'validate_not_empty',
                        'validate_full_name',
                        'validate_is_space'
                    ]
                ],
                'user_age' => [
                    'label' => 'Age',
                    'type' => 'number',
                    'placeholder' => 'Your age',
                    'validate' => [
                        'validate_not_empty',
                        'validate_is_number',
                        'validate_age'
                    ]
                ],
                'user_gender' => [
                    'label' => 'Choose gender',
                    'type' => 'select',
                    'validate' => [
                        'validate_not_empty',
                        'validate_field_select'
                    ],
                    'options' => User::getGenderOptions()
                ],
                'user_orientation' => [
                    'label' => 'Choose orientation',
                    'type' => 'select',
                    'validate' => [
                        'validate_not_empty',
                        'validate_field_select'
                    ],
                    'options' => User::getOrientationOptions()
                ],
                'user_photo' => [
                    'label' => 'Photo',
                    'placeholder' => 'file',
                    'type' => 'file',
                    'validate' => [
                        'validate_file'
                    ]
                ]
            ],
            'pre_validate' => [],
            'validate' => [
                'confirm_password',
                'validate_form_file'
            ],
            'buttons' => [
                'submit' => [
                    'text' => 'Register'
                ]
            ]
        ]);
    }

}
