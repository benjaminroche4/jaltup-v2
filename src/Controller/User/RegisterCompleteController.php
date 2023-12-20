<?php

namespace App\Controller\User;

use App\Interface\RoleInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[isGranted(RoleInterface::ROLE_USER_INCOMPLETE)]
class RegisterCompleteController extends AbstractController
{
    #[Route('/inscription/completer', name: 'app_user_register_complete')]
    public function index(): Response
    {
        return $this->render('user/register_complete/profile_first_step.html.twig');
    }
}
