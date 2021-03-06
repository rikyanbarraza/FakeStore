<?php
session_start();
require("./../repositories/orderRepository.php");

try{
    if(isset($_SERVER["REQUEST_METHOD"])) {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if($_POST["action"] == "saveOrder") {
                $order = json_decode($_POST["order"], true);
                
                //echo json_encode(gettype($order));
                echo json_encode(saveOrder($order));
               
                 exit;
            }

        }else{

            throw new ErrorException("Wrong request method used", 405);
        }

    }else{

    throw new ErrorException("No endpoint found", 404);
    }
} catch(Exception $e){
    http_response_code($e->getCode());
    echo json_encode(array(
        "status" => $e->getCode(),
         "Message" => $e->getMessage()
        )
    );
}