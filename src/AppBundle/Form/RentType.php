<?php
namespace AppBundle\Form;

use AppBundle\Entity\Rent;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RentType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder->add('id', TextType::class, array(
            'label' => 'id',
            'required' => false,
            'attr' => array('placeholder' => 'Id','class' => 'form-control input-circle')
        ))
            ->add('id',HiddenType::class)


            ->add('city', null, array(
                'label' => 'Ciudad',
                'required' => true,
                'empty_value' => 'Seleccione una ciudad en la que quiere alquilar el vehículo',
                'attr' => array('placeholder' => 'Seleccione una ciudad en la que quiere alquilar el vehículo', 'class' => 'form-control', 'tabindex' => 3)
            ))

            ->add('dateInit', 'date', array(
                'label' => 'Fecha de inicio',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'required' => true,
                'attr' => array('placeholder' => 'Introduce una fecha',
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyyy')

            ))

            ->add('dateEnd', 'date', array(
                'label' => 'Fecha de fin',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'required' => true,
                'attr' => array('placeholder' => 'Introduce una fecha',
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyyy')

            ))

        ;

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => Rent::class,
            )
        );
    }

    public function getName() {
        return 'rent_form';
    }

}//class