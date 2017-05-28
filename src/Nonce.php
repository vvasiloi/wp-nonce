<?php

namespace Wordpress\Nonce;


final class Nonce implements NonceInterface
{
    /**
     * @var string
     */
    private $action;

    /**
     * @var int number of seconds
     */
    private $lifetime;

    /**
     * @param string $action
     * @param int $lifetime in seconds
     */
    public function __construct($action, $lifetime = 3600)
    {
        $this->action = $action;
        $this->lifetime = $lifetime;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        $this->addLifetimeFilter();

        $value = wp_create_nonce($this->getAction());

        $this->removeLifetimeFilter();

        return $value;
    }

    /**
     * @param ContextInterface $context
     *
     * @return bool
     */
    public function validate(ContextInterface $context = null)
    {
        $context || $context = new RequestContext();

        if (!$context->has($this->getAction())) {
            return false;
        }

        $this->addLifetimeFilter();

        $isValid = wp_verify_nonce($context->get($this->getAction()), $this->getAction());

        $this->removeLifetimeFilter();

        return false !== $isValid;
    }

    private function addLifetimeFilter()
    {
        add_filter('nonce_life', $this->getLifetimeFilter());
    }

    private function removeLifetimeFilter()
    {
        remove_filter('nonce_life', $this->getLifetimeFilter());
    }

    /**
     * @return \Closure
     */
    private function getLifetimeFilter()
    {
        return function () {
            return $this->lifetime;
        };
    }
}
