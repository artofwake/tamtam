<?php

namespace artofwake\tamtam\client\chats\GetAllChats;

use artofwake\tamtam\client\Config;
use artofwake\tamtam\client\request\Request as RequestInterface;

class Request implements RequestInterface
{
    /**
     * @var int
     */
    protected $count;
    /**
     * @var int
     */
    protected $market;

    public function __construct(int $count = 50, int $market = null)
    {
        $this->count = $count;
        $this->market = $market;
    }

    public function url() : string
    {
        return '/chats';
    }

    public function method() : string
    {
        return 'GET';
    }

    public function params() : array
    {
        $params = [
            'count' => $this->count
        ];

        if ($this->market) {
            $params['marker'] = $this->market;
        }

        return [
            'query' => $params,
            'headers' => [
                'Accept'  => 'application/json',
            ],
            'debug' => false
        ];
    }
}