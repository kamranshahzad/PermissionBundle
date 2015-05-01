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


class AccessOptionsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        foreach($options['choice_list'] as $bundle => $permissions){
            foreach($permissions as $role => $options){
                $builder->add( $role.'_'.$bundle  ,'acloptions' , array('choice_list' => $options) );
            }
        }




        /*foreach($options['choice_list'] as $role => $permissions){
            foreach($permissions as $bundle => $options){
                $builder->add( $role.'_'.$bundle  ,'acloptions' , array('choice_list' => $options) );
            }
        }*/



        //foreach($options['choice_list'] as $category => $groupsArray){
            //echo($category);
            //$defaultOptions = array('multiple'=>true,'expanded'=>true , 'choice_list' => new SimpleChoiceList($groupsArray));
            //$builder->add( $category  ,'choice' , $defaultOptions );
            /*foreach($groupsArray as $mask){
                $builder->add( $groupsArray['group']['id'],'choice',$defaultOptions);
            }*/
        //}


        /*
        foreach($options['choice_list'] as $groupsArray){
            $listType = ($options['list_type'] == 'checkbox') ? array('multiple'=>true) : array();
            $defaultOptions = array_merge($listType , array('label'=>$groupsArray['group']['title'],'choice_list' => new SimpleChoiceList($groupsArray['options']) , 'expanded'=>true));
            $builder->add($groupsArray['group']['id'],'choice',$defaultOptions);
        }


        $transformer = new GroupChoiceListTransformer( $this->em , $options );
        $builder->addViewTransformer($transformer);
        */

        $transformer = new AccessOptionsTransformer( $options );
        $builder->addViewTransformer($transformer);

    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        foreach($options['choice_list'] as $bundle => $permissions){

        }
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {

        //echo gettype($view->vars);

        // Translate Choice labels
        if (!empty($view->vars['choices'])) {
            echo('<pre>');
            print_r($view->vars['choices']);
            echo('<pre>');
            foreach ($view->vars['choices'] as $key => $choiceView) {

                //echo $choiceView->value;
                //echo $choiceView->label;
                $view->vars['choices']['label'] = $choiceView;
            }
        }



    }



    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choice_list' => array(),
            'list_type'=> 'checkbox'
        ));
        $resolver->setRequired(array('choice_list'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'accessoptions';
    }

}
