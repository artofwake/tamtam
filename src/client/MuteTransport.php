<?php

namespace artofwake\tamtam\client;

use artofwake\tamtam\client\request\Request;
use artofwake\tamtam\client\response\Response;
use artofwake\tamtam\client\response\Unavailable;
use GuzzleHttp\Exception\BadResponseException;
use Throwable;

class MuteTransport implements Transport
{
    /**
     * @var Transport
     */
    protected $next;

    public function __construct(Transport $next)
    {
        $this->next = $next;
    }

    public function transport(Request $request): Response
    {
        try {
            return $this->next->transport($request);
        } catch (BadResponseException $e) {
            return new Unavailable($e->getCode(), $e->getMessage());
        } catch (Throwable $e) {
            return new Unavailable(0, $e->getMessage());
        }
    }
}