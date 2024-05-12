<!-- Model for User related db interations. -->
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Creating, Inserting a new user to db.
    function create($firstName, $secondName, $username, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if ($this->db->insert('user', array('firstName' => $firstName, 'secondName' => $secondName, 'username' => $username, 'password' => $hashed_password))) {
            return true;
        } else {
            return false;
        }
    }

    // User Authentication.
    function authenticate($username, $password)
    {
        $query = $this->db->get_where('user', array('username' => $username));

        if ($query->num_rows() != 1) {
            return false;
        } else {
            $row = $query->row();
            if (password_verify($password, $row->password)) {
                return true;
            } else {
                return false;
            }
        }
    }

    // Check if a user is already logged in.
    function is_logged_in()
    {
        if (isset($this->session->is_logged_in) && $this->session->is_logged_in == true) {
            return true;
        } else {
            return false;
        }
    }

    // Retrieving logged in user details fro the user profile.
    function getAccountName($username)
    {
        $this->db->select('firstName, secondName');
        $this->db->where('username', $username);
        $query = $this->db->get('user');

        if ($query->num_rows() != 1) {
            return false;
        } else {
            return $query->row();
        }
    }

    // Updatin user's first name.
    function changeFirstName($username, $firstName)
    {
        $this->db->where(array('username' => $username));
        $this->db->update('user', array('firstName' => $firstName));
    }

    // Updating user's second name.
    function changeSecondName($username, $secondName)
    {
        $this->db->where(array('username' => $username));
        $this->db->update('user', array('secondName' => $secondName));
    }

    // Changing user's password.
    function changePassword($username, $oldPassword, $newPassword)
    {
        $query = $this->db->get_where('user', array('username' => $username));

        if ($query->num_rows() != 1) {
            return false;
        } else {
            $row = $query->row();

            if (password_verify($oldPassword, $row->password)) {

                $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
                $this->db->update('user', array('password' => $hashed_password));
                return true;
            } else {
                return false;
            }
        }
    }
}
