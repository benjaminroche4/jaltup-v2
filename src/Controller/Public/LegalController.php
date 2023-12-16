<?php

namespace App\Controller\Public;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    #[Route('/mentions-legales', name: 'app_legal_mention')]
    public function legalMention(): Response
    {
        return $this->render('public/legal/legal_mention.html.twig');
    }

    #[Route('/donnees-personnelles', name: 'app_personal_data')]
    public function personnalData(): Response
    {
        return $this->render('public/legal/personal_data.html.twig');
    }
}
