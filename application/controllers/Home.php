<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('QuestionModel');
	}

	public function welcome()
    {
        if (!$this->UserModel->is_logged_in()) {
            $this->load->view('welcome_message');
        } else {
            redirect('home/index');
        }
    }

	public function index()
	{
        $questions = $this->QuestionModel->listTrendingQuestions();
        $header = ($questions == false) ? 'This week\'s trending questions will be displayed here.' : 'Top Trending Questions';

        $this->load->view('templates/header', array('isLoggedIn' => $this->UserModel->is_logged_in()));
        $this->load->view('question_list', array('questions' => $questions, 'header' => $header));
        $this->load->view('templates/footer');
	}

	public function signup()
	{
		$this->load->view('templates/header.php');
		$this->load->view('signup');
		$this->load->view('templates/footer.php');
	}
}
