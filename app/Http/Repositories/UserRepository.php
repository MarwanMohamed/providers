<?php

namespace App\Http\Repositories;

use App\Http\Factories\DataProviderFactory;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    private DataProviderFactory $dataProviderFactory;

    public function __construct(DataProviderFactory $dataProviderFactory)
    {
        $this->dataProviderFactory = $dataProviderFactory;
    }

    public function getUsers($request)
    {
        $users = [];

        $provider = $request->get('provider');

        if ($provider) {
            $dataProvider = $this->dataProviderFactory->create($provider);
            $users = $dataProvider->getUsers($request);
        } else {
            $providersFiles = Storage::files('DataProviders');
            foreach ($providersFiles as $providersFile) {
                $dataProvider = $this->dataProviderFactory->create(pathinfo(basename($providersFile), PATHINFO_FILENAME));
                $users = array_merge($users, $dataProvider->getUsers($request));
            }
        }

        return $users;
    }
}
