<?php

namespace App\Services;

use App\Helper\ServiceResponse;

class UserService
{
    protected $serviceResponse;

    public function __construct(
        ServiceResponse $serviceResponse
    ) {
        $this->serviceResponse = $serviceResponse;
    }
}
