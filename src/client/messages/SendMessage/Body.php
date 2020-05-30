<?php

namespace artofwake\tamtam\client\messages\SendMessage;

use Webmozart\Assert\Assert;

class Body
{
    /**
     * @var string
     */
    protected $text;

    public function __construct(string $text)
    {
        Assert::maxLength($text, 4000, 'Max 4k chars');
        $this->text = $text;
    }

    public function text() : string
    {
        return $this->text;
    }
}