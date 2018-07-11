<?php

namespace Cityfrog\Ipay\Entity;

class User {

    /** @var string $phone */
    protected $phone;

    /** @var string $userId */
    protected $userId;

    /**
     * User constructor.
     * @param string $phone
     * @param string $userId
     */
    public function __construct(string $phone, string $userId)
    {
        $this->phone = $phone;
        $this->userId = $userId;
    }

    /**
     * @return array
     */
    public function getRequestBody(): array
    {
        return [
            'msisdn' => $this->phone,
            'user_id' => $this->userId
        ];
    }
}
