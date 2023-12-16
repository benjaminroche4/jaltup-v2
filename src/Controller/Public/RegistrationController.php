<?php

namespace App\Controller\Public;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Interface\EmailInterface;
use App\Interface\RoleInterface;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Uid\Factory\UuidFactory;

class RegistrationController extends AbstractController
{
    public function __construct(
        private readonly UuidFactory $uuidFactory,
    ) {
    }

    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher,
                             EntityManagerInterface $entityManager, UserAuthenticatorInterface $authenticator,
                             LoginFormAuthenticator $loginFormAuthenticator, MailerInterface $mailer,
                             LoggerInterface $logger): Response
    {
        if ($this->getUser()) {
            /** TODO: redirect to app_dashboard */
            return $this->redirectToRoute('app_soon');
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEmail(filter_var($form->get('email')->getData(), FILTER_VALIDATE_EMAIL));
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            //when user register, he is ROLE_USER_INCOMPLETE
            $user->setRoles([RoleInterface::ROLE_USER_INCOMPLETE]);
            $user->setUuid($this->uuidFactory->create());
            $user->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($user);
            $entityManager->flush();

            $this->sendEmailToAdmin($user, $mailer, $logger);

            //conect user after registration
            $authenticator->authenticateUser($user, $loginFormAuthenticator, $request);

            return $this->redirectToRoute('app_soon');
        }

        return $this->render('public/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    private function sendEmailToAdmin(User $user, MailerInterface $mailer, LoggerInterface $logger): void
    {
        $emailRegister = (new TemplatedEmail())
            ->from($user->getEmail())
            ->to(new Address(EmailInterface::CONTACT_ADMIN_EMAIL))
            ->subject('[Site internet] Inscription d\'un nouvel utilisateur')
            ->htmlTemplate('emails/admin/new_user.html.twig')
            ->context([
                'createdAt' => new \DateTimeImmutable(),
                'emailRegister' => $user->getEmail(),
            ]);

        try {
            $mailer->send($emailRegister);
        } catch (TransportExceptionInterface $e) {
            $logger->error('(Register) Error when the email hast been send :'. $e->getMessage());
        }
    }
}
