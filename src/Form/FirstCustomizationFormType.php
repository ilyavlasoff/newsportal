<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class FirstCustomizationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextareaType::class, [
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 512,
                        'maxMessage' => "Description length can not be more {{ limit }} symbols"
                    ])
                ]
            ])
            ->add('userPic', FileType::class, [
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => "File is too big. Allowed maximum {{ limit }} ",
                        'mimeTypes' => ['image/jpg', 'image/png'],
                        'mimeTypesMessage' => "File {{ name }} has type {{ type }}. Allowed types: {{ types }}"
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection'=>false
        ]);
    }
}