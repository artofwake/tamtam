<?php

namespace artofwake\tamtam\client\response;

use RuntimeException;

class Unavailable implements Response
{
    protected $code;
    /**
     * @var string
     */
    protected $message;

    public function __construct(int $code, string $message = '')
    {
        $this->code = $code;
        $this->message = $message;
    }

    public function isAvailable(): bool
    {
        return false;
    }

    public function code() : int
    {
        return $this->code;
    }

    public function message() : string
    {
        return $this->message;
    }

    public function data(): array
    {
        throw new RuntimeException('Data can not be obtained since response is unavailable');
    }
}