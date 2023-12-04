<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //hydrate l'objet contact avec les données du formulaire
            $contact->setFullName($form->get('fullName')->getData());
            $contact->setEmail($form->get('email')->getData());
            $contact->setPhoneNumber($form->get('phoneNumber')->getData());
            $contact->setSociety($form->get('society')->getData());
            $contact->setMessage($form->get('message')->getData());
            $contact->setSubject($form->get('subject')->getData());
            $contact->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé ! Nous vous répondrons dans les meilleurs délais.');

            return $this->redirectToRoute('app_contact');
        }


        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
