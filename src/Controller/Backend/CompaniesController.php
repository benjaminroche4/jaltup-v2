<?php

namespace App\Controller\Backend;

use App\Entity\Company;
use App\Form\CompanyFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompaniesController extends AbstractController
{
    #[Route('/backend/entreprises', name: 'app_backend_companies')]
    public function companiesList(): Response
    {
        return $this->render('backend/companies/companies_list.html.twig');
    }

    #[Route('/backend/entreprise/ajout', name: 'app_backend_company_add')]
    public function companyAdd(Request $request): Response
    {
        $contact = new Company();
        $form = $this->createForm(CompanyFormType::class);
        $form->handleRequest($request);

        return $this->render('backend/companies/company_add.html.twig', [
            'companyForm' => $form->createView(),
        ]);
    }
}
