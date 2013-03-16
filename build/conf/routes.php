<?php
// This file [routes.php] define routes used by application

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('index', new Routing\Route('/', array('_controller' => 'Kzf\\Controller\\KzfController::indexAction')));

$routes->add('tree', new Routing\Route('/tree', array('_controller' => 'Kzf\\Controller\\NodeTreeController::listAction')));
$routes->add('rules', new Routing\Route('/rules', array('_controller' => 'Kzf\\Controller\\RuleController::listAction')));
$routes->add('templates', new Routing\Route('/templates', array('_controller' => 'Kzf\\Controller\\TemplateController::listAction')));

$routes->add('node', new Routing\Route('/node', array('_controller' => 'Kzf\\Controller\\NodeTreeController::singleAction')));
$routes->add('rule', new Routing\Route('/rule', array('_controller' => 'Kzf\\Controller\\RuleController::singleAction')));
$routes->add('template', new Routing\Route('/template', array('_controller' => 'Kzf\\Controller\\TemplateController::singleAction')));
$routes->add('leaf', new Routing\Route('/leaf', array('_controller' => 'Kzf\\Controller\\LeafController::singleAction')));
$routes->add('branch', new Routing\Route('/branch', array('_controller' => 'Kzf\\Controller\\BranchController::singleAction')));

return $routes;