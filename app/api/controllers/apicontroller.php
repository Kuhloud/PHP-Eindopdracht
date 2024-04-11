<?php
namespace Api\Controllers;
class ApiController{
    protected function postRequest(){
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function getRequest(){
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    protected function putRequest(){
        return $_SERVER['REQUEST_METHOD'] == 'PUT';
    }

    protected function deleteRequest(){
        return $_SERVER['REQUEST_METHOD'] == 'DELETE';
    }

    protected function getJsonData() {
        $json = file_get_contents('php://input', true);
        return json_decode($json);
    }
    protected function sanitizeInput($input) {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
    protected function quickJsonTest($data)
    {
        echo json_encode(array("status" => "test", "data" => $data));
        
    }
    // private function handleResponse($data)
    // {
    //     try {
    //         echo json_encode(["status" => "success", `data` => $data], JSON_THROW_ON_ERROR);
    //     } catch (Exception $e) {
    //         echo json_encode(["status" => "error", "message" => $e->getMessage()], JSON_THROW_ON_ERROR);
    //     }
    // }

    // Isset function for multiple variables
    

}