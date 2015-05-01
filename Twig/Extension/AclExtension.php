<?php

namespace Kamran\PermissionBundle\Twig\Extension;

//use Kamran\LayoutBundle\Templating\Helper\ThemeHelper;


class AclExtension extends \Twig_Extension
{
    public function getFunctions(){
        return array(
            new \Twig_SimpleFunction('ace', array($this, 'roleACE') ),
        );
    }

    public function roleACE( $bundle , $options = ''){
        return 'hhhhello , i am from from twig';
    }

    public function getName()
    {
        return 'cogilent_acl';
    }

} //@