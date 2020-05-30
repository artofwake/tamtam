<?php

namespace artofwake\tamtam\client\request;

interface Request
{
    public function url() : string;
    public function method() : string;
    public function params() : array;
}