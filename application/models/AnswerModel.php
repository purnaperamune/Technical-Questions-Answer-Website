<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AnswerModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Inserting answers.
    function addAnswer($questionId, $username, $description)
    {
        $this->db->set('answerCount', 'answerCount + 1', FALSE);
        $this->db->where('id', $questionId);
        $this->db->update('question');

        $this->db->insert(
            'answer',
            array(
                'questionId' => $questionId,
                'username' => $username,
                'description' => $description
            )
        );

        return $this->db->insert_id();
    }

    // Retrieving answers by id
    function getAnswerById($answerId)
    {
        $this->db->where('id', $answerId);
        $query = $this->db->get('answer');

        if ($query->num_rows() != 1) {
            return false;
        } else {
            return $query->row();
        }
    }

    // Retrieving answers for the selected question.
    function getAnswers($questionId)
    {
        $this->db->order_by('upvoteCount', 'DESC');
        $this->db->where('questionId', $questionId);
        $query = $this->db->get('answer');

        if ($query->num_rows() == 0) {
            return false;
        }
        $answers = array();
        foreach ($query->result() as $row) {
            $answers[] = $row;
        }
        return $answers;
    }

    // Updating existing answers.
    function updateAnswer($answerId, $username, $description)
    {
        $this->db->where(array('id' => $answerId, 'username' => $username));
        $this->db->update('answer', array('description' => $description));
    }

    // Deleting an answer.
    function removeAnswer($username, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('answer');
        $questionId = $query->row()->questionId;

        $this->db->set('answerCount', 'answerCount - 1', FALSE);
        $this->db->where('id', $questionId);
        $this->db->update('question');

        $this->db->delete('answer', array('username' => $username, 'id' => $id));
    }

    // Upvoting an answer.
    function upvoteAnswer($answerId)
    {
        $this->db->set('upvoteCount', 'upvoteCount+1', FALSE);
        $this->db->where('id', $answerId);
        $this->db->update('answer');
    }

    // Downvoting an asnwer.
    function downvoteAnswer($answerId)
    {
        $this->db->set('upvoteCount', 'upvoteCount-1', FALSE);
        $this->db->where('id', $answerId);
        $this->db->update('answer');
    }
}
