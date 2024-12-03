<?php
class Controller {
    
    protected function displayView($model) {        
        $directory = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];
        require __DIR__ . "/../views/$directory/$view.php";
    }
    protected function sanitizeInput($input) {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
}