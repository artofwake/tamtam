<?php

namespace client;

use artofwake\tamtam\client\chats\GetAllChats\Request;
use artofwake\tamtam\client\Config;
use artofwake\tamtam\client\InterruptTransport;
use artofwake\tamtam\client\MuteTransport;
use Codeception\Test\Unit;
use RuntimeException;

class MuteTransportTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testException()
    {
        $transport = new MuteTransport(
            new InterruptTransport(
                $this->tester->buildClient(function () {
                    throw new RuntimeException("Something exception");
                }),
                new Config('url', 'token')
            )
        );

        $response = $transport->transport(new Request());
        $this->assertFalse($response->isAvailable());
    }
}
