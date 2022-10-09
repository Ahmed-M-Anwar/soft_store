<?php 
//users class intial

class users
{
    private $conn;
     
    /**
     * Create new connection
     */
    public function __construct(){
        $this->conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }

    /**
     * add new user
     */
    public function addUser($username,$password,$email){

        $this->conn->query("INSERT INTO `users` (`username`, `password`, `email`) VALUES ('$username','$password','$email')");
        
        if($this->conn->affected_rows > 0)
           return true ;

        return false;
    }


    /**
     * update user
     */
    public function updateUser($id,$username,$password,$email){

        $sql="UPDATE `users` SET ";

        if(strlen($username) > 0)
           $sql .= "`username`='$username',";

        if(strlen($password) > 0)
           $sql .= "`password`='$password',";

        if(strlen($email) > 0)
           $sql .= "`email`='$email'";
        
        $sql .= " WHERE `id`=$id";

        $this->conn->query($sql);
        
        if($this->conn->affected_rows > 0)
           return true ;

        return false;
    }

    /**
     * delete user
     */
    public function deleteUser($id){

        $this->conn->query("DELETE FROM `users` WHERE `id`='$id'");
        
        if($this->conn->affected_rows > 0)
           return true ;

        return false;
    }


    /**
     * 
     * get all users
     */
    public function getAllUsers($extra=''){

        $result=$this->conn->query("SELECT * FROM `users` $extra");

        if($result->num_rows >0){
            $users=array();

            while($row = $result->fetch_assoc()){
                $users[]=$row;
            }
            return $users;
        }
        return null;
    }


    /***
     * get user by id
     * 
     */
    public function getUser($id){

        $users=$this->getAllUsers(" WHERE `id`='$id'");

        if($users && count($users)>0)
          return $users[0];
        
        return null;
    }


    /**
     * login user
     */
    public function login($username,$password){

        $users=$this->getAllUsers(" WHERE `username`='$username' AND `password`='$password'");

        if($users && count($users)>0)
          return $users[0];
        
        return null;
    }

    /**
     * close connection
     */
    public function __destruct(){

        $this->conn->close();
    }

}