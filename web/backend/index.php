<?php
/* KZF_DIR define the root of KeZawebFramework */

define('KZF_DIR', $_SERVER['DOCUMENT_ROOT'].'/../');
require_once KZF_DIR.'config/config.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel;

$request = Request::createFromGlobals();

$matcher  = new Kzf\Engine\KzfUrlMatcher($request);
$resolver = new HttpKernel\Controller\ControllerResolver();

$oKzfKernel = new Kzf\Engine\KzfKernel($matcher, $resolver);
$response = $oKzfKernel->handle($request);

$response->send();