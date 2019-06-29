<?php

namespace App\Objects\Form;

use Core\Page\Objects\Form;

class Logout extends Form
{

    public function __construct()
    {
        parent::__construct([
            'fields' => [
            ],
            'buttons' => [
                'submit' => [
                    'text' => 'Logout!'
                ]
            ],
            'validate' => [
                'validate_logout'
            ],
            'callbacks' => [
                'success' => [],
                'fail' => []
            ]
        ]);
    }

}
