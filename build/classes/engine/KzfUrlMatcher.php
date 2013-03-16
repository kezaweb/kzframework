<?php

namespace Kzf\Engine;

use Symfony\Component\Routing as Routing;
use Kzf\Engine\Base as Base;

/**
 * KzfUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class KzfUrlMatcher extends Base\BaseKzfUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(\Symfony\Component\HttpFoundation\Request $request)
    {
    	$context = new Routing\RequestContext();
    	$context->fromRequest($request);
        $this->context = $context;
    }
}
