<?php

namespace artofwake\tamtam\client;

class Config
{
    protected $token;
    /**
     * @var string
     */
    protected $baseUrl;

    public function __construct(string $baseUrl, string $token)
    {
        $this->token = $token;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return string
     */
    public function token() : string
    {
        return $this->token;
    }

    public function baseUrl() : string
    {
        return $this->baseUrl;
    }
}