<?php

namespace Wordpress\Nonce;


interface NonceInterface
{
    /**
     * Returns the nonce action.
     *
     * @return string
     */
    public function getAction();

    /**
     * Returns the nonce value.
     * 
     * @return string
     */
    public function getValue();

    /**
     * Validates the nonce against a given context.
     *
     * @param ContextInterface $context
     *
     * @return bool
     */
    public function validate(ContextInterface $context = null);
}
