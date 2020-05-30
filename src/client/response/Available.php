<?php

namespace artofwake\tamtam\client\response;

class Available implements Response
{
    /**
     * @var array
     */
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function isAvailable(): bool
    {
        return true;
    }

    public function data(): array
    {
        return $this->data;
    }
}