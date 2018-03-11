<?php
namespace AppBundle\Form;

use AppBundle\Entity\Client;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientType extends AbstractType {

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


            ->add('name', TextType::class, array(
                'label' => 'Nombre',
                'required' => true,
                'attr' => array('placeholder'=> 'Nombre', 'class' => 'form-control', 'tabindex' => 1)
            ))

            ->add('lastname', TextType::class, array(
                'label' => 'Apellidos',
                'required' => true,
                'attr' => array('placeholder'=> 'Apellidos', 'class' => 'form-control', 'tabindex' => 2)
            ))

            ->add('dni', TextType::class, array(
                'label' => 'DNI',
                'required' => true,
                'attr' => array('placeholder' => 'DNI', 'class' => 'form-control', 'tabindex' => 3)
            ))

            ->add('dob', 'date', array(
                'label' => 'Fecha de nacimiento',
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
                'data_class' => Client::class,

            )
        );
    }

    public function getName() {
        return 'client_form';
    }

}//class