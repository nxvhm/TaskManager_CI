<?php

class Register extends CI_Controller{
    
    public function index()
    {
        $this->load->library('form_validation');
        /**Setting Validation Rules**/
        $this->form_validation->set_rules('username', 'Username', 'callback_username_check|strip_tags');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[password2]|strip_tags');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|strip_tags');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|strip_tags');
        
        if($this->form_validation->run()== FALSE){
            /**If form is not validated**/
            $this->load->view('header');
            $this->load->view('register_form');
            $this->load->view('footer');
            
        }else{
            /**If form is validated**/
            $this->load->view('header');
           
            $this->load->model('usermodel', '', TRUE);
           
           /**Generate Random Salt**/
           $salt = $this->usermodel->generateSalt();
            
            /**Filtering User Input Data from the post array**/
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'email' => $this->input->post('email'),
                'dynamicSalt' => $salt,
            );
            
           $filterData = $this->security->xss_clean($data);
           
           $this->usermodel->populate($filterData);
           
           if($this->usermodel->createUser()){
               /**User account is created**/
               $data['message'] = '<div class="message info">
                            Congrats! Your account is created! ';
               $data['message'] .= anchor('login','Please, login...') . '</div>';

               $this->load->view('message', $data);
           }else{
               $data['message'] = '<div class="message warning">
                                    Username or email already exist ';
               $data['message'] .= anchor('register','Back') . '</div>';
               $this->load->view('message', $data);
            }
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
