<?php

namespace App\Services;

use App\Helper\ServiceResponse;

class CategoryService
{
    protected $serviceResponse;

    public function __construct(
        ServiceResponse $serviceResponse
    ) {
        $this->serviceResponse = $serviceResponse;
    }
}
