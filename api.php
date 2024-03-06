<?php
include('db.php');
include('ApiController.php');

/** LETS NOW proceed with the REST API structure  */

// get uri parts now 
$uri = ApiController::get_uri();

// get server request method
$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

parse_str($_SERVER['QUERY_STRING'],$url_array);

$limit = isset($url_array['limit']) ? $url_array['limit'] : null;

// listing all customers 
if(( isset($uri[3]) &&  isset($uri[4])) 
    && $uri[3] == 'customer' && $uri[4] == 'list'
    && $request_method == 'GET')
{

    // GET ALL CUSTOMERS API ENDPOINT
    
    $api = new ApiController;
    $customers = $api->get_customers($limit);

    http_response_code(200);
    echo json_encode($customers);


} elseif(
    ( isset($uri[3]) &&  isset($uri[4]) && isset($uri[5]))  
    && $uri[3] == 'customer' && $uri[4] == 'show'
    && $request_method == 'GET')
{ // list single customer

    $id = $uri[5];

    $api = new ApiController;
    $customer = $api->get_customer($id);

    http_response_code(200);
    echo json_encode($customer);

} elseif( isset($uri[3]) AND $uri[3] == 'customer' && $request_method == 'POST'){

    // INSERT API ENDPOINT
    //insert a record as no id is passed on the URL 

    $proceed_insert = false;

    if(isset($uri[4]) AND $uri[4] == ""){ // if there is a slash at end and empty 
        $proceed_insert = true;
    }elseif(!isset($uri[4])){ // if there is no url 4 
        $proceed_insert = true;
    }

    if($proceed_insert){
        $api = new ApiController;
        $result = $api->create_customer($_POST);

        echo json_encode($result);
    }
} elseif( isset($uri[3]) AND $uri[3] == 'customer' && 
    isset($uri[4]) AND $uri[4] != ''
    && $request_method == 'PUT'){

    //UPDATE method 

    parse_str(file_get_contents("php://input"),$post_vars);

    $id = $uri[4];
    $api = new ApiController;
    $result = $api->update_customer($post_vars, $id);
    echo json_encode($result);
} elseif( isset($uri[3]) AND $uri[3] == 'customer' && 
isset($uri[4]) AND $uri[4] != ''
&& $request_method == 'PATCH'){

    //PATCH method 

    parse_str(file_get_contents("php://input"),$post_vars);

    $id = $uri[4];
    $api = new ApiController;
    $result = $api->patch_customer($post_vars, $id);
    echo json_encode($result);

}elseif( isset($uri[3]) AND $uri[3] == 'customer' && 
isset($uri[4]) AND $uri[4] != ''
&& $request_method == 'DELETE'){

    $id = $uri[4];
    $api = new ApiController;
    $result = $api->delete_customer($id);

    echo json_encode($result);



}

?>