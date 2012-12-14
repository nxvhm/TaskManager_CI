<?php

class Settings extends CI_Controller{
    
    public function index(){
        $this->load->view('header');
        $this->load->view('settings');
        $this->load->view('footer');
    }
    
}
