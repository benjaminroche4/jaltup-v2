<?php

namespace App\Form;

use App\Entity\Company;
use App\Interface\CompanyInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;


class CompanyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email valide.',
                    ]),
                    new Assert\Email([
                        'message' => 'Veuillez entrer une adresse email valide.',
                    ]),
                ],
            ])
            ->add('password')
            ->add('name', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer votre nom d\'entreprise.',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 60,
                        'minMessage' => 'Minimum {{ limit }} caractères.',
                        'maxMessage' => 'Maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('logoUrl', FileType::class, [
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez entrer un fichier d\'image valide (PNG/JPEG/JPG.',
                    ]),
                ],
            ])
            ->add('uuid')
            ->add('employeeCountRange', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer une fourchette d\'employés.',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 60,
                        'minMessage' => 'Minimum {{ limit }} caractères.',
                        'maxMessage' => 'Maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'En attente' => [CompanyInterface::COMPANY_WAITING],
                    'Validé' => [CompanyInterface::COMPANY_VALIDATE],
                ],
            ])
            ->add('createdAt')
            ->add('bio', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 20,
                        'max' => 255,
                        'minMessage' => 'Minimum {{ limit }} caractères.',
                        'maxMessage' => 'Maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('phoneNumber', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer un numéro de téléphone.',
                    ]),
                    new Length([
                        'min' => 10,
                        'max' => 10,
                        'minMessage' => 'Minimum {{ limit }} caractères.',
                        'maxMessage' => 'Maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('websiteUrl', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Url([
                        'message' => 'Veuillez entrer une URL valide.',
                    ]),
                ],
            ])
            ->add('slug', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer un slug.',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 60,
                        'minMessage' => 'Minimum {{ limit }} caractères.',
                        'maxMessage' => 'Maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
