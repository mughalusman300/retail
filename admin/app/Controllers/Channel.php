<?php

namespace App\Controllers;
use channelEngine;
use numSeq;

class Channel extends BaseController
{

    function __construct() 
    {
        $this->channelEngine = new channelEngine();            
    }

    public function index()
    {
        $this->channelEngine = new channelEngine();
        $this->channelEngine->test();
        echo numSeq::num();
        //return view('welcome_message');
    }
}
