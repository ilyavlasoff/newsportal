<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AddArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'Title',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Title can not be empty'
                    ])
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('content', TextareaType::class, [
                'required' => true,
                'label' => 'Content',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Article content can not be empty'
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Add article'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => Article::class
        ]);
    }
}
