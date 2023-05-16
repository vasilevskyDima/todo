<?php

namespace controller;

use system\Output;

class Index
{
    private $output;

    public function __construct()
    {
        $this->output = new Output();
    }

    public function index() {
        $test = "sdacewqveqw";
        $this->output->view('index', ['test' => $test]);
    }

}