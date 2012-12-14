<?php

class UserModel extends CI_Model
{
    private $_id;
    private $_username;
    private $_password;
    private $_email;
    
    private $_staticSalt = '2r6h9d87gh0';
    private $_dynamicSalt;
    private $_mapper; /**data mapper instance**/
    
    public function __construct(){
        if($this->_mapper === null){
             /**Second Param. allow DbConnection**/
            $this->setMapper($this->load->mapper('UserModelMapper', TRUE));
        }
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
    ** Check if username or email already exist 
    *@params str str
    *@return bool
    **/
    private  function checkCredentials($username, $email){
        return $this->_getMapper()->checkCredentials($username, $email);
    }
    
    /**
    ** Check if User Account exists 
    *@params str str
    *@return array
    **/
    public function checkUser($username, $password){
        $staticSalt = $this->getStaticSalt();
        return $this->_getMapper()->checkUser($username, $password, $staticSalt);  
    }
    
    public function createUser(){
        if($this->checkCredentials($this->getUsername(),$this->getEmail())){
            if($this->_getMapper()->createUser($this)){
                return true;
            }
        }else{
            return false;
        }
    }

    /**
    **Generate Random Salt string 
    *@params void
    *@return void 
    **/
    public function generateSalt(){
        $string = md5(uniqid(rand(), true));
        $this->_dynamicSalt = $string;
    }
    
    /**Setters and getters**/
    
    public function getUsername(){
       return $this->_username;
    }
    public function setUsername($username){
        $this->_username = $username;
    }
            
    public function getEmail(){
       return $this->_email;
    }
    public function setEmail($email){
        $this->_email = $email;
    }
    public function getDynamicSalt(){
        return $this->_dynamicSalt;
    }
    public function getStaticSalt(){
        return $this->_staticSalt;
    }
    public function setStaticSalt($value){
        $this->_staticSalt = $value;
    }
    
    public function getPassword(){
        return $this->_password;
    }
    public function setPassword($password){
        $this->_password = $password;
    }
    private function _getMapper(){
        return $this->_mapper;
    }
    public function setMapper($mapper){
        $this->_mapper = $mapper;
    }
    
}

?>
