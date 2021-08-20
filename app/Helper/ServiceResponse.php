<?php

namespace App\Helper;

class ServiceResponse
{
    private $status;

    private $message;

    private $data;

    /**
     * ServiceResponse constructor.
     *
     * @param int $status
     * @param string $message
     * @param array $data
     */
    public function __construct(
        array $data = [],
        string $message = '',
        int $status = 200
    ) {
        $this->data = $data;
        $this->message = $message;
        $this->status = $status;
    }

    public function status(): int
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ];
    }
}
