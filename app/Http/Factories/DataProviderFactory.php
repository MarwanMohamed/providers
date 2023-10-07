<?php

namespace App\Http\Factories;

use InvalidArgumentException;

class DataProviderFactory
{
    public static function create($provider)
    {
        $provider = 'App\\Http\\Providers\\' . $provider;
        if (class_exists($provider))
            return new $provider;

        throw new InvalidArgumentException('Invalid provider');
    }
}
