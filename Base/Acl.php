<?php

namespace Kamran\PermissionBundle\Base;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\SecurityContext;


class Acl{

    private $_container;
    private $_context;

    public function __construct( ContainerInterface $_container , SecurityContext $context ){
        $this->_container = $_container;
        $this->_context = $context;
    }

    public function getUserRole(){

    }

    public function getPermissions(){

    }




}//@