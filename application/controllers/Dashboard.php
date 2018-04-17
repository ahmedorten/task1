<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}

	public function index(){
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('dashboard');
		$this->load->view('includes/footer');
	}
	public function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) |$is_logged_in != true){
			redirect('/Login');
		}
	}
	
}
