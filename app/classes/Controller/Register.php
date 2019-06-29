<?php

namespace App\Controller;

use App\App;
use App\User\Repository;
use App\User\User;

class Register extends Base
{

    /** @var \App\Objects\Form\Register */
    protected $form;
    protected $input;
    protected $repo;

    public function __construct()
    {
        parent::__construct();

        $this->repo = new Repository(App::$db_conn);
        $this->form = new \App\Objects\Form\Register();
        $status = $this->form->process();
        $this->input = $this->form->getInput();

        switch ($status) {
            case \App\Objects\Form\Register::STATUS_SUCCESS:
                $this->registerSuccess();

                $user = new User([
                    'email' => $this->input['user_email']
                ]);
                $this->repo->insert($user);

                header('Location: /login');

                exit();
                break;
            default:
                $this->page['content'] = $this->form->render();
        }
    }

    public function registerSuccess()
    {
        $user = new \Core\User\User([
            'email' => $this->input['user_email'],
            'password' => $this->input['user_password'],
            'full_name' => $this->input['user_full_name'],
            'age' => $this->input['user_age'],
            'gender' => $this->input['user_gender'],
            'orientation' => $this->input['user_orientation'],
            'account_type' => \Core\User\User::ACCOUNT_TYPE_USER,
            'photo' => $this->input['user_photo'],
            'is_active' => true
        ]);

        App::$user_repo->insert($user);
    }

}
