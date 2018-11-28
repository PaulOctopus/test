<?php
namespace App\Service;

use App\Repository\UserFieldValueRepository;
use App\Repository\UserRepository;

class UserManager
{
    /**
     * @var UserFieldValueRepository
     */
    private $valueRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserFieldValueRepository $valueRepository, UserRepository $userRepository)
    {
        $this->valueRepository = $valueRepository;
        $this->userRepository = $userRepository;
    }

    public function getUsersByBirthdayRange($dayFrom, $dayTo, $page = 1, $elementNumber = 20)
    {
        $userIdList = $this->valueRepository->getUserIdListByBirthdayRange($dayFrom, $dayTo);
        $users = $this->userRepository->findBy([
            'id' => array_values($userIdList)
        ], [], $page*$elementNumber, ($page-1)*$elementNumber);
        return $users;
    }
}