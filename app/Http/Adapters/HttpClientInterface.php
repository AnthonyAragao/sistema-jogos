<?php

namespace App\Http\Adapters;

interface HttpClientInterface
{
    public function get(string $endpoint, array $params = []);
}
