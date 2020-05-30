<?php

namespace artofwake\tamtam\client\messages\SendMessage;

use artofwake\tamtam\client\request\Request as RequestInterface;
use Webmozart\Assert\Assert;

class Request implements RequestInterface
{
    /**
     * @var int|null
     */
    protected $userId;
    /**
     * @var int|null
     */
    protected $chatId;
    /**
     * @var bool
     */
    protected $disableLinkPreview;
    /**
     * @var string
     */
    protected $body;

    public function __construct(
        Body $body,
        ?int $userId = null,
        ?int $chatId = null,
        bool $disableLinkPreview = false
    )
    {
        Assert::false(is_null($userId) && is_null($chatId), 'Set userId or chatId');
        $this->userId = $userId;
        $this->chatId = $chatId;
        $this->disableLinkPreview = $disableLinkPreview;
        $this->body = $body;
    }

    public function url(): string
    {
        return '/messages';
    }

    public function method(): string
    {
        return 'POST';
    }

    public function params(): array
    {
        $query =  [
            'disable_link_preview' => $this->disableLinkPreview ? 'true' : 'false',
        ];
        if ($this->userId) {
            $query['user_id'] = $this->userId;
        }
        if ($this->chatId) {
            $query['chat_id'] = $this->chatId;
        }

        return [
            'query' => $query,
            'json' => [
                'text' => $this->body->text()
            ],
            'headers' => [
                'Accept'  => 'application/json',
            ],
        ];
    }
}