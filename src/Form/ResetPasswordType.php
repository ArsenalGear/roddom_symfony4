<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
	        ->add('oldPassword', PasswordType::class, array(
		        'mapped' => false,
		        'label' => 'Старый пароль'
	        ))
	        ->add('plainPassword', RepeatedType::class, array(
		        'type' => PasswordType::class,
		        'invalid_message' => 'Пароли не совпадают',
		        'first_options'  => ['label' => 'Новый пароль'],
		        'second_options' => ['label' => 'Подтвердите пароль'],
		        'options' => array(
			        'attr' => array(
				        'class' => 'password-field'
			        )
		        ),
		        'required' => true,
	        ))
	        ->add('submit', SubmitType::class, array(
		        'label' => 'Изменить пароль',
		        'attr' => array(
			        'class' => 'btn btn-primary btn-block'
		        )
	        ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
