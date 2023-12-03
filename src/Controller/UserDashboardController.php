<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserDashboardController extends AbstractController
{
    #[Route('/bientot', name: 'app_soon')]
    #[isGranted('ROLE_USER')]
    public function soon(): Response
    {
        return $this->render('user_dashboard/soon.html.twig');
    }
}
