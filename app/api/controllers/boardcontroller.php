<?php

namespace App\api\controllers;
use BoardService;
use ApiController;

require __DIR__ . '/apicontroller.php';
require __DIR__ . '/../services/boardservice.php';


class BoardController extends ApiController
{
    private $boardService;

    // initialize services
    function __construct()
    {
        $this->boardService = new BoardService();
    }

    public function updateThreadCount()
    {
        if(!$this->putRequest())
        {
            return;
        }

    }
    public function updatePostCount()
    {
        if(!$this->putRequest())
        {
            return;
        }

    }
}