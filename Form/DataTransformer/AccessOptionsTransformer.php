<?php

namespace Cogilent\PermissionBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;




class AccessOptionsTransformer implements DataTransformerInterface
{

    private $aceString;

    public function __construct($_aceString){
        $this->aceString = $_aceString;
    }

    //PersistentCollection
    public function transform($object)
    {

        $aceArray = array();

        if('' != $this->aceString ){
            $aceArray = json_decode($this->aceString , true);
        }

        if(count($aceArray) > 0){
            return $aceArray;
        }


        //$objects ---> array
        //echo(gettype($objects));

        /*echo('<pre>');
        print_r($aceArray);
        echo('</pre>');*/
/*
        $array = array();
        $array['users'][] = 'full';
        $array['users'][] = 'read';
        $array['users'][] = 'remove';
        $array['contacts'][1] = 'write';

        return $array;*/




        //$array = array('full'=>true, 'create'=>1);

        //return $array;

        //echo(gettype($objects));

        /*if ($objects === null) {
            return '';
        }

        $checkedOptions = array();
        $booleanOptions  = array();

        foreach($objects->toArray() as $object){
            $checkedOptions[] = $object->getId();
        }

        if($checkedOptions){
            if($this->list_type == 'checkbox'){
                foreach($this->choice_list as $groupOptions){
                    $groupId = $groupOptions['group']['id'];
                    $options = $groupOptions['options'];
                    $booleanOptions[$groupId] = array();
                    foreach($options as $id=>$label){
                        $booleanOptions[$groupId][] = in_array($id,$checkedOptions) ? $id : '';
                    }
                }
            }else{

            }
        }

        return $booleanOptions;*/
    }

    // $values Array
    public function reverseTransform($arrayValues)
    {

        //return $arrayValues;

        $filterArray = array();
        foreach($arrayValues as $bundle => $list){
            $filterArray[$bundle] = array_values($list);
        }

        return json_encode($filterArray);

        /*
        echo('<pre>');
        print_r($arrayValues);
        echo('</pre>');
        */



        //echo(gettype($values));
        /*if (!is_array($values)) {
            throw new UnexpectedTypeException($values, 'array');
        }
        $collection = new ArrayCollection();

        if($this->list_type == 'checkbox'){
            foreach($values as $groupid => $options){
                foreach($options as $index => $fieldId){
                    $collection->add($this->em->getRepository($this->entity_class)->find($fieldId));
                }
            }
        }else{
            foreach($values as $groupId => $fieldId){
                $collection->add($this->em->getRepository($this->entity_class)->find($fieldId));
            }
        }

        return $collection;*/
    }

}