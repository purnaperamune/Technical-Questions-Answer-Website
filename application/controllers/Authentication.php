<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    // Registration for new users.
    public function signup()
    {
        $this->form_validation->set_rules('firstName', 'First Name', 'required|trim');
        $this->form_validation->set_rules('secondName', 'Second Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|trim|matches[password]');
    
        $this->form_validation->set_message('required', 'Please fill in the %s.');
        $this->form_validation->set_message('matches', 'The passwords do not match.');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header.php');
            $this->load->view('signup');
            $this->load->view('templates/footer.php');
        } else {
            $firstName = $this->input->post('firstName');
            $secondName = $this->input->post('secondName');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
    
            if ($this->UserModel->create($firstName, $secondName, $username, $password)) {
                $this->load->view('templates/header.php');
                $this->load->view('success_registration');
                $this->load->view('templates/footer.php');
            } else {
                $this->session->set_flashdata('signup_error', 'Failed to create user account. Please try again.');
                redirect('authentication/signup');
            }
        }
    }
    
    // Sign in for existing users.
    public function signin()
    {
        $error_msg = $this->session->userdata('login_error');
        $this->session->unset_userdata('login_error');
        $this->load->view('templates/header.php');
        $this->load->view('signin', ['login_error_msg' => $error_msg]);
        $this->load->view('templates/footer.php');
    }

    // User authentications 
    public function authenticate()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($this->UserModel->authenticate($username, $password)) {
            $this->session->set_userdata('is_logged_in', true);
            $this->session->set_userdata('username', $username);
            redirect('home');
        } else {
            $this->session->set_userdata('login_error', 'Invalid Credentials. Please try again!');
            redirect('authentication/signin');
        }
    }

    // Loading the profile for signed in users.
    public function profile()
    {
        $username = $this->session->username;
        $accountName = $this->UserModel->getAccountName($username);

        if ($accountName) {
            $firstName = $accountName->firstName;
            $secondName = $accountName->secondName;
        } else {
            $firstName = '';
            $secondName = '';
        }

        $this->load->view('templates/header.php', array('isLoggedIn' => $this->UserModel->is_logged_in()));
        $this->load->view('profile', array('firstName' => $firstName, 'secondName' => $secondName, 'username' => $username));
        $this->load->view('templates/footer.php');
    }

    // Changing the first name for signed in users.
    public function changefirstname()
    {
        $username = $this->session->username;
        $newFirstName = $this->input->post('firstName');

        $this->UserModel->changeFirstName($username, $newFirstName);

        header('Content-Type: application/json');
        echo json_encode($this->UserModel->getAccountName($username));
    }

    // Changing the second name for signed in users.
    public function changesecondname()
    {
        $username = $this->session->username;
        $newSecondName = $this->input->post('secondName');

        $this->UserModel->changeSecondName($username, $newSecondName);

        header('Content-Type: application/json');
        echo json_encode($this->UserModel->getAccountName($username));
    }

    // Changing the password for existing users.
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

    // Signout from the account
    public function signout()
    {
        $this->session->is_logged_in = false;
        redirect('authentication/signin');
    }
}
