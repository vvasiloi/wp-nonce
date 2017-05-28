<?php

namespace Wordpress\Nonce;


interface ContextInterface
{
    /**
     * @param string $action
     * 
     * @return bool
     */
    public function has($action);

    /**
     * @param string $action
     * 
     * @return string
     */
    public function get($action);
}
