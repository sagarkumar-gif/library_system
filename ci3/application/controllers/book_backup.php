<?php
/*
 * created by     : sagarkumar Meshram
 * created date   : 04-10-2019
 * 
 */
class Product extends CI_Controller{
    function __construct(){
        parent::__construct();
        
        $this->load->model('product_model');
    }
    function index(){
        $this->load->view('book');
    }
 
    function book_data(){
        $data=$this->product_model->book_list();
        echo json_encode($data);
    }
    
    function return_book(){
        $data=$this->product_model->returnbook();
        echo json_encode($data);
    }
    
    function student_data(){
         $data=$this->product_model->student_list();
         echo json_encode($data);
    }
     function book_data2(){
         $data=$this->product_model->book_list2();
         echo json_encode($data);
    }
    
    function book_available(){
         $data=$this->product_model->check_book();
         echo json_encode($data);
    }
    
    function book_issue(){
        $data=$this->product_model->issue_book();
        echo json_encode($data);
    }
 
}
