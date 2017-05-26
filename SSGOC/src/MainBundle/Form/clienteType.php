<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class clienteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('rFCCte', TextType::class ,array('label' => 'RFC del cliente'))
        ->add('codCte', TextType::class ,array('label' => 'Codigo '))
        ->add('nomCte', TextType::class ,array('label' => 'Nombre '))
        ->add('razSoc', TextType::class ,array('label' => 'Razón Social'))
        ->add('dirCte', TextType::class ,array('label' => 'Dirección'))
        ->add('telCte', TextType::class ,array('label' => 'Telefóno'))
        ->add('codPostCte', TextType::class ,array('label' => 'Codigo Postal'))        
        ->add('submit', SubmitType::class , array(
            'label' => 'Guardar',
            'attr'  => array('class' => 'btn z-depth-4')
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\cliente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_cliente';
    }


}
