<?php

namespace controller;

class Index extends BaseController
{
    /**
     * @return void
     */
    public function index()
    {
        $this->output->view('index');
    }
}