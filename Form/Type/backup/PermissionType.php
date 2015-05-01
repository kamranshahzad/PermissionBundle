<?php

namespace Cogilent\PermissionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\Extension\Core\View\ChoiceView;



class PermissionType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $aclOptionsArray = array(
            'users' => array(
                'ROLE_ADMIN' => array('read','write','edit'),
                'ROLE_USER' => array('read','write','edit'),
                'ROLE_PERSON' => array('read','write','edit')
            ),
            'organization' => array(
                'ROLE_ADMIN' => array('read','write','edit'),
                'ROLE_USER' => array('read','write','edit'),
                'ROLE_PERSON' => array('read','write','edit')
            ),
        );


        /*$optionsArray = array(

            'ROLE_ADMIN' => array(
                'users' => array(
                    array('read','write','edit')
                ),
                'organization' => array(
                    array('read','write','edit')
                ),
                'contacts' => array(
                    array('read','write','edit')
                ),
            ),
            'ROLE_USER' => array(
                'users' => array(
                    array('read','write','edit')
                ),
                'organization' => array(
                    array('read','write','edit')
                ),
                'contacts' => array(
                    array('read','write','edit')
                ),
            ),

        );*/

        $builder->add('options','accessoptions',array(
            'label'=>'Role Permissions',
            'choice_list' => $aclOptionsArray ,
        ));


        $transformer = new AccessOptionsTransformer( $options );
        $builder->addViewTransformer($transformer);

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            //'data_class' => 'Kamran\LinkBundle\Entity\GeneralLinks',
        ));
    }

    public function getName()
    {
        return 'permissions_form';
    }

}