<?php

namespace CentraleLille\SearchBundle\Form;

use Symfony\Component\Form\AbstractType;
use CentraleLille\SearchBundle\Model\SearchUser;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class SearchUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             
            ->add('username')
            
            ->add('search','submit')
           
           
            


        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            // avoid to pass the csrf token in the url (but it's not protected anymore)
            'csrf_protection' => false,
            'data_class' => 'CentraleLille\SearchBundle\Model\SearchUser'
        ));
    }

    public function getName()
    {
        return 'user_search_type';
    }
}
