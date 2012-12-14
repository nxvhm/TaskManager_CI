<?php

class TasksModel extends CI_Model
{
    private $_id;
    private $_name;
    private $_content;
    private $_completed;
    private $_hour;
    private $_userId;
  
    
    protected $_isConnected;
    protected $_mapper; /**Model Mapper Instance**/

    public function __construct(){
        if($this->_mapper === null){
             /**Second Param. allow DbConnection**/
            $this->setMapper($this->load->mapper('TasksModelMapper', TRUE));
        }
    }
    
    public function setMapper($mapper){
        $this->_mapper = $mapper;
    }
    
    public function getMapper(){
        return $this->_mapper;
    }

    /**
    ** Assign values to attributes 
    *@params array
    *@return void
    **/
    public function populate(array $options){
        if(is_array($options)){
            $methods = get_class_methods($this);
            foreach($options as $key => $value){
                $method = 'set' . ucfirst($key);
                if(in_array($method, $methods)){
                   $this->$method($value); 
                }
            }  
        }
    }
    /**
    * Fetch user's current tasks 
    *@params int
    *@return DB result obj
    **/
    public function fetchTasks($userId){
       return $this->getMapper()->fetchTasks($userId);
    }
    /**
    * Fetch user's completed tasks 
    *@params int
    *@return DB result obj
    **/
    public function fetchCompleted($userId){
       return $this->getMapper()->fetchCompleted($userId);
    }
    /**
    ** Create Db Record 
    *@params array 
    *@return bool
    **/
    public function create(array $data){
        return $this->getMapper()->create($data);
    }
    /**
    ** Delete Db Record 
    *@params int 
    *@return bool
    **/
    public function delete($taskId, $userId){
        return $this->getMapper()->delete($taskId, $userId);
    }
    /**
    ** Mark task as done 
    *@params int, int
    *@return bool
    **/
    public function completeTask($taskId,$userId){
        return $this->getMapper()->completeTask($taskId, $userId);
    }   
    
    

    
    public function getId(){
        return $this->_id;
    }
    /** @param int **/
    public function setId($id){
        $this->_id = $id;
    }
    
    public function getName(){
        return $this->_name;
    }
    /** @param string **/
    public function setName($name){
        $this->_name = $name;
    }
    
    public function getContent(){
        return $this->_content;
    }
    /** @param string **/
    public function setContent($content){
        $this->_content = $content;
    }
    
    public function getHour(){
        return $this->_hour;
    }
    
    public function setHour($hour){
        $this->_hour = $hour;
    }
    public function getUserId(){
        return $this->_userId;
    }
    
    public function setUserId($value){
        $this->_userId = $value;
    }
    
}
?>
