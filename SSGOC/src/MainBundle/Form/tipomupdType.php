<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class tipomupdType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
       
        ->add('nomTipo',  TextType::class ,array('label' => 'Nombre del Material')) 
        ->add('submit', SubmitType::class , array(
                    'label' => 'Guardar',
                    'attr'  => array('class' => 'btn z-depth-4')
                )) 
         ->add('idTipoM',  TextType::class ,array(
            'label' => '.',
            'attr'  => array('style' => 'visibility:hidden')
            ))    
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\tipom'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_tipom';
    }


}
