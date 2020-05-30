<?php

namespace artofwake\tamtam\client;

use artofwake\tamtam\client\request\Request;
use artofwake\tamtam\client\response\Response;
use artofwake\tamtam\client\response\Available;
use GuzzleHttp\Client;

class InterruptTransport implements Transport
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Config
     */
    protected $config;

    public function __construct(Client $client, Config $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    public function transport(Request $request) : Response
    {
        $options = array_merge_recursive($request->params(),
            [
                'query' => [
                    'access_token' => $this->config->token()
                ]
            ]
        );

        $response = $this->client->request($request->method(), $request->url(), $options);
        $content = json_decode($response->getBody()->getContents(), true);
        return new Available(is_null($content) ? [] : $content);
    }
}