<?php
/**
 * ActivityForm.php File Doc
 *
 * Formulaire de filtrage d'actualités
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:NewsfeedBundle
 * @subpackage Form
 * @author     Hyot James <james.hyot@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\Form;

use CentraleLille\NewsFeedBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

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
 * @author     Hyot James <james.hyot@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class FilterType extends AbstractType
{

    private $thematics = array();


    /**
     * Fonction construct du form FilterType
     *
     * @param Category $thematics données concernant les thématiques venant sur service FablabCategories
     *
     * @return void
     */
    public function __construct($thematics)
    {
        $this->thematics = $thematics;
    }

    /**
     * Formulaire de filtrage d'Actualités du newsfeed
     *
     * @param FormBuilderInterface $builder FormBuilder
     * @param Array                $options Options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'creation',
                CheckboxType::class,
                array(
                    'label'    => 'Création',
                    'required' => false,
                )
            )
            ->add(
                'update',
                CheckboxType::class,
                array(
                    'label'    => 'Mise à jour',
                    'required' => false,
                )
            );
        for ($i = 0; $i < count($this->thematics); $i++) {
            $builder
                ->add(
                    $this->thematics[$i]->getId(),
                    CheckboxType::class,
                    array(
                        'label' => $this->thematics[$i]->getName(),
                        'required' => false,
                    )
                ); //adding thematics one by one to builder
        }

        $builder
            ->add(
                'dateMin',
                DateType::class,
                array(
                    'input'  => 'datetime',
                    'widget' => 'choice',
                    'label' => 'Entre le ...',
                    'data' => new \DateTime('2016-01-01')
                )
            )
            ->add(
                'dateMax',
                DateType::class,
                array(
                    'input'  => 'datetime',
                    'widget' => 'choice',
                    'label' => 'Et le ...',
                    'data' => new \DateTime()
                )
            );


    }
}
