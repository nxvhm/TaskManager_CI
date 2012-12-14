<?php

class Tasks extends CI_Controller 
{
    
    
    public function index()
    {
        if($this->session->userdata('logged') == true){
            /**Get User Data**/
            $userId = $this->session->userdata('id');
            
            
            $this->load->model('tasksmodel');
            $data['tasks'] = $this->tasksmodel->fetchTasks($userId);
            
            $this->load->view('header');
            $this->load->view('tasks',$data);
            
            $this->load->view('footer');
            
        }else{
            redirect('login');

        }
    }
    
    public function create()
    {
        if($this->session->userdata('logged') == true){
            /**Add Task**/
            $data = array(
            "name" => $this->input->post("name"),
            "hour" => $this->input->post("hour"),  
            "date" => $this->input->post("date"),
            "content" => $this->input->post("note"),
            "completed"=>0,
            "user_id"=> $this->session->userdata('id'),
            );

            $validData = $this->security->xss_clean($data);
            $this->load->model('tasksmodel');
            if($this->tasksmodel->create($validData)){
                redirect('tasks');
            }else
            {
               $data['message'] = '<div class="message warning">
                                    Sorry! Something went wrong. Please go back, and try again :)</div>';
               $this->load->view('message',$data);
            } 
        }else{
            redirect('login');
            print'login'; 
        }
    }
    
    public function delete()
    {
        if($this->session->userdata('logged') == true){
            
            $taskId = (int)$this->uri->segment(4);
            $userId = $this->session->userdata('id');
            if($taskId){
                $this->load->model('tasksmodel');
                if($this->tasksmodel->delete($taskId, $userId)){
                    redirect('tasks');
                }else{
                   $data['message'] = '<div class="message warning">
                                        Sorry! Something went wrong. Please go back, and try again :)</div>';
                   $this->load->view('message',$data);
                }

            }
        }
    }
    
    //Show user's completed tasks
    public function completed()
    {
        if($this->session->userdata('logged') == true){
            
            /**Get User Data**/
            $userId = $this->session->userdata('id');
            
            $this->load->model('tasksmodel');
            $data['tasks'] = $this->tasksmodel->fetchCompleted($userId);
            
            $this->load->view('header');
            $this->load->view('completed',$data);
            $this->load->view('footer');
        }else{
            redirect('login');
        }
    }
    
    //Mark single task as read
    public function done()
    {
        $taskId = (int)$this->uri->segment(4);
        $userId = $this->session->userdata('id');
        $this->load->model('tasksmodel');
        $this->tasksmodel->completeTask($taskId,$userId);
    }
}

?>
