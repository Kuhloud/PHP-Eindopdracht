<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/boardservice.php';

class HomeController extends Controller {

    private $boardService;
    function __construct() {
        $this->boardService = new BoardService();
    }
    public function index() {

        require __DIR__ . '/../views/home/index.php';
    }
    public function boards() {
        // retrieve data
        $boards = $this->boardService->getAll();

        // show view, param = accessible as $model in the view
        // displayView maps this to /views/boards/boards.php automatically
        $this->displayView($boards);
    }
}