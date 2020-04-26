<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeedbackForm extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'  => 'Имя',
            ])
            ->add('email', EmailType::class, [
                'label'  => 'E-mail',
            ])
            ->add('theme', TextType::class, [
                'label'  => 'Тема сообщения',
            ])
            ->add('message', TextareaType::class, [
                'label'  => 'Текст сообщения',
            ])
            ->add('attachment', FileType::class, [
                'label'  => 'Прикрепить',
	            'mapped' =>  false
	            
            ])
        ;
    }
}