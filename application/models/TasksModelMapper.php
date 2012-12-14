<?php

class TasksModelMapper 
{
    private $_gateway;
    /**
    ** Assign value to $_gateway 
    *@params DB object 
    *@return void
    **/
    protected function setGateway($dbObj){
        $this->_gateway = $dbObj;
    }
    
    protected function getGateway(){
        return $this->_gateway;
    }
    
    public function __construct($dbObj){
        if($dbObj != NULL){
            $this->setGateway($dbObj);
        }else{
            die('No DbGateway provided!');
        }
    }
    /**
    * Fetch all user's tasks 
    *@params int
    *@return DB result obj
    **/
    public function fetchTasks($userId){
        $db = $this->getGateway();
        $query = $db->query("SELECT * FROM tasks WHERE `user_id`='$userId' AND `completed`=0");
        $resultObj = $query->result();
        return $resultObj;

    }
    /**
    * Fetch user's completed tasks 
    *@params int
    *@return DB result obj
    **/
    public function fetchCompleted($userId){
       $db = $this->getGateway();
        $query = $db->query("SELECT * FROM tasks WHERE `user_id`='$userId' AND completed=1");
       $resultObj = $query->result();
       return $resultObj;
    }
    /**
    ** Create Db Record 
    *@params array
    *@return bool
    **/
    public function create(array $data){
        $db = $this->getGateway();
        if($db->insert('tasks', $data)){
            return true;
        }else{
            return false;
        }
    }
    /**
    ** Delete Db Record 
    *@params int 
    *@return bool
    **/
    public function delete($taskId, $userId){
        $db = $this->getGateway();
        if($db->delete('tasks',array("id"=>"$taskId","user_id"=>"$userId"))){
            return true;
        }else{
            return false;
        }
    }
    /**
    ** Mark task as done 
    *@params int, int
    *@return bool
    **/
    public function completeTask($taskId,$userId){
        $db = $this->getGateway();
        $data = array('completed'=>1);
        if($db->update('tasks',$data,array("id"=>"$taskId","user_id"=>"$userId"))){
            return true;
        }else{
            return false;
        }
    }   
}
?>
