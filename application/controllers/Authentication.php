<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function signup()
    {
        $fullName = $this->input->post('fullName');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if (!$this->UserModel->create($fullName, $username, $password)) {
            // Redirect to the signup page when an error occured
        } else {
            $this->load->view('templates/header.php');
            $this->load->view('success_registration');
            $this->load->view('templates/footer.php');
        }
    }

    public function signin()
    {
        if (isset($this->session->login_error) && $this->session->login_error == true) {
            $this->session->unset_userdata('login_error');
            $this->load->view('templates/header.php');
            $this->load->view(
                'signin',
                array('login_error_msg' => "Invalid Credentials. Please try again!")
            );
            $this->load->view('templates/footer.php');
        } elseif ($this->UserModel->is_logged_in()) {
            redirect('');
        } else {
            $this->load->view('templates/header.php');
            $this->load->view('signin');
            $this->load->view('templates/footer.php');
        }
    }

    public function authenticate()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($this->UserModel->authenticate($username, $password)) {
            $this->session->is_logged_in = true;
            $this->session->username = $username;
            redirect('');
        } else {
            $this->session->login_error = true;
            redirect('/authentication/signin');
        }
    }

    public function profile()
    {
        $username = $this->session->username;
        $fullName = $this->UserModel->getAccountName($username);

        $this->load->view('templates/header.php', array('isLoggedIn' => $this->UserModel->is_logged_in()));
        $this->load->view('profile', array('fullName' => $fullName));
        $this->load->view('templates/footer.php');
    }

    public function changename()
    {
        $username = $this->session->username;
        $newFullName = $this->input->post('fullName');
        $this->UserModel->changeFulLName($username, $newFullName);

        header('Content-Type: application/json');
        echo json_encode($this->UserModel->getAccountName($username));
    }

    public function changepassword()
    {
        $username = $this->session->username;
        $oldPassword = $this->input->post('oldPassword');
        $newPassword = $this->input->post('newPassword');
        $success = $this->UserModel->changePassword($username, $oldPassword, $newPassword);

        if ($success) {
            $this->session->is_logged_in = false;
            header('Content-Type: application/json');
            echo json_encode("Password Changed Successfully");
        } else {
        }
    }

    public function signout()
    {
        $this->session->is_logged_in = false;
        redirect('');
    }
}
