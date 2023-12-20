<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\IndustryCategory;
use App\Interface\CompanyInterface;
use App\Repository\IndustryCategoryRepository;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
            ->add('legalStructure', ChoiceType::class, [
                'placeholder' => '',
                'choices' => [
                    'SAS' => 'SAS',
                    'SASU' => 'SASU',
                    'SA' => 'SA',
                    'SARL' => 'SARL',
                    'EURL' => 'EURL',
                    'EI' => 'EI',
                    'EIRL' => 'EIRL',
                    'Auto-entrepreneur' => 'Auto-entrepreneur',
                    'Autre' => 'Autre',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer une structure juridique.',
                    ]),
                ],
            ])
            ->add('siret', NumberType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer votre numéro de SIRET.',
                    ]),
                    new Length([
                        'min' => 14,
                        'max' => 14,
                        'exactMessage' => 'Ce champ doit comporter {{ limit }} caractères.',
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
            ->add('employeeCountRange', ChoiceType::class, [
                'placeholder' => '',
                'choices' => [
                    '1 - 10' => '1 - 10',
                    '11 - 50' => '11 - 50',
                    '51 - 100' => '51 - 100',
                    '101 - 500' => '101 - 500',
                    '501 - 999' => '501 - 999',
                    '+1000' => '+1000'
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer une fourchette d\'employés.',
                    ]),
                ],
            ])
            ->add('status', ChoiceType::class, [
                'placeholder' => '',
                'choices' => [
                    'En attente' => CompanyInterface::COMPANY_WAITING,
                    'Non visible' => CompanyInterface::COMPANY_NOT_VISIBLE,
                    'Visible' => CompanyInterface::COMPANY_VALIDATED,
                ],
            ])
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
            ->add('phoneNumber', NumberType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer un numéro de téléphone.',
                    ]),
                    new Length([
                        'min' => 10,
                        'max' => 10,
                        'exactMessage' => 'Ce champ doit comporter {{ limit }} numéros.',
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
            ->add('category', EntityType::class, [
                'placeholder' => '',
                'class' => IndustryCategory::class,
                'query_builder' => function (IndustryCategoryRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.isActive = 1');
                },
            ])
            ->add('addressOne', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer une adresse.',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 120,
                        'minMessage' => 'Minimum {{ limit }} caractères.',
                        'maxMessage' => 'Maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('addressTwo', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 120,
                        'minMessage' => 'Minimum {{ limit }} caractères.',
                        'maxMessage' => 'Maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('postalCode', NumberType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer un code postal.',
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 5,
                        'exactMessage' => 'Ce champ doit comporter {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('city', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer une ville.',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 60,
                        'minMessage' => 'Minimum {{ limit }} caractères.',
                        'maxMessage' => 'Maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('country', ChoiceType::class, [
                'placeholder' => '',
                'choices' => [
                    'France' => 'France',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer un pays.',
                    ]),
                ],
            ])
            ->add('contactFullName', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer un nom de contact.',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 60,
                        'minMessage' => 'Minimum {{ limit }} caractères.',
                        'maxMessage' => 'Maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('contactEmail', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email valide.',
                    ]),
                    new Assert\Email([
                        'message' => 'Veuillez entrer une adresse email valide.',
                    ]),
                ],
            ])
            ->add('contactPhoneNumber', NumberType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer un numéro de téléphone.',
                    ]),
                    new Length([
                        'min' => 10,
                        'max' => 10,
                        'exactMessage' => 'Ce champ doit comporter {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('contactPosition', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez entrer un poste.',
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
