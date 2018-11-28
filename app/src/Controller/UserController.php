<?php
namespace App\Controller;

use App\Service\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    private const CAPRICORN = [357, 20];

    public function showCapricornUsers($page, UserManager $manager)
    {
        $users = $manager->getUsersByBirthdayRange(self::CAPRICORN[0],self::CAPRICORN[1],$page);
        return $this->render('user/list.html.twig',[
            'users' => $users
        ]);
    }
}