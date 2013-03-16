<?php
 
// example.com/src/Simplex/Framework.php
 
namespace Kzf\Engine;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
 
class KzfKernel
{
    protected $matcher;
    protected $resolver;
 
    public function __construct(UrlMatcher $matcher, ControllerResolver $resolver)
    {
        $this->matcher = $matcher;
        $this->resolver = $resolver;
    }
 
    public function handle(Request $request)
    {
        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));
            $controller = $this->resolver->getController($request);
            $arguments = $this->resolver->getArguments($request, $controller);
            $oResponse = call_user_func_array($controller, $arguments);
            if(!$oResponse instanceof Response) throw new \Exception("Your controller doesn't return a Response Object");
            return $oResponse;
        } catch (ResourceNotFoundException $e) {
            return new Response('Not Found'.$e->getMessage(), 404);
        } catch (\Exception $e) {
            return new Response('An error occurred'.$e->getMessage(), 500);
        }
    }
}