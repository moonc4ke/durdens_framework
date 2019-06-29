<?php

use App\App;

/**
 * @param $field_input
 * @param $field
 * @param $safe_input
 * @return bool
 */
function validate_email_exists($field_input, &$field, &$safe_input)
{
    if (!App::$user_repo->load($field_input)) {
        return true;
    }

    $field['error_msg'] = 'Email already exists.';
}

/**
 * @param $safe_input
 * @param $form
 * @return bool
 */
function confirm_password(&$safe_input, &$form)
{
    if ($safe_input['user_password_first'] !== $safe_input['user_password']) {
        $form['error_msg'] = 'Your entered passwords don\'t match.';
    } else {
        return true;
    }
}

/**
 * @param $safe_input
 * @param $form
 * @return bool
 */
function validate_form_file(&$safe_input, &$form)
{
    $file_saved_url = save_file($safe_input['user_photo']);

    if ($file_saved_url) {
        $safe_input['user_photo'] = 'uploads/' . $file_saved_url;

        return true;
    } else {
        $form['error_msg'] = 'File error!';
    }
}

function validate_login(&$safe_input, &$form)
{
    $status = App::$session->login($safe_input['user_email'], $safe_input['user_password']);
    switch ($status) {
        case Core\User\Session::LOGIN_SUCCESS:
            return true;
    }

    $form['error_msg'] = 'Incorrect Email/ Password!';
}