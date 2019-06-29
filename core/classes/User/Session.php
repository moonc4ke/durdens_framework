<?php

namespace Core\User;

class Session extends abstracts\Session
{

    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
        $this->is_logged_in = false;
        if (session_id() == '' || !isset($_SESSION)) {
            // session isn't started
            session_start();
        }
        $this->loginViaCookie();
    }

    public function getUser()
    {
        return $this->user;
    }

    public function isLoggedIn()
    {
        return $this->is_logged_in;
    }

    public function login($email, $password): int
    {
        $user = $this->repo->load($email);

        if ($user) {
            if ($user->getPassword() === $password) {
                if ($user->getIsActive()) {
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $this->user = $user;
                    $this->is_logged_in = true;

                    return self::LOGIN_SUCCESS;
                }

                return self::LOGIN_ERR_NOT_ACTIVE;
            }
        }

        return self::LOGIN_ERR_CREDENTIALS;
    }

    public function loginViaCookie()
    {
        if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
            return $this->login($_SESSION['email'], $_SESSION['password']);
        }

        return self::LOGIN_ERR_CREDENTIALS;
    }

    public function logout()
    {
        $_SESSION = [];
        setcookie(session_name(), "", time() - 3600);
        session_destroy();
        $this->is_logged_in = false;
        $this->user = null;
    }

}
