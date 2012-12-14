<?php

class UserModelMapper
{
    private $_gateway;
    
    /**
    ** Assign value to $_gateway 
    *@params DB object 
    *@return void
    **/
    private function _setGateway($dbObj){
        $this->_gateway = $dbObj;
    }
    
    private function _getGateway(){
        return $this->_gateway;
    }
    
    public function __construct($dbObj){
        if($dbObj != NULL){
            $this->_setGateway($dbObj);
        }else{
            die('No DbGateway provided!');
        }
    }
    /**
    ** Create user db record 
    *@params Instance of UserModel
    *@return bool
    **/
    public function createUser(UserModel $userModel){
        $dynamicSalt = $userModel->getDynamicSalt();
        $password = $userModel->getPassword();
        $staticSalt = $userModel->getStaticSalt();
        
        $newPassword = sha1($dynamicSalt . $password . $staticSalt);
        
        
        $data = array(
            'username' => $userModel->getUsername(),
            'password' => $newPassword,
            'email' => $userModel->getEmail(),
            'salt'=>$dynamicSalt,
        );
        $db = $this->_getGateway();
        if($db->insert('users', $data)){
            return true;
        }else{
            return false;
        }
    }
    
    /**
    ** Check if username or email already exist 
    *@params str str
    *@return bool
    **/
    public function checkCredentials($username, $email){
        $db = $this->_getGateway();
        $query = $db->query("SELECT * FROM users WHERE `username`='$username' OR `email`='$email'");
        if($query->num_rows() == 0){
            //Username and email dont exist
            return true;
        }else{
            //Username or email already exist
            return false;
        }
    }
    /**
    ** Check if User Account exists 
    *@params str str
    *@return array
    **/
    public function checkUser($username, $password, $salt){
        $db = $this->_getGateway();
        $query = $db->query("
            SELECT * FROM users WHERE `username`='$username' AND `password`= SHA1(CONCAT(`salt`,'$password','$salt'))");
        if($query->num_rows() == 1){
            /**User Exists**/
            foreach($query->result() as $row){
                $userData = array(
                    'username'=>$row->username,
                    'email'=>$row->email,
                    'id'=>$row->id,
                );
            }
            return $userData;
        }
    }
}
?>
