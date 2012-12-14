<?php

class Logout extends CI_Controller
{
    public function index(){
        if($this->session->userdata('logged')== true){
            $this->session->sess_destroy();
            redirect('tasks');
            print 'red';
        }
    }
}
?>
