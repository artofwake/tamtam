<?php

namespace artofwake\tamtam\client\response;

interface Response
{
    public function isAvailable() : bool;
    public function data() : array;
}