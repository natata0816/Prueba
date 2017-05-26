<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class tratamientoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                
                ->add('nomTrat', TextType::class ,array('label' => 'Nombre del tratamiento')) 
                ->add('submit', SubmitType::class , array(
                    'label' => 'Guardar',
                    'attr'  => array('class' => 'btn z-depth-4')
                )) 
                ->add('idTrat',  TextType::class ,array(
                    'label' => '.',
                    'attr'  => array('style' => 'visibility:hidden', 'value' => 'burbujabeagle')
                    ))      
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\tratamiento'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_tratamiento';
    }


}
