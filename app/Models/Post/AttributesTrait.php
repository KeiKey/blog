<?php

namespace App\Models\Post;

trait AttributesTrait
{
    public function userId()
    {
        return $this->user()->id;
    }
}
