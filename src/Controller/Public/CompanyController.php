<?php

namespace App\Controller\Public;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    #[Route('/entreprises', name: 'app_companies')]
    public function companies(): Response
    {
        return $this->render('public/company/companies.html.twig');
    }

    #[Route('/fonctionnement', name: 'app_functioning')]
    public function functioning(): Response
    {
        return $this->render('public/company/functioning.html.twig');
    }
}
