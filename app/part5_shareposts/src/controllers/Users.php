<?php

class Users extends Controller {
    public function __construct() {
        
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            die('Submitted!!!');

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Email is required.';
            }

            // Validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Name is required.';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Password is required.';
            } else if (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least six characters.';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Required field.';
            } else if ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Password does not match.';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) &&
            empty($data['name_err']) &&
            empty($data['password_err']) &&
            empty($data['confirm_password_err'])) {
                // Validated
                die('SUCCESS');
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }

        } else {
            // Init Data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            
            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Email is required.';
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Password is required.';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                die('SUCCESS');
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }

        } else {
            // Init Data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];
            
            // Load view
            $this->view('users/login', $data);
        }
    }
}