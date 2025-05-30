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
        if (!empty($explodedUri[1]) && is_numeric($explodedUri[1])) {
            $_SESSION['idForController'] = $explodedUri[1];
        }
        if (!isset($explodedUri[1]) || empty($explodedUri[1]) || is_numeric($explodedUri[1])) {
            $explodedUri[1] = $defaultmethod;
        }
        if (isset($explodedUri[2]) && is_numeric($explodedUri[2])) {
            $_SESSION['idForController'] = $explodedUri[2];
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
        $controllerObj->{$methodName}();
    }
}
