<?php

namespace App\Controller\Public;

use App\Entity\School;
use App\Entity\User;
use App\Form\SchoolFormType;
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

class SchoolsController extends AbstractController
{
    #[Route('/ecoles/contact', name: 'app_schools_contact')]
    public function schools(
        Request $request,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer,
        LoggerInterface $logger
    ): Response {

        $contactSchool = new School();
        $form = $this->createForm(SchoolFormType::class, $contactSchool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactSchool->setSchoolName($form->get('schoolName')->getData());
            $contactSchool->setLocation($form->get('location')->getData());
            $contactSchool->setContactName($form->get('contactName')->getData());
            $contactSchool->setContactEmail(filter_var($form->get('contactEmail')->getData(), FILTER_VALIDATE_EMAIL));
            $contactSchool->setContactMessage($form->get('contactMessage')->getData());
            $contactSchool->setContactNumber($form->get('contactNumber')->getData());
            $contactSchool->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($contactSchool);
            $entityManager->flush();

            $this->sendEmailToAdmin($contactSchool, $mailer, $logger);

            $this->addFlash('successContactSchool', 'Votre message a bien été envoyé ! Nous vous répondrons dans les 
            meilleurs délais.');
            return $this->redirectToRoute('app_schools_contact');
        }

            return $this->render('public/schools/profile_first_step.html.twig', [
            'contactSchool' => $form->createView(),]);
    }

    private function sendEmailToAdmin(School $contactSchool, MailerInterface $mailer, LoggerInterface $logger): void
    {
        $emailRegister = (new TemplatedEmail())
            ->from($contactSchool->getContactEmail())
            ->to(new Address(EmailInterface::CONTACT_ADMIN_EMAIL))
            ->subject('[Site internet] Demande de contact d\'une école')
            ->htmlTemplate('emails/admin/contact_school.html.twig')
            ->context([
                'schoolName' => $contactSchool->getSchoolName(),
                'location' => $contactSchool->getLocation(),
                'contactName' => $contactSchool->getContactName(),
                'contactEmail' => $contactSchool->getContactEmail(),
                'contactNumber' => $contactSchool->getContactNumber(),
                'contactMessage' => $contactSchool->getContactMessage(),
                'createdAt' => new \DateTimeImmutable(),
            ]);

        try {
            $mailer->send($emailRegister);
        } catch (TransportExceptionInterface $e) {
            $logger->error('(Register) Error when the email has been send :'. $e->getMessage());
        }
    }
}
