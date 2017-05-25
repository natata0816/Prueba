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

class usuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('correo',EmailType::class, array('label' => 'Correo'))
        ->add('nomUsr',TextType::class ,array('label' => 'Nombre completo'))
        ->add('pwd', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Contraseña'),'required' => false,
                'second_options' => array('label' => 'Repite la Contraseña'),'required' => false,
                ))
        ->add('tipoUsr',ChoiceType::class, array('label' => 'Rol del usuario', 'choices' => array('Operador' => 0, 'Administrador'=> 1, 'Herramentales'=>2, 'Calidad'=>3, 'Diseño'=>4), 'placeholder'=>'Selecciona su Rol'))
        ->add('activo',ChoiceType::class, array('label' => 'Estatus', 'choices' => array('Inactivo'=>0, 'Activo'=> 1), 'placeholder'=>'Selecciona su Estatus'))   
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
            'data_class' => 'MainBundle\Entity\usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mainbundle_usuario';
    }


}
