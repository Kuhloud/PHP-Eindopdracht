<?php
class SwitchRouter {
    public function route($uri) {    
        // using a simple switch statement to route URL's to controller methods
        $explodedUri = explode('/', $uri);
        if (!isset($explodedUri[1]) || empty($explodedUri[1])) {
            $explodedUri[1] = null;
        }
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
    }
        switch($uri) {

            case '': 
                require __DIR__ . '/controllers/homecontroller.php';
                $controller = new HomeController();
                $controller->index();
                break;
            case 'board': 
                require __DIR__ . '/controllers/boardcontroller.php';
                $controller = new BoardController();
                $controller->index();
                break;
            case "board/$explodedUri[1]": 
                require __DIR__ . '/controllers/boardcontroller.php';
                $controller = new BoardController();
                $boardId = $controller->getBoardIdWithName($explodedUri[1]);
                $_GET['board_id'] = $boardId;
                $controller->board();
                break;
            case 'user': 
                require __DIR__ . '/controllers/usercontroller.php';
                $controller = new UserController();
                $controller->index();
                break;
            case 'login': 
                require __DIR__ . '/controllers/usercontroller.php';
                $controller = new UserController();
                $controller->login();
                break;
            case 'logout':
                require __DIR__ . '/controllers/usercontroller.php';
                $controller = new UserController();
                $controller->logout();
                break;
            default:
                http_response_code(404);
                break;
        }
    }
}