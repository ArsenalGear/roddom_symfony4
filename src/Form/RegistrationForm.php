<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationForm extends AbstractType
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
            ->add('phone', TextType::class, [
                'label'  => 'Телефон',
            ])
            ->add('sms_code', TextType::class, [
                'label'  => 'Код из смс',
            ])
            ->add('email', EmailType::class, [
                'label'  => 'E-mail',
            ])
            ->add('password', PasswordType::class, [
                'label'  => 'Пароль',
            ])
            ->add('repeat_password', PasswordType::class, [
                'label'  => 'Повторите пароль',
            ])
            ->add('agree_terms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'dasdasda'
            ])
        ;
    }
}