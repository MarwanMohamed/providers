<?php

namespace App\Http\Providers;


use Illuminate\Http\Request;

interface DataProviderInterface
{
    public function getUsers(Request $request);
}
