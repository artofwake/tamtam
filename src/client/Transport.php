<?php

namespace artofwake\tamtam\client;

use artofwake\tamtam\client\request\Request;
use artofwake\tamtam\client\response\Response;

interface Transport
{
    public function transport(Request $request) : Response;
}