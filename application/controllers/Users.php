<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->is_logged_in();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user');
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

        $data['users'] = $this->user->getRows();

        //load the list page view
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('users/index', $data);
        $this->load->view('includes/footer');
    }

    /*
     * User details
     */
    public function view($id){
        $data = array();

        //check whether user id is not empty
        if(!empty($id)){
            $data['user'] = $this->user->getRows($id);

            //load the details page view
            $this->load->view('includes/header');
            $this->load->view('includes/sidebar');
            $this->load->view('users/view', $data);
            $this->load->view('includes/footer');
        }else{
            redirect('/users');
        }
    }

    /*
     * Add user content
     */
    public function add(){
        $data = array();
        $userData = array();

        //if add request is submitted
        if($this->input->post('userSubmit')){
            //form field validation rules
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
            $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
            $this->form_validation->set_rules('job', 'Job', 'trim|required');


            //prepare user data
            $userData = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'job' => $this->input->post('job')
            );

            //validate submitted form data
            if($this->form_validation->run() == true){
                //insert user data
                $insert = $this->user->insert($userData);

                if($insert){
                    $this->session->set_userdata('success_msg', 'User has been added successfully.');
                    redirect('/users');
                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }

        $data['user'] = $userData;
        $data['action'] = 'Add';

        //load the add page view
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('users/add-edit', $data);
        $this->load->view('includes/footer');
    }

    /*
     * Update post content
     */
    public function edit($id){
        $data = array();

        //get user data
        $userData = $this->user->getRows($id);
        $password = md5($userData['password']);

        //if update request is submitted
        if($this->input->post('userSubmit')){
            //form field validation rules
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
            $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
            $this->form_validation->set_rules('job', 'Job', 'trim|required');

            //prepare cms page data
            $userData = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'job' => $this->input->post('job')
            );

            //validate submitted form data
            if($this->form_validation->run() == true){
                //update user data
                $update = $this->user->update($userData, $id);

                if($update){
                    $this->session->set_userdata('success_msg', 'User has been updated successfully.');
                    redirect('/users');
                }else{
                    $data['error_msg'] = 'Some problems occurred, please try again.';
                }
            }
        }


        $data['user'] = $userData;
        $data['action'] = 'Edit';

        //load the edit page view
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('users/add-edit', $data);
        $this->load->view('includes/footer');
    }

    /*
     * Delete user data
     */
    public function delete($id){
        //check whether user id is not empty

        if($id){
            //delete user
            $delete = $this->user->delete($id);


            if($delete){
                $this->session->set_userdata('success_msg', 'User has been removed successfully.');
            }else{
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.');
            }
        }

        redirect('/users');
    }
    public function is_logged_in(){
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) |$is_logged_in != true){
            redirect('/Login');
        }
    }
}