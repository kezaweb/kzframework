<?php

namespace Kzf\Engine\Base;

use Symfony as Symfony;

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * BaseKzfUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class BaseKzfUrlMatcher extends Symfony\Component\Routing\Matcher\UrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // index
        if ($pathinfo === '/') {
            return array (  '_controller' => 'Kzf\\Controller\\KzfController::indexAction',  '_route' => 'index',);
        }

        // tree
        if ($pathinfo === '/tree') {
            return array (  '_controller' => 'Kzf\\Controller\\NodeController::listAction',  '_route' => 'tree',);
        }

        // rules
        if ($pathinfo === '/rules') {
            return array (  '_controller' => 'Kzf\\Controller\\RuleController::listAction',  '_route' => 'rules',);
        }

        // templates
        if ($pathinfo === '/templates') {
            return array (  '_controller' => 'Kzf\\Controller\\TemplateController::listAction',  '_route' => 'templates',);
        }

        // node
        if ($pathinfo === '/node') {
            return array (  '_controller' => 'Kzf\\Controller\\NodeController::singleAction',  '_route' => 'node',);
        }

        // rule
        if ($pathinfo === '/rule') {
            return array (  '_controller' => 'Kzf\\Controller\\RuleController::singleAction',  '_route' => 'rule',);
        }

        // template
        if ($pathinfo === '/template') {
            return array (  '_controller' => 'Kzf\\Controller\\TemplateController::singleAction',  '_route' => 'template',);
        }

        // leaf
        if ($pathinfo === '/leaf') {
            return array (  '_controller' => 'Kzf\\Controller\\LeafController::singleAction',  '_route' => 'leaf',);
        }

        // branch
        if ($pathinfo === '/branch') {
            return array (  '_controller' => 'Kzf\\Controller\\BranchController::singleAction',  '_route' => 'branch',);
        }

        // leaves
        if ($pathinfo === '/leaves') {
            return array (  '_controller' => 'Kzf\\Controller\\LeafController::listAction',  '_route' => 'leaves',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
