<?php

use App\App;

/**
 * Gauname saugu patikrinta user input.
 *
 * @param $form
 * @return mixed
 */
function get_safe_input($form)
{
    $filtro_parametrai = [
        'action' => FILTER_SANITIZE_SPECIAL_CHARS
    ];
    foreach ($form['fields'] as $field_id => $value) {
        $filtro_parametrai[$field_id] = FILTER_SANITIZE_SPECIAL_CHARS;
    }
    return filter_input_array(INPUT_POST, $filtro_parametrai);
}

/**
 * Patikriname ar formoje esancios validacijos funkcijos yra teisingos ir iskvieciame ju funkcijas(not empty, not a number).
 *
 * @param $safe_input
 * @param $form
 * @return bool
 * @throws Exception
 */
function validate_form($safe_input, &$form)
{
    $success = true;
    $form['validate'] = $form['validate'] ?? [];

    foreach ($form['pre_validate'] as $pre_validator) {
        if (is_callable($pre_validator)) {
            if (!$pre_validator($safe_input, $form)) {
                $success = false;
                break;
            }
        } else {
            throw new Exception(strtr('Not callable @pre_validator function', [
                '@pre_validator' => $pre_validator
            ]));
        }
    }

    if ($success) {
        foreach ($form['fields'] as $field_id => &$field) {
            foreach ($field['validate'] as $validator) {
                if (is_callable($validator)) {
                    $field['id'] = $field_id;

                    if (!$validator($safe_input[$field_id], $field, $safe_input)) {
                        $success = false;
                        break;
                    }
                } else {
                    throw new Exception(strtr('Not callable @validator function', [
                        '@validator' => $validator
                    ]));
                }
            }
        }
    }

    if ($success) {
        $form['validate'] = $form['validate'] ?? [];

        foreach ($form['validate'] as $validator) {
            if (is_callable($validator)) {
                if (!$validator($safe_input, $form)) {
                    $success = false;
                    break;
                }
            } else {
                throw new Exception(strtr('Not callable @validator function', [
                    '@validator' => $validator
                ]));
            }
        }
    }

    if ($success) {
        foreach ($form['callbacks']['success'] as $callback) {
            if (is_callable($callback)) {
                $callback($safe_input, $form);
            } else {
                throw new Exception(strtr('Not callable @function function', [
                    '@function' => $callback
                ]));
            }
        }
    } else {
        foreach ($form['callbacks']['fail'] as $callback) {
            if (is_callable($callback)) {
                $callback($safe_input, $form);
            } else {
                throw new Exception(strtr('Not callable @function function', [
                    '@function' => $callback
                ]));
            }
        }
    }

    return $success;
}

/**
 * Checks if field is empty
 *
 * @param string $field_input
 * @param array $field $form Field
 * @return boolean
 */
function validate_not_empty($field_input, &$field, $safe_input)
{
    if (strlen($field_input) != 0) {
        return true;
    }

    $field['error_msg'] = strtr('\'@field\' cannot be empty.', ['@field' => $field['label']]);
}

/**
 * Checks if field is a number
 *
 * @param string $field_input
 * @param array $field $form Field
 * @return boolean
 */
function validate_is_number($field_input, &$field, $safe_input)
{
    if (is_numeric($field_input)) {
        return true;
    }

    $field['error_msg'] = strtr('\'@field\' is not a number.', ['@field' => $field['label']]);
}

/**
 * @param $field_input
 * @param $field
 * @param $safe_input
 * @return bool
 */
function validate_file($field_input, &$field, &$safe_input)
{
    $file = $_FILES[$field['id']] ?? false;

    if ($file) {
        if ($file['error'] == 0) {
            $safe_input[$field['id']] = $file;

            return true;
        }
    }

    $field['error_msg'] = 'You must choose a photo or an image.';
}

/**
 * @param $field_input
 * @param $field
 * @param $safe_input
 * @return bool
 */
function validate_email($field_input, &$field, &$safe_input)
{
    if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $field_input)) {
        return true;
    }

    $field['error_msg'] = 'Invalid email.';
}

/**
 * @param $field_input
 * @param $field
 * @param $safe_input
 * @return bool
 */
function validate_full_name($field_input, &$field, &$safe_input)
{
    if (preg_match("/^([a-zA-Z' ]+)$/", $field_input)) {
        return true;
    }

    $field['error_msg'] = 'Invalid name given.';
}

/**
 * @param $field_input
 * @param $field
 * @param $safe_input
 * @return bool
 */
function validate_is_space($field_input, &$field, &$safe_input)
{
    if ($field_input == trim($field_input) && strpos($field_input, ' ') !== false) {
        return true;
    }

    $field['error_msg'] = 'Full name must consists from first name and last name and there shouldn\'t be spaces at beginning or end.';
}

/**
 * @param $field_input
 * @param $field
 * @param $safe_input
 * @return bool
 */
function validate_age($field_input, &$field, &$safe_input)
{
    if ($field_input > 0) {
        return true;
    }

    $field['error_msg'] = 'Invalid age.';
}

/**
 * @param $field_input
 * @param $field
 * @param $safe_input
 * @return bool
 */
function validate_field_select($field_input, &$field, &$safe_input)
{
    if (array_key_exists($field_input, $field['options'])) {
        return true;
    }

    $field['error_msg'] = 'Selection doesn\'t exist!';
}

/**
 * @param $field_input
 * @param $field
 * @param $safe_input
 * @return bool
 */
function validate_password($field_input, &$field, &$safe_input)
{
    if (strlen($field_input) <= '7') {
        $field['error_msg'] = 'Your Password Must Contain At Least 8 Characters!';
    } elseif (!preg_match("#[0-9]+#", $field_input)) {
        $field['error_msg'] = 'Your Password Must Contain At Least 1 Number!';
    } elseif (!preg_match("#[A-Z]+#", $field_input)) {
        $field['error_msg'] = 'Your Password Must Contain At Least 1 Capital Letter!';
    } elseif (!preg_match("#[a-z]+#", $field_input)) {
        $field['error_msg'] = 'Your Password Must Contain At Least 1 Lowercase Letter!';
    } else {
        return true;
    }
}

function validate_logout(&$safe_input, &$form)
{
    if (App::$session->isLoggedIn() === true) {
        App::$session->logout();

        return true;
    }
}