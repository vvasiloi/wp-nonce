<?php

namespace Wordpress\Nonce;

use Symfony\Component\HttpFoundation\Request;

class RequestContext implements ContextInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request|null $request
     */
    public function __construct(Request $request = null)
    {
        $this->request = null !== $request ? $request : Request::createFromGlobals();
    }

    /**
     * @param string $action
     *
     * @return bool
     */
    public function has($action)
    {
        return $this->request->attributes->has($action) || $this->request->query->has($action) || $this->request->request->has($action);
    }

    /**
     * @param string $action
     *
     * @return string
     */
    public function get($action)
    {
        return $this->request->get($action, '');
    }
}
