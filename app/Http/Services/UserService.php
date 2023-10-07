<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(userRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getFilteredUsers($request): array
    {
        return $this->userRepository->getUsers($request);
    }
}
