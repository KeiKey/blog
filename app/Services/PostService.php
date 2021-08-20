<?php

namespace App\Services;

use App\Helper\ServiceResponse;

class PostService
{
    protected $serviceResponse;

    public function __construct(
        ServiceResponse $serviceResponse
    ) {
        $this->serviceResponse = $serviceResponse;
    }
}
