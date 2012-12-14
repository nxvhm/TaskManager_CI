<?php

class Login extends CI_Controller
{
    
    public function __construct() {
        parent::__construct();
            if($this->session->userdata('logged')==true){
                redirect('Tasks');
            }
        
    }
    
    public function index()
    {
        $this->load->model('usermodel', '', TRUE);
        $this->load->library('form_validation');
        
        /**Setting Validation Rules**/
        $this->form_validation->set_rules('username', 'Username', 'callback_username_check|strip_tags');
        $this->form_validation->set_rules('password', 'Password', 'required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            //Form is validated
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $userData = $this->usermodel->checkUser($username, $password);
            
            if($userData){
                //User exists
                $this->session->set_userdata($userData);
                $this->session->set_userdata('logged', '1');
                redirect('tasks');

            }else{
                //Username and password dont match
                die('Username and password dont match');
            }
        }else{
            //Form is not validated and will load again 
            $this->load->view('header');
            $this->load->view('login_form');
            $this->load->view('footer');
        }
    }
    
    /**Callback validation functions
    ** Validate Username input field 
    *@params str
    *@return bool
    **/
    public function username_check($str){
        if((strlen($str)<5) || strlen($str)>16){
            $this->form_validation
                 ->set_message('username_check', 'The username must be between 5 and 16 characters');
            return false;
        }else{
            return true;
        }
    }

}
?>
