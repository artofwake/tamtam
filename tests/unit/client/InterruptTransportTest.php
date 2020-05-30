<?php

namespace client;

use artofwake\tamtam\client\chats\GetAllChats\Request;
use artofwake\tamtam\client\Config;
use artofwake\tamtam\client\InterruptTransport;
use Codeception\Test\Unit;
use GuzzleHttp\Psr7\Response;
use RuntimeException;

class InterruptTransportTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testThrow()
    {
        $transport = new InterruptTransport($this->tester->buildClient(function () {
            throw new RuntimeException("Something exception");
        }), new Config('url', 'token'));

        $this->expectExceptionObject(new RuntimeException("Something exception"));
        $transport->transport(new Request());
    }

    public function testSuccess()
    {
        $transport = new InterruptTransport($this->tester->buildClient(function () {
            return new Response(200, [], '{"response": "success"}');
        }), new Config('url', 'token'));
        $response = $transport->transport(new Request());

        $this->assertTrue($response->isAvailable());
        $this->assertIsArray($response->data());
        $this->assertEquals(['response' => 'success'], $response->data());
    }

    public function testEmpty()
    {
        $transport = new InterruptTransport($this->tester->buildClient(function () {
            return new Response(200, [], '');
        }), new Config('url', 'token'));
        $response = $transport->transport(new Request());

        $this->assertTrue($response->isAvailable());
        $this->assertIsArray($response->data());
        $this->assertEquals([], $response->data());
    }

    public function testNotJson()
    {
        $transport = new InterruptTransport($this->tester->buildClient(function () {
            return new Response(200, [], '<html><head></head><body></body></html>');
        }), new Config('url', 'token'));
        $response = $transport->transport(new Request());

        $this->assertTrue($response->isAvailable());
        $this->assertIsArray($response->data());
        $this->assertEquals([], $response->data());
    }
}
