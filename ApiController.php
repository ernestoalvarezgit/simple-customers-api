<?php

class ApiController{

    public function __construct(){
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }
    
    
    public function get_customer($id){
        try {
            $statement = $this->conn->prepare("SELECT * FROM customers WHERE id=?");
            $statement->bind_param("i", $id);
            $statement->execute();

            $result = $statement->get_result();
            $customer = $result->fetch_assoc(); 

            return $customer;


        } catch(Exception $e){
            throw New Exception ( $e->getMessage()); 
        }
        return false;
        
        
    }

    
    public function get_customers($limit = NULL){
        try {

            if($limit)  
                $statement = $this->conn->prepare("SELECT * FROM customers LIMIT $limit");
            else
                $statement = $this->conn->prepare("SELECT * FROM customers");

                $statement->execute();

            $result = $statement->get_result();
            $customers = $result->fetch_all(MYSQLI_ASSOC); 

            return $customers;

        } catch(Exception $e){
            throw New Exception ( $e->getMessage()); 
        }
        return false;
        
    }
    
    public function create_customer($data){
        try {
            $statement = $this->conn->prepare("INSERT INTO customers (customer_name, customer_address, customer_contact) VALUES (?, ?, ?)");
            $statement->bind_param("sss", $data['customer_name'], $data['customer_address'], $data['customer_contact']);
            
            if($statement->execute()){

                $response['message'] = 'data successfully inserted';
                $response['status'] = 'Ok';
            } else{

                $response['message'] = 'data not saved';
                $response['status'] = 'Error';

            }

            return $response;

        } catch(Exception $e){
            throw New Exception ( $e->getMessage()); 
        }
        return false;
        
    }

    public function update_customer($data, $id){
        try {


            $statement = $this->conn->prepare("UPDATE customers SET customer_name = ?,
            customer_address = ?, customer_contact = ?  WHERE id = ? ");

            $statement->bind_param("sssd",$data['customer_name'], $data['customer_address'], $data['customer_contact'], $id);

            if($statement->execute()){

                $response['message'] = 'data successfully updated';
                $response['status'] = 'Ok';
            } else{

                $response['message'] = 'data not saved';
                $response['status'] = 'Error';

            }

            return $response;

        } catch(Exception $e){
            throw New Exception ( $e->getMessage()); 
        }
        return false;



    }

    public function patch_customer($data, $id){
        try {

            $set_string = '';
            $set_string_array = [];

            foreach($data as $key=>$value){
                $set_string_array[] = $key . "= '".$value. "' ";
            }

            $set_string = implode(',',$set_string_array);

            $statement = $this->conn->prepare("UPDATE customers SET ". $set_string ." WHERE id = ".$id);
            
            if($statement->execute()){

                $response['message'] = 'data successfully updated';
                $response['status'] = 'Ok';

            }else{
                $response['message'] = 'data not saved';
                $response['status'] = 'Error';

            }        
            return $response;

        } catch(Exception $e){
            throw New Exception ( $e->getMessage()); 
        }
        return false;



    }

    public function delete_customer($id){
        try {
            $statement = $this->conn->prepare("DELETE from customers WHERE id=?");
            $statement->bind_param("d",$id);

            if($statement->execute()){

                $response['message'] = 'data successfully deleted';
                $response['status'] = 'Ok';
                
            }else{
                $response['message'] = 'data not deleted';
                $response['status'] = 'Error';

            }     
            return $response;

        } catch(Exception $e){
            throw New Exception ( $e->getMessage()); 
        }
        return false;


    }

    public static function dd($object){
        echo '<pre>';
            print_r($object);
        echo '</pre>';
    }

    public static function get_uri(){

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        return $uri;

    }
    
}