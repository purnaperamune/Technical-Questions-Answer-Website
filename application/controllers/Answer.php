<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . 'libraries/RestController.php';

class Answer extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AnswerModel');
        $this->load->model('UserModel');
    }

    public function answer_post()
    {
        $questionId = $this->post('questionId');
        $username = $this->session->username;
        $description = $this->post('description');
        $answerId = $this->AnswerModel->addAnswer($questionId, $username, $description);

        $answer = $this->AnswerModel->getAnswerById($answerId);

        if ($answer) {
            $this->response($answer, RestController::HTTP_OK);
        } else {
            $this->response('Error: Could not insert the answer', RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function answers_get()
    {
        $questionId = $this->get('questionId');
        $answers = $this->AnswerModel->getAnswers($questionId);

        if ($answers) {
            $this->response($answers, RestController::HTTP_OK);
        } else {
            $this->response('Error: Could not load the answer', RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function answer_patch()
    {
        $answerId = $this->patch('id');
        $username = $this->session->username;
        $description = $this->patch('description');
        $this->AnswerModel->updateAnswer($answerId, $username, $description);

        $answer = $this->AnswerModel->getAnswerById($answerId);

        if ($answer) {
            $this->response($answer, RestController::HTTP_OK);
        } else {
            $this->response('Error: Could not update the answer', RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function answer_delete($id)
    {
        $username = $this->session->username;
        $this->AnswerModel->removeAnswer($username, $id);

        $this->set_response(null, RestController::HTTP_NO_CONTENT);
    }

    public function upvote_post()
    {
        $answerId = $this->post('answerId');
        $this->AnswerModel->upvoteAnswer($answerId);

        $answer = $this->AnswerModel->getAnswerById($answerId);
        $this->response($answer, RestController::HTTP_OK);
    }

    public function downvote_post()
    {
        $answerId = $this->post('answerId');
        $this->AnswerModel->downvoteAnswer($answerId);

        $answer = $this->AnswerModel->getAnswerById($answerId);
        $this->response($answer, RestController::HTTP_OK);
    }
}
