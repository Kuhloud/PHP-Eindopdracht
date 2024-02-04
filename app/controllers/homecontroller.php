<?php
require __DIR__ . '/controller.php';

class HomeController extends Controller {
    public function index() {
        session_start();
        require __DIR__ . '/../views/home/index.php';
    }
}