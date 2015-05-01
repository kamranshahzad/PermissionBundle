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

use Cogilent\PermissionBundle\Form\DataTransformer\AccessOptionsTransformer;



class AclOptionsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //print_r($options);



        $defaultOptions = array('multiple'=>true,'expanded'=>true ,'choices' => $options['choices'] );
        $builder->add( $options['field_id'] ,'choice' , $defaultOptions );

        /*foreach($options['choices']  as $key => $label){
            $fieldId = $options['field_id'].'_'.$key;
            $builder->add( $fieldId , 'checkbox', array(
                'label'     => $label,
                'required'  => false,
            ));
        }*/

        $transformer = new AccessOptionsTransformer( $options );
        $builder->addViewTransformer($transformer);

    }


    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choice_list' => array(),
            'choices' => array(),
            'field_id' => ''
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
