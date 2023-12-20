<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer votre nom complet.',
                    ]),
                    new Length([
                        'min' => 3,
                        'max' => 60,
                        'minMessage' => 'Votre nom et prénom doit faire au minimum {{ limit }} caractères.',
                        'maxMessage' => 'Votre nom et prénom doit faire au maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email.',
                    ]),
                    new Assert\Email([
                        'message' => 'Veuillez entrer une adresse email valide.',
                    ]),
                ],
            ])
            ->add('phoneNumber', TelType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^\d+$/',
                        'message' => 'Le numéro de téléphone doit contenir uniquement des chiffres.',
                    ]),
                    new Assert\Length([
                        'min' => 10,
                        'max' => 10,
                        'exactMessage' => 'Le numéro de téléphone doit comporter {{ limit }} numéros.',
                    ]),
                ],
            ])
            ->add('society', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 60,
                        'minMessage' => 'Votre société doit faire au minimum {{ limit }} caractères.',
                        'maxMessage' => 'Votre société doit faire au minimum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('subject', ChoiceType::class, [
                'choices'  => [
                    'Étudiant' => [
                        'Problème de création de compte' => 'Étudiant - Problème de création de compte',
                        'Inscrire mon CFA' => 'Étudiant - Inscrire mon CFA',
                        'Trouver ma formation' => 'Étudiant - Trouver ma formation',
                        'Payer ma formation' => 'Étudiant - Payer ma formation',
                    ],
                    'Entreprise' => [
                        'Inscrire mon entreprise' => 'Entreprise - Inscrire mon entreprise',
                        'Problème création de compte' => 'Entreprise- Problème création de compte',
                        'Problème création annonce' => 'Entreprise - Problème création annonce',
                        'Me faire rappeler' => 'Entreprise - Me faire rappeler',
                    ],

                ],
                'placeholder' => '',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez choisir un sujet.',
                    ]),
                ],
            ])
            ->add('message', TextareaType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer un message.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre message doit faire au minimum {{ limit }} caractères.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
