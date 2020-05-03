<?php

namespace App\Form;

use App\Entity\AuthorRequests;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Type;

class AuthorRequestsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Field Name can not be empty'
                    ]),
                    new Regex([
                        'pattern' => '/^[A-ZА-Я]{1}[a-zа-я]+/',
                        'message' => 'Name is incorrect'
                    ])
                ]
            ])
            ->add('surname', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Field Surname can not be empty'
                    ]),
                    new Regex([
                        'pattern' => '/^[A-ZА-Я]{1}[a-zа-я]+/',
                        'message' => 'Name is incorrect'
                    ])
                ]
            ])
            ->add('country', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Field Country can not ba empty'
                    ])
                ]
            ])
            ->add('birthday', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'input'  => 'datetime_immutable',
                'constraints' => [
                    new Type([
                        'type' => 'DateTimeInterface',
                        'message' => "Date has not valid type {{ value }} not {{ type }}"
                    ])
                ]
            ])
            ->add('language', TextType::class, [
                'required' => false
            ])
            ->add('email', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Field E-mail can not be empty'
                    ]),
                    new Email([
                        'message' => 'This is not a valid e-mail'
                    ])
                ]
            ])
            ->add('phone', TextType::class, [
                'required' =>true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Field Phone can not be empty'
                    ]),
                    new Regex([
                        'pattern' => '/\+?([0-9]{2})-?([0-9]{3})-?([0-9]{6,7})/',
                        'message' => 'This is not a valid phone number'
                    ])
                ]
            ])
            ->add('edu', TextType::class, [
                'required' => false
            ])
            ->add('categories', TextType::class, [
                'required' => false
            ])
            ->add('bio', TextareaType::class, [
                'required' => false
            ])
            ->add('previousWorks', TextareaType::class, [
                'required' => false
            ])
            ->add('other', TextareaType::class, [
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AuthorRequests::class
        ]);
    }
}