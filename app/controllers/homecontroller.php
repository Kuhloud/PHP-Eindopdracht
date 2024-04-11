<?php
namespace Controllers;

class HomeController extends Controller {
    public function index() {

        require __DIR__ . '/../views/home/index.php';
    }
}