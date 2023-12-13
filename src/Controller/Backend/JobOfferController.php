<?php

namespace App\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobOfferController extends AbstractController
{
    #[Route('/offre/ajout', name: 'app_backend_job_add')]
    public function index(): Response
    {
        return $this->render('job_offer/index.html.twig');
    }
}
