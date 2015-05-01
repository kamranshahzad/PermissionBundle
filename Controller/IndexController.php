<?php

namespace Cogilent\PermissionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Cogilent\PermissionBundle\Form\Type\RolePermissionType;
use Cogilent\PermissionBundle\Entity\UriAccess;


/**
 * Permission controller
 */
class IndexController extends Controller
{
    /**
     * @Route("/permissions", name="permission_index")
     * @Template()
     */
    public function indexAction(Request $request){



        $form = $this->createForm(new RolePermissionType());

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);

            if ($form->isValid()) {
                echo "Data Updated successfully";
            }

        }

        return array(
            'form'   => $form->createView()
        );


        /*$user_permissions = array(
            'create' => 'Create Users',
            'update' => 'Modify Users',
            'remove' => 'Remove Users'
        );*/

    }

    /**
     * @Route("/role/{id}/permissions", name="permission_role_view")
     * @Template()
     */
    public function viewAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager();
        $ace = $em->getRepository('CogilentPermissionBundle:RolePermissions')->find($id);

        $form = $this->createForm(new RolePermissionType($ace->getList()));

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);
            if ($form->isValid()) {



                $ace->setList($form->getData());
                $em->persist($ace);
                $em->flush();

               /*echo('<pre>');
                print_r($form->getData());
                echo('</pre>');*/

                echo "Data Updated successfully";
            }

        }

        return array(
            'form'   => $form->createView(),
            'id' => $id
        );

    }

}//@