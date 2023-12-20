<?php

namespace App\Form;

use App\Entity\School;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SchoolFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('schoolName', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir le nom de l\'école.',
                    ]),
                    new Assert\Length([
                        'min' => 2,
                        'minMessage' => 'Le nom de l\'école doit contenir au moins {{ limit }} caractères.',
                        'max' => 60,
                        'maxMessage' => 'Le nom de l\'école doit contenir au maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('location', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir la ville de l\'école.',
                    ]),
                    new Assert\Length([
                        'min' => 2,
                        'minMessage' => 'La ville de l\'école doit contenir au moins {{ limit }} caractères.',
                        'max' => 60,
                        'maxMessage' => 'La ville de l\'école doit contenir au maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('contactName', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir le nom du contact de l\'école .',
                    ]),
                    new Assert\Length([
                        'min' => 2,
                        'minMessage' => 'Le nom du contact de l\'école doit contenir au moins {{ limit }} caractères.',
                        'max' => 60,
                        'maxMessage' => 'Le nom du contact de l\'école doit contenir au maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('contactNumber', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir le numéro un téléphone.',
                    ]),
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
            ->add('contactEmail', EmailType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez saisir l\'adresse email du contact de l\'école .',
                    ]),
                    new Assert\Email([
                        'message' => 'Veuillez saisir une adresse email valide.',
                    ]),
                ],
            ])
            ->add('contactMessage', TextareaType::class, [
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'min' => 10,
                        'minMessage' => 'Le message doit contenir au moins {{ limit }} caractères.',
                        'max' => 1000,
                        'maxMessage' => 'Le message doit contenir au maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => School::class,
        ]);
    }
}
