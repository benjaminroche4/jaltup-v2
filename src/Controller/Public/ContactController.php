<?php

namespace App\Controller\Public;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Interface\EmailInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer, LoggerInterface $logger): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //hydrate l'objet contact avec les données du formulaire
            $contact->setFullName($form->get('fullName')->getData());
            $contact->setEmail(filter_var($form->get('email')->getData(), FILTER_VALIDATE_EMAIL));
            $contact->setPhoneNumber($form->get('phoneNumber')->getData());
            $contact->setSociety($form->get('society')->getData());
            $contact->setMessage($form->get('message')->getData());
            $contact->setSubject($form->get('subject')->getData());
            $contact->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('successContact', 'Votre message a bien été envoyé ! Nous vous répondrons dans les meilleurs délais.');

            $this->sendContactEmail($contact, $mailer, $logger);

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('public/contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }

    private function sendContactEmail(Contact $contact, MailerInterface $mailer, LoggerInterface $logger): void
    {
        $emailContact = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to(new Address(EmailInterface::CONTACT_ADMIN_EMAIL))
            ->subject('[Site internet] Demande de contact')
            ->htmlTemplate('emails/admin/contact.html.twig')
            ->context([
                'createdAt' => new \DateTimeImmutable(),
                'fullName' => $contact->getFullName(),
                'emailContact' => $contact->getEmail(),
                'phoneNumber' => $contact->getPhoneNumber(),
                'society' => $contact->getSociety(),
                'subject' => $contact->getSubject(),
                'message' => $contact->getMessage(),
            ]);

        try {
            $mailer->send($emailContact);
        } catch (TransportExceptionInterface $e) {
            $logger->error('(Contact) Error when the email hast been send :'. $e->getMessage());
        }
    }
}
