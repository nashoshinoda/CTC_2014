<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['title'] = '[SISTEMA GEOLOCALIZACIÓN]';
        $data['main_content'] = 'home/index';
	$this->load->view('includes/template', $data);
    }
    
}