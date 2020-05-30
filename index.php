<?php
include 'vendor/autoload.php';

use artofwake\tamtam\client\Config;
use artofwake\tamtam\client\messages\SendMessage\Request;
use artofwake\tamtam\client\InterruptTransport;
use artofwake\tamtam\client\messages\SendMessage\Body;
use artofwake\tamtam\client\MuteTransport;
use GuzzleHttp\Client;

$config = new Config('https://botapi.tamtam.chat', 'token');

$transport = new MuteTransport(
    new InterruptTransport(
        new Client(['base_uri' => $config->baseUrl()]),
        $config
    )
);
$response = ($transport)->transport(
    new Request(new Body('hello'), 11122)
);
if ($response->isAvailable()) {
    var_dump($response->data());
} else {
    var_dump($response->code());
    var_dump($response->message());
}