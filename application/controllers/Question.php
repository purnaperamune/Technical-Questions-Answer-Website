<!-- Controller for Question related functions.  -->
<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . 'libraries/RestController.php';

class Question extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('QuestionModel');
        $this->load->model('AnswerModel');
        $this->load->model('UserModel');
    }

    // Inserting new questions.
    public function question_post()
    {
        $username = $this->session->username;
        $category = $this->post('category');
        $title = $this->post('title');
        $description = $this->post('description');

        $questionId = $this->QuestionModel->addQuestion($username, $category, $title, $description);

        if ($questionId) {
            $this->response(array('id' => $questionId), RestController::HTTP_OK);
        } else {
            $this->response(array('error' => 'Error: Could not insert the question'), RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Retrieving questions.
    public function question_get()
    {
        $questionId = $this->get('id');
        $category = $this->get('category');
        if ($questionId) {
            $question = $this->QuestionModel->getQuestionsById($questionId);
            $categories = $this->QuestionModel->getCategories();

            if ($question) {
                $this->load->view('templates/header.php', array('isLoggedIn' => $this->UserModel->is_logged_in()));
                $this->load->view('question_view', array('question' => $question, 'categories' => $categories));
                $this->load->view('templates/footer.php');
            } else {
                $this->load->view('templates/header.php', array('isLoggedIn' => $this->UserModel->is_logged_in()));
                $this->load->view('errors/html/error_404.php', array('heading' => 'Error', 'message' => 'Error Ocurred, Page Not Found!'));
                $this->load->view('templates/footer.php');
            }
        } elseif ($category) {
            $questions = $this->QuestionModel->getQuestionsByCategory($category);
            $header = ($questions == false) ? "No $category questions found" : "$category questions (" . count($questions) . ")";

            $this->load->view('templates/header.php', array('isLoggedIn' => $this->UserModel->is_logged_in()));
            $this->load->view('question_list', array('questions' => $questions, 'header' => $header));
            $this->load->view('templates/footer.php');
        } else {
            $questions = $this->QuestionModel->getQuestionsById(null);
            $header = ($questions == false) ? "No questions added" : "All Questions (" . count($questions) . ")";

            $this->load->view('templates/header.php', array('isLoggedIn' => $this->UserModel->is_logged_in()));
            $this->load->view('question_list', array('questions' => $questions, 'header' => $header));
            $this->load->view('templates/footer.php');
        }
    }

    // Updating existing questions. 
    public function question_patch()
    {
        $id = $this->patch('id');
        $username = $this->session->username;
        $category = $this->patch('category');
        $title = $this->patch('title');
        $description = $this->patch('description');
        $this->QuestionModel->updateQuestion($id, $username, $category, $title, $description);

        $question = $this->QuestionModel->getQuestionsById($id);

        if ($question) {
            $this->response($question, RestController::HTTP_OK);
        } else {
            $this->response('Error: Could not update the question', RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Removing questions.
    public function question_delete($id)
    {
        $username = $this->session->username;
        $this->QuestionModel->removeQuestion($username, $id);

        $this->set_response(null, RestController::HTTP_NO_CONTENT);
    }

    // Upvoting a question.
    public function upvote_post()
    {
        $id = $this->post('id');
        $this->QuestionModel->upvoteQuestion($id);

        $question = $this->QuestionModel->getQuestionsById($id);
        $this->response($question, RestController::HTTP_OK);
    }

    // Downvoting a question.
    public function downvote_post()
    {
        $id = $this->post('id');
        $this->QuestionModel->downvoteQuestion($id);

        $question = $this->QuestionModel->getQuestionsById($id);
        $this->response($question, RestController::HTTP_OK);
    }

    // Loading the UI to ask a question.
    public function ask_get()
    {
        $categories = $this->QuestionModel->getCategories();

        $this->load->view('templates/header.php', array('isLoggedIn' => $this->UserModel->is_logged_in()));
        $this->load->view('add_question', array('categories' => $categories));
        $this->load->view('templates/footer.php');
    }

    // Getting the categories from the db.
    public function categories_get()
    {
        $categories = $this->QuestionModel->getCategories();

        $this->load->view('templates/header.php', array('isLoggedIn' => $this->UserModel->is_logged_in()));
        $this->load->view('categories', array('categories' => $categories));
        $this->load->view('templates/footer.php');
    }

    // Searcing for questions using keywords.
    public function search_get()
    {
        $keyword = $this->get('keyword');
        $questions = $this->QuestionModel->find($keyword);
        $header = ($questions == false) ? "No questions containing \"$keyword\" found" : "Questions containing \"$keyword\" (" . count($questions) . ")";

        $this->load->view('templates/header.php', array('isLoggedIn' => $this->UserModel->is_logged_in()));
        $this->load->view('question_list', array('questions' => $questions, 'header' => $header));
        $this->load->view('templates/footer.php');
    }
}
