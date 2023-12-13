<?php

namespace App\Controller\Backend;

use App\Interface\RoleInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[isGranted(RoleInterface::ROLE_ADMIN)]
class DashboardController extends AbstractController
{
    #[Route('/backend/dashboard', name: 'app_backend_dashboard')]
    public function backendDashboard(): Response
    {
        return $this->render('backend/dashboard.html.twig');
    }
}
