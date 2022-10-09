<?php
//products class intial

class products{
    private $conn;
     
    /**
     * Create new connection
     */
    public function __construct(){
        $this->conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }

    /**
     * add new product
     */
    public function addProduct($title,$description,$image,$price,$available,$userId){
        
        $this->conn->query("INSERT INTO `products` (`title`, `description`, `image`,`price`,`available`,`user_id`) VALUES ('$title','$description','$image','$price','$available','$userId')");
        
        if($this->conn->affected_rows > 0)
           return true ;

        return false;
    }


    /**
     * update products
     */
    public function updateProduct($id,$title,$description,$image,$price,$available,$userId){

        $sql="UPDATE `products` SET ";

        if(strlen($title) > 0)
           $sql .= "`title`='$title',";

        if(strlen($description) > 0)
           $sql .= "`description`='$description',";

        if(strlen($image) > 0)
           $sql .= "`image`='$image',";

        if(strlen($price) > 0)
           $sql .= "`price`='$price',";

        if(strlen($available) > 0)
           $sql .= "`available`='$available',";

        if(strlen($userId) > 0)
           $sql .= "`user_id`='$userId'";
        
        $sql .= " WHERE `id`=$id";

        $this->conn->query($sql);
        
        if($this->conn->affected_rows > 0)
           return true ;

        return false;
    }
 
    /**
     * delete product
     */
    public function deleteProduct($id){

        $this->conn->query("DELETE FROM `products` WHERE `id`='$id'");
        
        if($this->conn->affected_rows > 0)
           return true ;

        return false;
    }

    /**
     * get all products
     */
    public function getAllProducts($extra=''){

        $result=$this->conn->query("SELECT * FROM `products` $extra");

        if($result->num_rows >0){
            $products=array();

            while($row = $result->fetch_assoc()){
                $products[]=$row;
            }
            return $products;
        }
        return null;
    }


    /**
     * get product
     */
    public function getProduct($id){

        $products=$this->getAllProducts(" WHERE `id`='$id'");

        if($products && count($products)>0)
          return $products[0];
        
        return null;
    }


    /**
     * search product
     */
    public function searchProduct($keyword){

        $products=$this->getAllProducts(" WHERE `title` LIKE '%$keyword%'");

        if($products && count($products)>0)
          return $products;
        
        return null;
    }

    /**
     * close connection
     */
    public function __destruct(){

        $this->conn->close();
    }


}