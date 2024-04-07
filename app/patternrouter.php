<?php
class PatternRouter
{

    private function stripParameters($uri)
    {
        if (str_contains($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        return $uri;
    }
    public function route($uri)
    {
        // Path algorithm
        // pattern = /controller/method

        // check if we are requesting an api route
        $api = false;
        if (str_starts_with($uri, "api/")) {
            $uri = substr($uri, 4);
            $api = true;
        }

        // set default controller/method
        $defaultcontroller = 'home';
        $defaultmethod = 'index';

        // ignore query parameters
        $uri = $this->stripParameters($uri);

        // read controller/method names from URL
        $explodedUri = explode('/', $uri);

        if (!isset($explodedUri[0]) || empty($explodedUri[0])) {
            $explodedUri[0] = $defaultcontroller;
        }
        if (!isset($explodedUri[1]) || empty($explodedUri[1]) || isset($explodedUri[2])) {
            $explodedUri[1] = $defaultmethod;
        }
        if (!empty($explodedUri[2])) {
            $explodedUri[0] = "thread";
        }
        $controllerName = $explodedUri[0] . "controller";
        $methodName = $explodedUri[1];
        

        // load the file with the controller class
        $filename = __DIR__ . '/controllers/' . $controllerName . '.php';
        if ($api) {
            $filename = __DIR__ . '/api/controllers/' . $controllerName . '.php';
        }
        if (file_exists($filename)) {
            require $filename;
        } else {
            http_response_code(404);
            die();
        }
        // dynamically call relevant controller method

        $controllerObj = new $controllerName;
        // for board.php
        if ($controllerName == 'boardcontroller' && $methodName != 'index') {
            $boardId = $explodedUri[1];
            $boardId = $controllerObj->getBoardById($boardId);
            $_SESSION['board_id'] = $explodedUri[1]; 
            $methodName = 'board'; 
        }
        // for thread.php
        if ($controllerName == 'threadcontroller' && $api == false) {
            $methodName = $defaultmethod;
            $_SESSION['thread_id'] = $explodedUri[2]; 
        }
        else if ($controllerName == 'threadcontroller' && isset($explodedUrl[3]) && $api == false) {
            $methodName = 'createthread';
        }
        $controllerObj->{$methodName}();
    }
}
