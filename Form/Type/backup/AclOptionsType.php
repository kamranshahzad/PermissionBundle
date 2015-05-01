<?php

namespace Cogilent\PermissionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\Extension\Core\View\ChoiceView;

//use Cogilent\PermissionBundle\Form\DataTransformer\AccessOptionsTransformer;



class AclOptionsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $inputArray = array(
            'create' => 'Create',
            'update' => 'Update',
            'remove' => 'Remove',
            'view'   => 'View'
        );

        $builder->add('master', 'checkbox', array(
            'label'     => 'Full access',
            'required'  => false,
        ));

        $defaultOptions = array('multiple'=>true,'expanded'=>true ,'choice_list' => new SimpleChoiceList($inputArray));
        $builder->add( 'user' ,'choice' , $defaultOptions );

        /*$transformer = new AccessOptionsTransformer( $options );
        $builder->addViewTransformer($transformer)*/;

    }


    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choice_list' => array(),
            'list_type'=> 'checkbox',
            'master' => ''
        ));
        $resolver->setRequired(array('choice_list'));
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'acloptions';
    }

}
