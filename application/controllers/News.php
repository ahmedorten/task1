<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->is_logged_in();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('NewsPaper');
    }

    public function index(){
        $data = array();

        //get messages from the session
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        $data['news'] = $this->NewsPaper->getRows();

        //load the list page view
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('news/index', $data);
        $this->load->view('includes/footer');
    }

    /*
     * News details
     */
    public function view($id){
        $data = array();

        //check whether news id is not empty
        if(!empty($id)){
            $data['news'] = $this->NewsPaper->getRows($id);

            //load the details page view
            $this->load->view('includes/header');
            $this->load->view('includes/sidebar');
            $this->load->view('news/view', $data);
            $this->load->view('includes/footer');
        }else{
            redirect('/news');
        }
    }


    /*
     * Add news content
     */
    public function add(){
        $data = array();
        $newsData = array();

        //if add request is submitted
        if($this->input->post('newsSubmit')){
            //form field validation rules
            $this->form_validation->set_rules('title', 'News title', 'trim|required');
            $this->form_validation->set_rules('content', 'News content', 'trim|required');

            //prepare news data
            $newsData = array(
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content')
            );

            //validate submitted form data
            if($this->form_validation->run() == true){
                //insert news data
                $insert = $this->NewsPaper->insert($newsData);

                if($insert){
                    $this->session->set_userdata('success_msg', 'News has been added successfully.');
                    redirect('/news');
                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }

        $data['news'] = $newsData;
        $data['action'] = 'Add';

        //load the add page view
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('news/add-edit', $data);
        $this->load->view('includes/footer');
    }

    /*
     * Update news content
     */
    public function edit($id){
        $data = array();

        //get news data
        $newsData = $this->NewsPaper->getRows($id);

        //if update request is submitted
        if($this->input->post('newsSubmit')){
            //form field validation rules
            $this->form_validation->set_rules('title', 'News title', 'trim|required');
            $this->form_validation->set_rules('content', 'News content', 'trim|required');

            //prepare cms page data
            $newsData = array(
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content')
            );

            //validate submitted form data
            if($this->form_validation->run() == true){
                //update news data
                $update = $this->NewsPaper->update($newsData, $id);

                if($update){
                    $this->session->set_userdata('success_msg', 'News has been updated successfully.');
                    redirect('/news');
                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }


        $data['news'] = $newsData;
        $data['action'] = 'Edit';

        //load the edit page view
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('news/add-edit', $data);
        $this->load->view('includes/footer');
    }

    /*
     * Delete News data
     */
    public function delete($id){
        //check whether news id is not empty
        if($id){
            //delete news
            $delete = $this->NewsPaper->delete($id);

            if($delete){
                $this->session->set_userdata('success_msg', 'News has been removed successfully.');
            }else{
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }

        redirect('/news');
    }

    public function is_logged_in(){
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) |$is_logged_in != true){
            redirect('/Login');
        }
    }
}