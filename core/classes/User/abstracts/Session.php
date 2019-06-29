<?php

namespace Core\User\abstracts;

/**
 * Abstract Session
 */
abstract class Session
{

    /** @var \Core\User\Repository */
    protected $repo;
    protected $is_logged_in;

    /** @var \Core\User\User */
    protected $user;

    const LOGIN_SUCCESS = 1;
    const LOGIN_ERR_CREDENTIALS = -1;
    const LOGIN_ERR_NOT_ACTIVE = -2;

    /**
     * Konstruktorius pradeda sesiją ir bando
     * user'į prijungti su Cookie
     * @param \Core\User\Repository $repo
     */
    abstract public function __construct(\Core\User\Repository $repo);

    /**
     * Grazina $is_logged_in;
     */
    abstract public function isLoggedIn();

    /**
     * Bando user'į priloginti iš
     * Server-Side'o Cookie $_SESSION
     * bandant jį priloginti su $_SESSION'e
     * išsaugotais email ir password
     */
    abstract public function loginViaCookie();

    /**
     * Bando user'į priloginti per $email ir $password
     *
     * Jeigu blogas passwordas/email, return'inti
     * LOGIN_ERR_CREDENTIALS
     *
     * Jeigu useris not active, return'inti
     * LOGIN_ERR_NOT_ACTIVE
     *
     * Jeigu viskas gerai:
     * 1# į $_SESSION išsaugoti email ir password
     * 2# nusettinti $this->user
     * 3# return'inti LOGIN_SUCCESS
     *
     *      *
     * @param $email
     * @param $password
     * @return int
     */
    abstract public function login($email, $password): int;

    /**
     * Išvalyti $_SESSION
     * užbaigti sesiją (Google)
     * ištrinti sesijos cookie (Google)
     * nustatyti is_logged_in
     * nustatyti $this->user
     */
    abstract public function logout();

    /**
     * Return'inti user'io objektą
     */
    abstract public function getUser();
}
