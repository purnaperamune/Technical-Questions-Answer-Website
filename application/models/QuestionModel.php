<!-- Model for Question related db interations. -->
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class QuestionModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Inserting new questions.
    function addQuestion($username, $category, $title, $description)
    {
        $this->db->set('questionCount', 'questionCount + 1', FALSE);
        $this->db->where('name', $category);
        $this->db->update('category');

        $this->db->insert(
            'question',
            array(
                'username' => $username,
                'category' => $category,
                'title' => $title,
                'description' => $description
            )
        );

        return $this->db->insert_id();
    }

    // Retrieving questions by id
    function getQuestionsById($questionId)
    {
        if ($questionId) {
            $this->db->where('id', $questionId);
            $query = $this->db->get('question');

            if ($query->num_rows() != 1) {
                return false;
            } else {
                return $query->row();
            }
        } else {
            $this->db->order_by('upvoteCount', 'DESC');
            $query = $this->db->get('question');

            if ($query->num_rows() == 0) {
                return false;
            }
            $questions = array();
            foreach ($query->result() as $row) {
                $questions[] = $row;
            }
            return $questions;
        }
    }

    // Retrieving questions by category
    function getQuestionsByCategory($category)
    {
        $this->db->where('category', $category);
        $this->db->order_by('upvoteCount', 'DESC');
        $query = $this->db->get('question');

        if ($query->num_rows() == 0) {
            return false;
        }
        $questions = array();
        foreach ($query->result() as $row) {
            $questions[] = $row;
        }
        return $questions;
    }

    // Retrieving the latest questions.
    function listTrendingQuestions()
    {
        $this->db->where('created_at >=', date('Y-m-d', strtotime('-1 week')));
        $this->db->order_by('upvoteCount', 'DESC');
        $query = $this->db->get('question');

        if ($query->num_rows() == 0) {
            return false;
        }
        $questions = array();
        foreach ($query->result() as $row) {
            $questions[] = $row;
        }
        return $questions;
    }

    // Retrieving categories.
    function getCategories()
    {
        $query = $this->db->get('category');

        if ($query->num_rows() == 0) {
            return false;
        }
        $categories = array();
        foreach ($query->result() as $row) {
            $categories[] = $row;
        }
        return $categories;
    }

    // Updating exsinting questions. 
    function updateQuestion($id, $username, $category, $title, $description)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('question');
        $existingCategory = $query->row()->category;

        if ($existingCategory != $category) {
            $this->db->set('questionCount', 'questionCount - 1', FALSE);
            $this->db->where('name', $existingCategory);
            $this->db->update('category');

            $this->db->set('questionCount', 'questionCount + 1', FALSE);
            $this->db->where('name', $category);
            $this->db->update('category');
        }

        $this->db->where(array('id' => $id, 'username' => $username));
        $this->db->update('question', array('category' => $category, 'title' => $title, 'description' => $description));
    }

    // Deleting questions. 
    function removeQuestion($username, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('question');
        $category = $query->row()->category;

        $this->db->set('questionCount', 'questionCount - 1', FALSE);
        $this->db->where('name', $category);
        $this->db->update('category');

        $this->db->delete('answer', array('questionId' => $id));
        $this->db->delete('question', array('username' => $username, 'id' => $id));
    }

    // Upvoting a question.
    function upvoteQuestion($id)
    {
        $this->db->set('upvoteCount', 'upvoteCount+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('question');
    }

    // Downvoting a question.
    function downvoteQuestion($id)
    {
        $this->db->set('upvoteCount', 'upvoteCount-1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('question');
    }

    // Finidng questions by keywords.
    function find($keyword)
    {
        $this->db->like('title', $keyword);
        $query = $this->db->get('question');

        if ($query->num_rows() == 0) {
            return false;
        }
        $questions = array();
        foreach ($query->result() as $row) {
            $questions[] = $row;
        }
        return $questions;
    }
}
