<?php

namespace App\Http\Enums;

class ProviderEnum
{
    public static function statusKey($provider): string
    {
        return match ($provider) {
            'DataProviderX' => 'statusCode',
            'DataProviderY' => 'status',
        };
    }

    public static function statusValue($provider): array
    {
        return match ($provider) {
            'DataProviderX' => [
                'authorised' => 1, 'decline' => 2, 'refunded' => 3,
            ],
            'DataProviderY' => [
                'authorised' => 100, 'decline' => 200, 'refunded' => 300,
            ]
        };
    }

    public static function currencyKey($provider): string
    {
        return match ($provider) {
            'DataProviderX' => 'Currency',
            'DataProviderY' => 'currency'
        };
    }

    public static function balanceKey($provider): string
    {
        return match ($provider) {
            'DataProviderX' => 'parentAmount',
            'DataProviderY' => 'balance'
        };
    }

}



