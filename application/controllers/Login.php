<?php
class Login extends CI_Controller{

    function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
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
        $this->is_logged_in();
        $this->load->view('login',$data);
    }
    public function validate_credentials(){
        $this->load->model('user');
        $query = $this->user->validate();

        if($query)
        {
            $data =array(
                'username' => $this->input->post('username'),
                'is_logged_in' => true ,
                'id' => $this->input->post('id')
            );
            $this->session->set_userdata($data);
            redirect('Dashboard/index');
            $this->session->set_userdata('success_msg', 'Welcome to dashboard');
        }else{
            $this->index();
            $this->session->set_userdata('error_msg', 'Wrong ! username or password');
        }
    }


    function logout()
    {
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        redirect('login');
    }
    public function is_logged_in(){
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(isset($is_logged_in) |$is_logged_in == true){
            redirect('dashboard');
        }
    }
}
