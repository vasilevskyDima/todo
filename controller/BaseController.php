<?php

namespace controller;

use system\Output;

class BaseController
{
    protected $output;

    public function __construct()
    {
        $this->output = new Output();
    }
}