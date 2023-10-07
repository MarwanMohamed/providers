<?php

namespace App\Http\Providers;

use App\Http\Enums\ProviderEnum;
use Illuminate\Support\Facades\Storage;

abstract class BaseDataProvider implements DataProviderInterface
{
    protected string $dataProviderFile;

    public function getUsers($request): array
    {
        $data = json_decode(Storage::get($this->dataProviderFile), true)['users'];
        $provider = pathinfo(basename($this->dataProviderFile), PATHINFO_FILENAME);

        return collect($data)
            ->when($request->has('statusCode'), function ($collection) use ($request, $provider) {
                $mappedStatus = ProviderEnum::statusValue($provider)[$request->get('statusCode')] ?? null;
                return $collection->where(ProviderEnum::statusKey($provider), $mappedStatus);
            })
            ->when($request->has('balanceMin'), function ($collection) use ($request, $provider) {
                return $collection->where(ProviderEnum::balanceKey($provider), '>=', $request->get('balanceMin'));

            })
            ->when($request->has('balanceMax'), function ($collection) use ($request, $provider) {
                return $collection->where(ProviderEnum::balanceKey($provider), '<=', $request->get('balanceMax'));
            })
            ->when($request->has('currency'), function ($collection) use ($request, $provider) {
                return $collection->where(ProviderEnum::currencyKey($provider), $request->get('currency'));
            })->all();
    }
}
