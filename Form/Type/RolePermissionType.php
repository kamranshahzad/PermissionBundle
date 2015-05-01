<?php

namespace Cogilent\PermissionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\Extension\Core\View\ChoiceView;

use Cogilent\PermissionBundle\Form\DataTransformer\AccessOptionsTransformer;


class RolePermissionType extends AbstractType
{

    private $aceString;

    public function __construct($_aceString){
        $this->aceString = $_aceString;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $aclOptionsArray = array(
            'users' => array(
                'full' => 'Full Access',
                'read' => 'View Users',
                'write' => 'Create new users',
                'modify' => 'Modify current users',
                'remove' => 'Remove current users'
            ),
            'contacts' => array(
                'full' => 'Full Access',
                'read' => 'View contact',
                'write' => 'Create new contact',
                'modify' => 'Modify current contact',
                'remove' => 'Remove current contact'
            )
        );

        //$transformer = new AccessOptionsTransformer( $options );

        foreach($aclOptionsArray as $bundle => $permissions){
            //$defaultOptions = array( 'multiple'=>true , 'expanded'=>true , 'choice_list' => new SimpleChoiceList($permissions));
            //$defaultOptions = array( 'field_id' => $bundle , 'choices' => $permissions );
            //$builder->add( $bundle , 'acloptions' , $defaultOptions );
            /*$builder->add(
                $builder->create( $bundle ,'choice' , $defaultOptions )->addModelTransformer($transformer)
            );*/

            $defaultOptions = array( 'multiple'=>true , 'expanded'=>true , 'choices'=>$permissions);
            $builder->add( $bundle , 'choice' , $defaultOptions);

        }

        $transformer = new AccessOptionsTransformer( $this->aceString );
        $builder->addModelTransformer($transformer);

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver){
        $resolver->setDefaults(array(
            //'data_class' => 'Kamran\LinkBundle\Entity\GeneralLinks',
        ));
    }

    public function getName()
    {
        return 'rolepermissions';
    }

}



