<?php
//messages class intial

class messages{
    private $conn;
     
    /**
     * Create new connection
     */
    public function __construct(){
        $this->conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }

    /**
     * add new message
     */
    public function addMessage($title,$content,$name,$email){
        
        $this->conn->query("INSERT INTO `messages`(`title`, `content`, `name`, `email`) VALUES ('$title','$content','$name','$email')");
        
        if($this->conn->affected_rows > 0)
           return true ;

        return false;
    }


    /**
     * update messages
     */
    public function updateMessages($id,$title,$content,$name,$email){

        $sql="UPDATE `messages` SET ";

        if(strlen($title) > 0)
           $sql .= "`title`='$title',";

        if(strlen($content) > 0)
           $sql .= "`content`='$content',";

        if(strlen($name) > 0)
           $sql .= "`name`='$name',";

        if(strlen($email) > 0)
           $sql .= "`email`='$email'";
        
        $sql .= " WHERE `id`=$id";

        $this->conn->query($sql);
        
        if($this->conn->affected_rows > 0)
           return true ;

        return false;
    }
 
    /**
     * delete message
     */
    public function deleteMessage($id){

        $this->conn->query("DELETE FROM `messages` WHERE `id`='$id'");
        
        if($this->conn->affected_rows > 0)
           return true ;

        return false;
    }

    /**
     * get all messages
     */
    public function getAllMessages($extra=''){

        $result=$this->conn->query("SELECT * FROM `messages` $extra");

        if($result->num_rows >0){
            $messages=array();

            while($row = $result->fetch_assoc()){
                $messages[]=$row;
            }
            return $messages;
        }
        return null;
    }


    /**
     * get message
     */
    public function getMessage($id){

        $messages=$this->getAllMessages(" WHERE `id`='$id'");

        if($messages && count($messages)>0)
          return $messages[0];
        
        return null;
    }


    /**
     * close connection
     */
    public function __destruct(){

        $this->conn->close();
    }


}