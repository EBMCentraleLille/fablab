<?php

namespace CentraleLille\CustomFosUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword as OldUserPassword;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (class_exists('Symfony\Component\Security\Core\Validator\Constraints\UserPassword')) {
            $constraint = new UserPassword();
        } else {
            // Symfony 2.1 support with the old constraint class
            $constraint = new OldUserPassword();
        }

        parent::buildForm($builder, $options);

        $builder
            ->remove('username')
            ->add('email', null, array('label' => 'Email'))
            ->add('promo', null, array('label' => 'Promotion'))
            ->add('phone', null, array('label' => 'Téléphone'))
            ->add(
                'current_password',
                'password',
                array(
                'label' => 'Mot de passe actuel',
                'translation_domain' => 'FOSUserBundle',
                'mapped' => false,
                'constraints' => $constraint,
                )
            );
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
