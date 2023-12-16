<?php

namespace App\Controller\User;

use App\Interface\RoleInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[isGranted(RoleInterface::ROLE_USER_INCOMPLETE)]
class UserDashboardController extends AbstractController
{
    #[Route('/bientot', name: 'app_soon')]
    public function soon(): Response
    {
        return $this->render('user/user_dashboard/soon.html.twig');
    }
}
