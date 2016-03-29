<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CentraleLille\CustomFosUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectFormType extends AbstractType
{
    protected $edit;

    public function __construct($edit)
    {
        $this->edit=$edit;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array("label" => "Nom"))
            ->add('dateBegin', 'date', array("label" => "Date de début"))
            ->add('dateEnd', 'date', array("label" => "Date de fin"))
            ->add('picture', 'text', array("label" => "Image"))
            ->add('summary', 'textarea', array("label" => "Résumé"))
            ->add('description', 'textarea', array("label" => "Description"));
        if ($this->edit == 'create') {
            $builder
                ->add('save', 'submit', array('label' => 'Créer projet'));
        } elseif ($this->edit == 'edit') {
            $builder
                ->add('save', 'submit', array('label' => 'Editer projet'));
        }
    }

    public function getName()
    {
        return 'fos_user_project';
    }
}
