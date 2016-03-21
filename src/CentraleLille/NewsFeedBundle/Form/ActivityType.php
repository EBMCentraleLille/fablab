<?php
/**
 * ActivityForm.php File Doc
 *
 * Formulaire de création d'une Activité
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:NewsfeedBundle
 * @subpackage Form
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * ActivityForm Class Doc
 *
 * Formulaire de création d'une activité
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:NewsfeedBundle
 * @subpackage Form
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class ActivityType extends AbstractType
{
    /**
     * Formulaire de création de Activity
     *
     * @param FormBuilderInterface $builder FormBuilder
     * @param Array                $options Options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'type',
            ChoiceType::class,
            array(
                'choices' => array(
                    'Création de projet' => 'creation',
                    'Modification de projet' => 'update',
                    'Personnalisée' => 'custom'
                )
            )
        )
            ->add(
                'user',
                EntityType::class,
                array(
                    'class' => 'CustomFosUserBundle:User',
                    'choice_label' => 'firstname',
                )
            )
            ->add(
                'project',
                EntityType::class,
                array(
                    'class' => 'CustomFosUserBundle:Project',
                    'choice_label' => 'name',
                )
            )
            ->add(
                'Content',
                TextareaType::class
            );
    }
}
