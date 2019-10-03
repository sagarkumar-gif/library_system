<?php
/*
 * created by     : sagarkumar Meshram
 * created date   : 04-10-2019
 * 
 */
class Product_model extends CI_Model {

    function book_list() {
        $this->db->select('*');
        $this->db->from('book');
        $this->db->join('book_status', 'book.id = book_status.b_id');
        $this->db->join('student', 'book_status.stud_id = student.id');
        $this->db->where('book_status.isIssue', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function student_list() {
        $query = $this->db->get('student');
        return $query->result();
    }

    function book_list2() {
        $query = $this->db->get('book');
        return $query->result();
    }

    function returnbook() {
        $product_code = $this->input->post('product_code');
        $this->db->set('isIssue', 0);
        $this->db->where('b_id', $product_code);
        //$this->db->where('isIssue', 1);
        $result = $this->db->update('book_status');

        return $result;
    }

    function check_book() {
        // $stud_id=$this->input->post('stud_id');
        $book_id = $this->input->post('book_id');
        $this->db->select('*');
        $this->db->from('book_status');
        $this->db->where('b_id', $book_id);
        $this->db->where('isIssue', 1);
        $q = $this->db->get();
        return $q->num_rows();
    }

    function issue_book() {
        $data = array(
            'stud_id' => $this->input->post('stud_id'),
            'b_id' => $this->input->post('book_id'),
            'isIssue' => '1',
        );
        $this->db->select('*');
        $this->db->from('book_status');
        $this->db->where('b_id', $data['b_id']);
        //$this->db->where('stud_id', $data['stud_id']);
        $this->db->where('isIssue', 1);
        $q = $this->db->get();
        //echo $q->num_rows();die;
        if ($q->num_rows() > 0) {
            return false;
        } else {
            $result = $this->db->insert('book_status', $data);
            return $result;
        }
    }

}
