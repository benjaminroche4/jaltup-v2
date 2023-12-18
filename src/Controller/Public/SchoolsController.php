<?php

namespace App\Controller\Public;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SchoolsController extends AbstractController
{
    #[Route('/ecoles', name: 'app_schools')]
    public function schools(): Response
    {
        return $this->render('public/schools/index.html.twig');
    }
}
